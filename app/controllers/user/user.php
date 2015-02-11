<?php
/**
 *
 * Author:  kaidi - ykdacd@outlook.com
 * Version: 
 * Date:    01/13, 2015
 */

namespace controllers\user;



use core\Controller;
use helpers\graphics\ImageUtil;
use helpers\Url;
use helpers\Session;
use models\BlogModel;
use models\UserModel;

class User extends Controller {

    public function postBlog() {
        $blogModel = new BlogModel();
        $userModel = new UserModel();

        $uid       = Session::get("currentUser");
        $username  = $userModel->getUsername($uid);
        $content   = $_POST['content'];
        $avatar    = $userModel->getAvatar($uid);
        $postdate  = date('Y-m-d H:i:s', time());

        $content   = "<div class='blog-body-t'>" . $content . "</div>";

        $blogModel->postBlog($content, $username);

        echo "<div class='blog-item'>\n";
        echo     "<div class='blog-avatar-item'>\n";
        echo         "<img class='blog-a-img left' src='$avatar'>\n";
        echo     "</div>\n";
        echo     "<div class='blog-c'>";
        echo         "<div class='blog-title'>\n";
        echo             "<div class='blog-user'>\n";
        echo                 "<img class='user-img left' src='$avatar'/>\n";
        echo             "</div>\n";
        echo             "<div class='blog-info'>\n";
        echo                 "<div class='blog-username'>$username</div>\n";
        echo                 "<div class='blog-date'>$postdate</div>\n";
        echo             "</div>\n";
        echo             "<div class='blog-action'><i class='fa  fa-angle-down fa-lg'></i></div>\n";
        echo         "</div>\n";
        echo         "<div class='blog-body'>\n";
        echo             $content;
        echo         "</div>\n";
        echo         "<div class='blog-footer'>\n";
        echo             "<div class='blog-f-btn blog-repost-btn'><i class='fa fa-share-square-o fa-lg'></i></div>\n";
        echo             "<div class='blog-f-btn blog-comment-btn'><i class='fa fa-comment-o fa-lg'></i></div>\n";
        echo             "<div class='blog-f-btn blog-like-btn'><i class='fa fa-thumbs-o-up fa-lg'></i></div>\n";
        echo         "</div>\n";
        echo     "</div>";
        echo "</div>\n";
    }

    public function postBlogClient() {
        $blogModel = new BlogModel();
        $userModel = new UserModel();

        $uid       = intval($_POST['uid']);
        $username  = $userModel->getUsername($uid);
        $content   = $_POST['content'];
        $avatar    = $userModel->getAvatar($uid);
        $postdate  = date('Y-m-d H:i:s', time());
        $content   = "<div class='blog-body-t'>" . $content . "</div>";

        $blogModel->postBlog($content, $username);

        echo "<div class='blog-item'>\n";
        echo     "<div class='blog-title'>\n";
        echo         "<div class='blog-user'>\n";
        echo             "<img class='user-img left' src='$avatar'/>\n";
        echo         "</div>\n";
        echo         "<div class='blog-info'>\n";
        echo             "<div class='blog-username'>$username</div>\n";
        echo             "<div class='blog-date'>$postdate</div>\n";
        echo         "</div>\n";
        echo         "<div class='blog-action'><i class='fa  fa-angle-down fa-lg'></i></div>\n";
        echo     "</div>\n";
        echo     "<div class='blog-body'>\n";
        echo         $content;
        echo     "</div>\n";
        echo     "<div class='blog-footer'>\n";
        echo         "<div class='blog-f-btn blog-repost-btn'><i class='fa fa-share-square-o fa-lg'></i></div>\n";
        echo         "<div class='blog-f-btn blog-comment-btn'><i class='fa fa-comment-o fa-lg'></i></div>\n";
        echo         "<div class='blog-f-btn blog-like-btn'><i class='fa fa-thumbs-o-up fa-lg'></i></div>\n";
        echo     "</div>\n";
        echo "</div>\n";
    }

    public function postPhotos()
    {
        $contents  = array();
        $uploadDir = LOCAL_DIR . 'upload/';

        $file_ary = $this->reArrayFiles($_FILES['imgFiles']);

        foreach ($file_ary as $imageItem) {
            $size = $imageItem ["size"];
            if ($size > 3 * 1024 * 1204 || $size == 0) {
                echo "Warning! Image should no more than 3M";
                exit();
            }

            $type = $imageItem ["type"];
            switch ($type) {
                case 'image/pjpeg' :
                case 'image/jpeg' :
                    $extend = ".jpg";
                    break;
                case 'image/gif' :
                    $extend = ".gif";
                    break;
                case 'image/png' :
                    $extend = ".png";
                    break;
            }
            if (empty($extend)) {
                echo "Warning! Only JPG, PNG and GIF allowed";
                exit();
            }

            $name       = basename($imageItem['name']) . time();
            $newName    = md5($name) . "." . $extend;
            $uploadFile = $uploadDir . $newName;

            $image = ImageUtil::isometricScale($imageItem['tmp_name'], 0, 540, 0);

            switch ($type) {
                case 'image/pjpeg' :
                case 'image/jpeg' :
                    if (!imagejpeg($image, $uploadFile, 80)) {
                        return;
                    }
                    break;
                case 'image/gif' :
                    $extend = ".gif";
                    if (!imagegif($image, $uploadFile, 80)) {
                        return;
                    }
                    break;
                case 'image/png' :
                    $extend = ".png";
                    if (!imagepng($image, $uploadFile, 80)) {
                        return;
                    }
                    break;
            }

            $imgURL = DIR . "upload/" . $newName;

            array_push($contents, "<img class='blog-img' src='$imgURL'>");
        }

        $blogModel = new BlogModel();
        $userModel = new UserModel();

        $uid       = Session::get("currentUser");
        $username  = $userModel->getUsername($uid);
        $content   = implode("\n", $contents);
        $avatar    = $userModel->getAvatar($uid);
        $postdate  = date('y-m-d H:i:s', time());
        $blog      = $_POST['attachData'];

        $content  .= ("<div class='blog-body-t'>" . $blog . "</div>");
        $blogModel->postBlog($content, $username);

        echo "<div class='blog-item'>\n";
        echo     "<div class='blog-avatar-item'>\n";
        echo         "<img class='blog-a-img left' src='$avatar'>\n";
        echo     "</div>\n";
        echo     "<div class='blog-c'>";
        echo         "<div class='blog-title'>\n";
        echo             "<div class='blog-user'>\n";
        echo                 "<img class='user-img left' src='$avatar'/>\n";
        echo             "</div>\n";
        echo             "<div class='blog-info'>\n";
        echo                 "<div class='blog-username'>$username</div>\n";
        echo                 "<div class='blog-date'>$postdate</div>\n";
        echo             "</div>\n";
        echo             "<div class='blog-action'><i class='fa  fa-angle-down fa-lg'></i></div>\n";
        echo         "</div>\n";
        echo         "<div class='blog-body'>\n";
        echo             $content;
        echo         "</div>\n";
        echo         "<div class='blog-footer'>\n";
        echo             "<div class='blog-f-btn blog-repost-btn'><i class='fa fa-share-square-o fa-lg'></i></div>\n";
        echo             "<div class='blog-f-btn blog-comment-btn'><i class='fa fa-comment-o fa-lg'></i></div>\n";
        echo             "<div class='blog-f-btn blog-like-btn'><i class='fa fa-thumbs-o-up fa-lg'></i></div>\n";
        echo         "</div>\n";
        echo     "</div>";
        echo "</div>\n";
    }

    public function postPhotosClient()
    {
        $contents  = array();
        $uploadDir = LOCAL_DIR . 'upload/';

        $image_item_index = 0;
        $image_item = $_FILES["photo0"];
        while ($image_item) {
            $temp       = explode('/', $image_item['type']);
            $type       = $temp[1];
            $name       = basename($image_item['name']) . time();
            $newName    = md5($name) . "." . $type;
            $uploadFile = $uploadDir . $newName;

            if (!move_uploaded_file($image_item['tmp_name'], $uploadFile)) {
                return;
            }
            $imgURL = DIR . "upload/" . $newName;

            array_push($contents, "<img class='blog-img' src='$imgURL'>");

            $image_item_index++;
            $image_item = $_FILES["photo" . $image_item_index];
        }

        $blogModel = new BlogModel();
        $userModel = new UserModel();

        $uid       = intval($_POST['uid']);
        $username  = $userModel->getUsername($uid);
        $content   = implode("\n", $contents);
        $avatar    = $userModel->getAvatar($uid);
        $postdate  = date('Y-m-d H:i:s', time());

        $blogModel->postBlog($content, $username);

        echo "<div class='blog-item'>\n";
        echo     "<div class='blog-title'>\n";
        echo         "<div class='blog-user'>\n";
        echo             "<img class='user-img left' src='$avatar'/>\n";
        echo         "</div>\n";
        echo         "<div class='blog-info'>\n";
        echo             "<div class='blog-username'>$username</div>\n";
        echo             "<div class='blog-date'>$postdate</div>\n";
        echo         "</div>\n";
        echo         "<div class='blog-action'><i class='fa  fa-angle-down fa-lg'></i></div>\n";
        echo     "</div>\n";
        echo     "<div class='blog-body'>\n";
        echo         $content;
        echo     "</div>\n";
        echo     "<div class='blog-footer'>\n";
        echo         "<div class='blog-f-btn blog-repost-btn'><i class='fa fa-share-square-o fa-lg'></i></div>\n";
        echo         "<div class='blog-f-btn blog-comment-btn'><i class='fa fa-comment-o fa-lg'></i></div>\n";
        echo         "<div class='blog-f-btn blog-like-btn'><i class='fa fa-thumbs-o-up fa-lg'></i></div>\n";
        echo     "</div>\n";
        echo "</div>\n";
    }

    public function postVideo() {
        $blogModel = new BlogModel();
        $userModel = new UserModel();

        $uid       = Session::get("currentUser");
        $username  = $userModel->getUsername($uid);
        $content   = $_POST['content'];
        $avatar    = $userModel->getAvatar($uid);
        $postdate  = date('Y-m-d H:i:s', time());
        $blog      = '';

        $content  .= ("<div class='blog-body-t'>" . $blog . "</div>");

        $blogModel->postBlog($content, $username);

        echo "<div class='blog-item'>\n";
        echo     "<div class='blog-avatar-item'>\n";
        echo         "<img class='blog-a-img left' src='$avatar'>\n";
        echo     "</div>\n";
        echo     "<div class='blog-c'>";
        echo         "<div class='blog-title'>\n";
        echo             "<div class='blog-user'>\n";
        echo                 "<img class='user-img left' src='$avatar'/>\n";
        echo             "</div>\n";
        echo             "<div class='blog-info'>\n";
        echo                 "<div class='blog-username'>$username</div>\n";
        echo                 "<div class='blog-date'>$postdate</div>\n";
        echo             "</div>\n";
        echo             "<div class='blog-action'><i class='fa  fa-angle-down fa-lg'></i></div>\n";
        echo         "</div>\n";
        echo         "<div class='blog-body'>\n";
        echo             $content;
        echo         "</div>\n";
        echo         "<div class='blog-footer'>\n";
        echo             "<div class='blog-f-btn blog-repost-btn'><i class='fa fa-share-square-o fa-lg'></i></div>\n";
        echo             "<div class='blog-f-btn blog-comment-btn'><i class='fa fa-comment-o fa-lg'></i></div>\n";
        echo             "<div class='blog-f-btn blog-like-btn'><i class='fa fa-thumbs-o-up fa-lg'></i></div>\n";
        echo         "</div>\n";
        echo     "</div>";
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




