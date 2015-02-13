<?php
/**
 *
 * Author:  kaidi - ykdacd@outlook.com
 * Version: 0.1
 * Date:    02/11, 2015
 */

namespace controllers\user;


use core\Controller;
use core\View;
use helpers\Session;
use helpers\Url;
use models\BlogModel;
use models\UserModel;

class Account extends Controller{
    public function info() {
        if (!Session::get('loggedin')) {
            Url::redirect('login');
        }
        $data['title'] = "info";


        View::rendertemplate('header', $data);
        View::render('home/headbar', $data);
        View::rendertemplate('account-framework', $data);
        View::render('user/info', $data);
        View::render('user/sidebar', $data);
        View::rendertemplate('footer', $data);
    }

    public function security() {
        if (!Session::get('loggedin')) {
            Url::redirect('login');
        }
        $data['title'] = "security";

        View::rendertemplate('header', $data);
        View::render('home/headbar', $data);
        View::rendertemplate('account-framework', $data);
        View::render('user/security', $data);
        View::render('user/sidebar', $data);
        View::rendertemplate('footer', $data);
    }

    public function privacy() {
        if (!Session::get('loggedin')) {
            Url::redirect('login');
        }
        $data['title'] = "privacy";

        View::rendertemplate('header', $data);
        View::render('home/headbar', $data);
        View::rendertemplate('account-framework', $data);
        View::render('user/privacy', $data);
        View::render('user/sidebar', $data);
        View::rendertemplate('footer', $data);
    }

    public function dashboard() {
        if (!Session::get('loggedin')) {
            Url::redirect('login');
        }

        $blogModel = new BlogModel();
        $userModel = new UserModel();

        $data['posts']     = $blogModel->getNewestBlogByUser(5, Session::get("currentUser"));
        $data['avatar']    = $userModel->getAvatar(Session::get("currentUser"));
        $data['username']  = $userModel->getUsername(Session::get("currentUser"));
        $data['title']     = "dashboard";
        $data['js']        = array("account");
        $data['blogIndex'] = 5;

        View::rendertemplate('header', $data);
        View::render('home/headbar', $data);
        View::rendertemplate('account-framework', $data);
        View::render('user/dashboard', $data);
        View::render('user/sidebar', $data);
        View::rendertemplate('footer', $data);
    }

    public function moreSelfBlogs() {
        $blogModel = new BlogModel();

        $data['posts'] = $blogModel->getNextBlogByUser($_POST['blogIndex'], 5,
            Session::get("currentUser"));

        if($data['posts']){
            foreach($data['posts'] as $row){
                echo "<div class='blog-item'>\n";
                echo     "<div class='dash-blog-c'>";
                echo         "<div class='blog-title'>\n";
                echo             "<div class='blog-info'>\n";
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
}