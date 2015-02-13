<?php namespace controllers;

/**
 *
 * Author:  kaidi - ykdacd@outlook.com
 * Version: 0.1
 * Date:    01/11, 2015
 */

use core\Controller;
use core\View;
use helpers\Session;
use helpers\Url;
use models\BlogModel;
use models\UserModel;


class Home extends Controller {

	/**
	 * Define Index page title and load template files
	 */
	public function index() {
		if (!Session::get('loggedin')) {
			Url::redirect('login');
		}

		$blogModel = new BlogModel();
		$userModel = new UserModel();


		$data['title'] = "home";
		$data['posts']     = $blogModel->getNewestBlog(5);
		$data['avatar']    = $userModel->getAvatar(Session::get("currentUser"));
		$data['username']  = $userModel->getUsername(Session::get("currentUser"));
		$data['blogIndex'] = 5;

		View::rendertemplate('header', $data);
		View::render('home/headbar', $data);
		View::rendertemplate('framework', $data);
		View::render('home/post', $data);
		View::render('home/blogs', $data);
		View::render('home/sidebar', $data);
		View::rendertemplate('footer', $data);
	}

	public function favorite() {
		if (!Session::get('loggedin')) {
			Url::redirect('login');
		}

		$data['title'] = "favorite";

		View::rendertemplate('header', $data);
		View::render('home/headbar', $data);
		View::rendertemplate('framework', $data);
		View::render('home/sidebar', $data);
		View::rendertemplate('footer', $data);
	}

	public function recommend() {
		if (!Session::get('loggedin')) {
			Url::redirect('login');
		}
		$data['title'] = "recommend";

		View::rendertemplate('header', $data);
		View::render('home/headbar', $data);
		View::rendertemplate('framework', $data);
		View::render('home/sidebar', $data);
		View::rendertemplate('footer', $data);
	}

	public function moreBlogs() {
		$blogModel = new BlogModel();

		$data['posts'] = $blogModel->getNextBlog($_POST['blogIndex'], 5);

		if($data['posts']){
			foreach($data['posts'] as $row){
				echo "<div class='blog-item'>\n";
				echo     "<div class='blog-avatar-item'>\n";
				echo         "<img class='blog-a-img left' src='$row->avatar'>\n";
				echo     "</div>\n";
				echo     "<div class='blog-c'>";
				echo         "<div class='blog-title'>\n";
				echo             "<div class='blog-user'>\n";
				echo                 "<img class='user-img left' src='$row->avatar'/>\n";
				echo             "</div>\n";
				echo             "<div class='blog-info'>\n";
				echo                 "<div class='blog-username'>$row->username</div>\n";
				echo                 "<div class='blog-date'>$row->postDate</div>\n";
				echo             "</div>\n";
				echo             "<div class='blog-action'><i class='fa  fa-angle-down fa-lg'></i></div>\n";
				echo         "</div>\n";
				echo         "<div class='blog-body'>\n";
				echo             $row->content;
				echo         "</div>\n";
				echo         "<div class='blog-footer'>\n";
				echo             "<div class='blog-f-btn blog-repost-btn'><i class='fa fa-share-square-o fa-lg'></i></div>\n";
				echo             "<div class='blog-f-btn blog-comment-btn'><i class='fa fa-comment-o fa-lg'></i></div>\n";
				echo             "<div class='blog-f-btn blog-like-btn'><i class='fa fa-thumbs-o-up fa-lg'></i></div>\n";
				echo         "</div>\n";
				echo     "</div>";
				echo "</div>\n";
			}
		}
	}

	public function clientGetBlogs() {
		$blogs = array();

		$blogModel = new BlogModel();

		$data = $blogModel->getNewestBlog(5);
		if ($data) {
			foreach($data as $row) {
				$newblog = array(
					'avatar'   => $row->avatar,
					'username' => $row->username,
					'postdate' => $row->postDate,
					'content'  => $row->content);
				array_push($blogs, $newblog);
			}
		}

		echo json_encode($blogs);
	}

}














