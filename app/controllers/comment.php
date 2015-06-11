<?php
/**
 * Created by PhpStorm.
 * User: kaidi
 * Date: 15-6-11
 * Time: 上午11:17
 */

namespace controllers;

use models\UserModel;

class Comment extends Controller{

    public function giveBlogComment() {
        $blogId  = $_POST['blogId'];
        $userId  = $_POST['userId'];
        $comment = $_POST['comment'];

        $userModel->addUser($username, $password, $email);

        $uid = $userModel->getUID($email);

        Session::set('loggedin',    true);
        Session::set('currentUser', $uid);

        echo "user-added";
    }
}