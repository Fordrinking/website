<?php
/**
 *
 * Author:  kaidi - ykdacd@outlook.com
 * Version: 
 * Date:    01/13, 2015
 */

namespace controllers\user;



use core\Controller;
use helpers\Url;
use helpers\Session;
use models\BlogModel;
use models\UserModel;

class User extends Controller {

    public function postBlog() {
        $blogModel = new BlogModel();
        $userModel = new UserModel();

        $uid       = Session::get("currentUser");
        $user      = $userModel->getUsername($uid);
        $content   = $_POST['content'];
        $avatar    = $userModel->getAvatar($uid);
        $date      = date('y-m-d H:i:s', time());

        $content   = "<div class='blog-body-t'>" . $content . "</div>";

        $blogModel->postBlog($content, $user);

        echo "<div class='blog-item'>\n";
        echo     "<div class='blog-user'>\n";
        echo         "<img class='post-user-img left' src='$avatar'>\n";
        echo     "</div>\n";
        echo     "<div class='blog-c'>\n";
        echo         "<div class='blog-title'>\n";
        echo             "<div class='blog-username'>$user</div>\n";
        echo             "<div class='blog-date'>$date</div>\n";
        echo         "</div>\n";
        echo         "<div class='blog-body'>\n";
        echo             $content;
        echo         "</div>\n";
        echo         "<div class='blog-footer'>\n";
        echo         "</div>\n";
        echo     "</div>\n";
        echo "</div>\n";
    }

    public function postPhotos()
    {
        $contents  = array();
        $uploadDir = '/home/kaidi/Projects/Web/fordrinking/upload/';

        $file_ary = $this->reArrayFiles($_FILES['imgFiles']);

        foreach ($file_ary as $file) {
            $temp       = explode('/', $file['type']);
            $type       = $temp[1];
            $name       = basename($file['name']) . time();
            $newName    = md5($name) . "." . $type;
            $uploadFile = $uploadDir . $newName;

            if (!move_uploaded_file($file['tmp_name'], $uploadFile)) {
                return;
            }
            $imgURL = DIR . "upload/" . $newName;

            array_push($contents, "<img class='blog-img' src='$imgURL'>");
        }

        $blogModel = new BlogModel();
        $userModel = new UserModel();

        $uid       = Session::get("currentUser");
        $user      = $userModel->getUsername($uid);
        $content   = implode("\n", $contents);
        $avatar    = $userModel->getAvatar($uid);
        $date      = date('y-m-d H:i:s', time());
        $blog      = $_POST['attachData'];

        $content  .= ("<div class='blog-body-t'>" . $blog . "</div>");
        $blogModel->postBlog($content, $user);

        echo "<div class='blog-item'>\n";
        echo     "<div class='blog-user'>\n";
        echo         "<img class='post-user-img left' src='$avatar'>\n";
        echo     "</div>\n";
        echo     "<div class='blog-c'>\n";
        echo         "<div class='blog-title'>\n";
        echo             "<div class='blog-username'>$user</div>\n";
        echo             "<div class='blog-date'>$date</div>\n";
        echo         "</div>\n";
        echo         "<div class='blog-body'>\n";
        echo             $content;
        echo         "</div>\n";
        echo         "<div class='blog-footer'>\n";
        echo         "</div>\n";
        echo     "</div>\n";
        echo "</div>\n";
    }

    public function postVideo() {
        $blogModel = new BlogModel();
        $userModel = new UserModel();

        $uid       = Session::get("currentUser");
        $user      = $userModel->getUsername($uid);
        $content   = $_POST['content'];
        $avatar    = $userModel->getAvatar($uid);
        $date      = date('y-m-d H:i:s', time());
        $blog      = '';

        $content  .= ("<div class='blog-body-t'>" . $blog . "</div>");

        $blogModel->postBlog($content, $user);

        echo "<div class='blog-item'>\n";
        echo     "<div class='blog-user'>\n";
        echo         "<img class='post-user-img left' src='$avatar'>\n";
        echo     "</div>\n";
        echo     "<div class='blog-c'>\n";
        echo         "<div class='blog-title'>\n";
        echo             "<div class='blog-username'>$user</div>\n";
        echo             "<div class='blog-date'>$date</div>\n";
        echo         "</div>\n";
        echo         "<div class='blog-body'>\n";
        echo             $content;
        echo         "</div>\n";
        echo         "<div class='blog-footer'>\n";
        echo         "</div>\n";
        echo     "</div>\n";
        echo "</div>\n";
    }

    private function reArrayFiles(&$file_post) {

        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i=0; $i<$file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }

        return $file_ary;
    }


}




