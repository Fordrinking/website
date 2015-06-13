<?php
/**
 *
 * Author:  kaidi - ykdacd@outlook.com
 * Version: 
 * Date:    01/15, 2015
 */

namespace daos;

use core\Dao;

class BlogDao extends Dao {

	/**
	 * @param $data
     */
	public static function postBlog($data) {
		self::$_db->insert("fd_posts", $data);
	}

    public static function getBlog($pid) {
        $data = self::$_db->select("
			SELECT
			    ".PREFIX."posts.pid as id,
			    ".PREFIX."posts.uid as uid,
			    ".PREFIX."posts.user as username,
				".PREFIX."posts.content as content,
				".PREFIX."posts.postDate as postDate,
				".PREFIX."posts.share_num as shareNum,
				".PREFIX."posts.comment_num as commentNum,
				".PREFIX."posts.like_num as likeNum
			FROM
				".PREFIX."posts
			WHERE
				".PREFIX."posts.pid = :pid",
            array(':pid' => $pid));

        return $data;
    }

    /**
     * @param $num
     * @return array
     */
    public static function getNewestBlog($num) {

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
				pid DESC "."limit :num",
            array(':num' => $num));

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

    public static function updateCommentNum($pid, $num) {
        $data = array('comment_num' => $num);
        $where = array('pid' => $pid);
        self::$_db->update("fd_posts", $data, $where);
    }



}