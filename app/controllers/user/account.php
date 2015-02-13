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
        $data['title'] = "info";


        View::rendertemplate('header', $data);
        View::render('home/headbar', $data);
        View::rendertemplate('framework', $data);
        View::render('user/info', $data);
        View::render('user/sidebar', $data);
        View::rendertemplate('footer', $data);
    }

    public function security() {
        $data['title'] = "info";

        View::rendertemplate('header', $data);
        View::render('home/headbar', $data);
        View::rendertemplate('framework', $data);
        View::render('user/security', $data);
        View::render('user/sidebar', $data);
        View::rendertemplate('footer', $data);
    }

    public function privacy() {
        $data['title'] = "info";

        View::rendertemplate('header', $data);
        View::render('home/headbar', $data);
        View::rendertemplate('framework', $data);
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
        View::rendertemplate('framework', $data);
        View::render('user/dashboard', $data);
        View::render('user/sidebar', $data);
        View::rendertemplate('footer', $data);
    }

}