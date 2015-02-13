<?php
/**
 *
 * Author:  kaidi - ykdacd@outlook.com
 * Version: 
 * Date:    01/13, 2015
 */

namespace models;

use core\Model;
use daos\BlogDao;


class BlogModel extends Model {

    /**
     * @param $content
     * @param $user
     */
    public function postBlog($content, $uid) {

        $data = array(
            'uid'         => $uid,
            'content'     => $content,
            'share_num'   => 0,
            'comment_num' => 0,
            'like_num'    => 0
        );

        BlogDao::postBlog($data);
    }

    /**
     * @param $num
     * @return array
     */
    public function getNewestBlog($num) {
        $data = BlogDao::getNewestBlog($num);

        return $data;
    }

    /**
     * @param $num
     * @param $uid
     * @return array
     */
    public function getNewestBlogByUser($num, $uid) {
        $data = BlogDao::getNewestBlogByUser($num, $uid);

        return $data;
    }


	/**
	 * @param $index_str
	 * @param $num
	 * @return mixed
     */
	public function getNextBlog($index_str, $num) {
        $index = intval($index_str);
        $data = BlogDao::getNextBlog($index, $num);

        return $data;
    }

    /**
     * @param $index_str
     * @param $num
     * @param $uid
     * @return array
     */
    public function getNextBlogByUser($index_str, $num, $uid) {
        $index = intval($index_str);
        $data  = BlogDao::getNextBlogByUser($index, $num, $uid);

        return $data;
    }

}

