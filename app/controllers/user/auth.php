<?php
/**
 *
 * Author:  kaidi - ykdacd@outlook.com
 * Version: 0.1
 * Date:    01/11, 2015
 */

namespace controllers\user;

use core\Controller;
use \helpers\Session;
use \helpers\Url;
use \core\View;
use models\UserModel;


class Auth extends Controller {

    public function login() {
        if(Session::get('loggedin')){
            Url::redirect('home');
        }

        $data['title'] = 'Login';

        $userModel = new UserModel();

        if (isset($_POST['loginBtn'])) {
            $email    = $_POST['loginMail'];
            $password = $_POST['loginPass'];

            if ($userModel->isMailExist($email)) {
                $uid = $userModel->getUID($email);

                if($password == $userModel->getPassword($uid)) {
                    Session::set('loggedin',    true);
                    Session::set('currentUser', $uid);
                    Url::redirect('home');
                } else {
                    $error = 'Wrong Password !';
                }
            } else {
                $error = "Mail Not Exist !";
            }

            $data['email'] = $email;
        }

        View::rendertemplate('header' ,$data);
        View::render('home/headbar'   ,$data);
        View::render('user/login'     ,$data, $error);
        View::rendertemplate('footer' ,$data);
    }

    public function clientLogin() {
        $email    = $_POST['loginMail'];
        $password = $_POST['loginPass'];

        $userModel = new UserModel();

        if (!$userModel->isMailExist($email)) {
            echo "no-email";
            return ;
        }
        $uid = $userModel->getUID($email);

        if($password == $userModel->getPassword($uid)) {
            Session::set('loggedin',    true);
            Session::set('currentUser', $uid);
        } else {
            echo "wrong-password";
            return;
        }

        $name = $userModel->getUsername($uid);
        $avatar = $userModel->getAvatar($uid);

        $userInfo = array(
            'uid'      => $uid, 
            'email'    => $email,
            'password' => $password, 
            'username'     => $name, 
            'avatar'   => $avatar);

         echo json_encode($userInfo);
    }

    public function logout() {
        Session::destroy();
        Url::redirect('login');
    }





}