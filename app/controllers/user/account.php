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
        $data['title'] = "info";

        View::rendertemplate('header', $data);
        View::render('home/headbar', $data);
        View::rendertemplate('framework', $data);
        View::render('user/dashboard', $data);
        View::render('user/sidebar', $data);
        View::rendertemplate('footer', $data);
    }

}