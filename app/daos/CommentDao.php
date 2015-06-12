<?php
/**
 *
 * Author:  kaidi - ykdacd@outlook.com
 * Version:
 * Date:    06/11, 2015
 */

namespace daos;

use core\Dao;

class CommentDao extends Dao {

    /**
     * @param $data
     */
    public static function postBlogComment($data) {
        self::$_db->insert("fd_comments", $data);
    }

    public static function getBlogCommentsNum() {
        return self::$_db->getTableLength("fd_comments");
    }

    /**
     * @param $num
     * @return array
     */
    public static function getNewestComment($num, $bid) {

        $data = self::$_db->select("
			SELECT
			    ".PREFIX."comments.cid as id,
			    ".PREFIX."comments.uid as uid,
			    ".PREFIX."comments.bid as bid,
				".PREFIX."comments.content as content,
				".PREFIX."comments.postDate as postDate,
				".PREFIX."comments.like_num as likeNum
			FROM
				".PREFIX."comments
			WHERE
				".PREFIX."comments.bid = :bid
			ORDER BY
				cid DESC "."limit :num",
            array(':num' => $num,
                  ':bid' => $bid));

        return $data;
    }

    /**
     * @param $num
     * @param $uid
     * @return array
     */
    public static function getNewestBlogByUser($num, $uid) {

        $data = self::$_db->select("
			SELECT
			    ".PREFIX."posts.pid as id,
				".PREFIX."posts.content as content,
				".PREFIX."posts.postDate as postDate,
				".PREFIX."posts.share_num as shareNum,
				".PREFIX."posts.comment_num as commentNum,
				".PREFIX."posts.like_num as likeNum
			FROM
				".PREFIX."posts
			WHERE
				".PREFIX."posts.uid = :uid
			ORDER BY
				pid DESC "."limit :num",
            array(':num' => $num,
                ':uid' => $uid));

        return $data;
    }


    /**
     * @param $index
     * @param $num
     * @return mixed
     */
    public static function getNextBlog($index, $num) {

        $data = self::$_db->select("
			SELECT
			    ".PREFIX."posts.pid as id,
				".PREFIX."posts.content as content,
				".PREFIX."posts.postDate as postDate,
				".PREFIX."posts.share_num as shareNum,
				".PREFIX."posts.comment_num as commentNum,
				".PREFIX."posts.like_num as likeNum,
				".PREFIX."users.username as username,
				".PREFIX."users.avatar as avatar
			FROM
				".PREFIX."posts,
				".PREFIX."users
			WHERE
				".PREFIX."posts.uid = ".PREFIX."users.uid
			ORDER BY
				pid DESC "."limit :index, :num",
            array(':num' => $num,
                ':index' => $index));

        return $data;
    }

    /**
     * @param $index
     * @param $num
     * @param $uid
     * @return mixed
     */
    public static function getNextBlogByUser($index, $num, $uid) {

        $data = self::$_db->select("
			SELECT
			    ".PREFIX."posts.pid as id,
				".PREFIX."posts.content as content,
				".PREFIX."posts.postDate as postDate,
				".PREFIX."posts.share_num as shareNum,
				".PREFIX."posts.comment_num as commentNum,
				".PREFIX."posts.like_num as likeNum
			FROM
				".PREFIX."posts
			WHERE
				".PREFIX."posts.uid = :uid
			ORDER BY
				pid DESC "."limit :index, :num",
            array(':num' => $num,
                ':uid' => $uid,
                ':index' => $index));

        return $data;
    }


}