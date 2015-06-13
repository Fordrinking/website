<?php
/**
 * Created by PhpStorm.
 * User: kaidi
 * Date: 15-6-11
 * Time: 上午11:17
 */

namespace controllers;

use core\Controller;
use models\CommentModel;
use models\UserModel;

class Comment extends Controller{

    public function giveBlogComment() {
        $blogId  = $_POST['blogId'];
        $userId  = $_POST['userId'];
        $comment = $_POST['comment'];
        $postDate  = date('Y-m-d H:i:s', time());

        $userModel = new UserModel();
        $commentModel = new CommentModel();
        $commentModel->postBlogComment($userId, $blogId, $comment);

        $username = $userModel->getUsername($userId);
        $avatar   = $userModel->getAvatar($userId);

        echo "<div class='blog-comment-item'>\n";
        echo     "<div class='blog-comment-item-u'>\n";
        echo         "<img class='user-img left' src='$avatar'/>\n";
        echo     "</div>\n";
        echo     "<div class='blog-comment-item-c'>\n";
        echo         "<div><a class='blog-comment-u-name' href='#'>$username : </a>$comment</div>\n";
        echo         "<div></div>\n";
        echo         "<div class='blog-comment-item-footer'>\n";
        echo             "<div class='blog-comment-date'>$postDate</div>\n";
        echo             "<ul>\n";
        echo                 "<li>reply</li>\n";
        echo                 "<li><i class='fa fa-thumbs-o-up fa-lg'></i></li>\n";
        echo             "</ul>\n";
        echo         "</div>\n";
        echo     "</div>\n";
        echo "</div>\n";
    }

    public function getBlogComment() {
        $blogId  = $_POST['blogId'];

        $commentModel = new CommentModel();
        $userModel = new UserModel();
        $comments = $commentModel->getNewestComment(12, $blogId);

        if($comments) {
            echo "<div class='blog-comment-body'>\n";
            foreach ($comments as $row) {
                $username = $userModel->getUsername($row->getUid());
                $avatar   = $userModel->getAvatar($row->getUid());
                $content  = $row->getContent();
                $postDate = $row->getPostDate();
                echo "<div class='blog-comment-item'>\n";
                echo     "<div class='blog-comment-item-u'>\n";
                echo         "<img class='user-img left' src='$avatar'/>\n";
                echo     "</div>\n";
                echo     "<div class='blog-comment-item-c'>\n";
                echo         "<div><a class='blog-comment-u-name' href='#'>$username : </a>$content</div>\n";
                echo         "<div></div>\n";
                echo         "<div class='blog-comment-item-footer'>\n";
                echo             "<div class='blog-comment-date'>$postDate</div>\n";
                echo             "<ul>\n";
                echo                 "<li>reply</li>\n";
                echo                 "<li><i class='fa fa-thumbs-o-up fa-lg'></i></li>\n";
                echo             "</ul>\n";
                echo         "</div>\n";
                echo     "</div>\n";
                echo "</div>\n";
            }
            echo "</div>\n";
        }

    }
}














