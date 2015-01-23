<?php
/**
 *
 * Author:  kaidi - ykdacd@outlook.com
 * Version: 
 * Date:    01/12, 2015
 */

namespace controllers\user;

use core\Controller;
use core\View;
use helpers\Session;
use helpers\Url;
use models\UserModel;

class Signup extends Controller {

    public function index() {
        if (Session::get('loggedin')) {
            Url::redirect('home');
        }

        View::rendertemplate('header');
        View::render('home/headbar');
        View::render('user/signup');
        View::rendertemplate('footer');
    }

    public function check() {
        $email    = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $userModel = new UserModel();

        if ($userModel->isMailExist($email)) {
            echo "email-exist";
            return ;
        }

        if ($userModel->isNameExist($username)) {
            echo "user-exist";
            return;
        }

        $userModel->addUser($username, $password, $email);

        $uid = $userModel->getUID($email);

        Session::set('loggedin',    true);
        Session::set('currentUser', $uid);

        echo "user-added";
    }

    public function checkEmail() {
        $email    = $_POST['email'];

        $userModel = new UserModel();
        if ($email != "" && $userModel->isMailExist($email)) {
            echo "email-exist";
            return ;
        }
    }

    public function checkUsername() {
        $username = $_POST['username'];

        $userModel = new UserModel();
        if ($username != "" && $userModel->isMailExist($username)) {
            echo "user-exist";
            return ;
        }
    }

}













