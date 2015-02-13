<?php
/**
 *
 * Author:  kaidi - ykdacd@outlook.com
 * Version: 
 * Date:    01/14, 2015
 */

namespace daos;


use core\Dao;

class UserDao extends Dao {

    public static function selectEmail($email) {
        $data = self::$_db->select("SELECT email FROM fd_users WHERE email = :email",
            array(':email' => $email));

        return $data;
    }

    public static function selectUsername($username) {
        $data = self::$_db->select("SELECT username FROM fd_users WHERE username = :username",
            array(':username' => $username));

        return $data;
    }

    public static function getUID($email) {
        $data = self::$_db->select("select uid from fd_users where email = :email",
            array(':email' => $email));

        return $data;
    }

    public static function getEmail($uid) {
        $data = self::$_db->select("select email from fd_users where uid = :uid",
            array(':uid' => $uid));

        return $data;
    }

    public static function getUsername($uid) {
        $data = self::$_db->select("select username from fd_users where uid = :uid",
            array(':uid' => $uid));

        return $data;
    }

    public static function getUsernameByMail($email) {
        $data = self::$_db->select("select username from fd_users where email = :email",
            array(':email' => $email));

        return $data;
    }

    public static function getPassword($uid) {
        $data = self::$_db->select("select password from fd_users where uid = :uid",
            array(':uid' => $uid));
        return $data;
    }

    public static function getPasswordByMail($email) {
        $data = self::$_db->select("select password from fd_users where email = :email",
            array(':uid' => $email));
        return $data;
    }

    public static function getAvatar($uid) {
        $data = self::$_db->select("select avatar from fd_users where uid = :uid",
            array(':uid' => $uid));
        return $data;
    }

    public static function getIntro($uid) {
        $data = self::$_db->select("SELECT intro FROM fd_users WHERE uid = :uid",
            array(':uid' => $uid));
        return $data;
    }

    public static function getPostNum($uid) {
        $data = self::$_db->select("SELECT postNum FROM fd_users WHERE uid = :uid",
            array(':uid' => $uid));
        return $data;
    }

    public static function getFollowers($uid) {
        $data = self::$_db->select("SELECT followers FROM fd_users WHERE uid = :uid",
            array(':uid' => $uid));
        return $data;
    }

    public static function getFollows($uid) {
        $data = self::$_db->select("SELECT follows FROM fd_users WHERE uid = :uid",
            array(':uid' => $uid));
        return $data;
    }

    public static function getUser($uid) {
        $data = self::$_db->select("
			SELECT
				".PREFIX."users.username as username,
				".PREFIX."users.password as password,
				".PREFIX."users.email as email,
				".PREFIX."users.avatar as avatar,
				".PREFIX."users.intro as intro,
				".PREFIX."users.postNum as postNum,
				".PREFIX."users.followers as followers,
				".PREFIX."users.follows as follows
			FROM
				".PREFIX."users
			WHERE
				".PREFIX."users.uid = :uid",
            array(':uid' => $uid));

        return $data;
    }

    public static function addUser($data) {
        self::$_db->insert("fd_users", $data);
    }

    public static function updateUser($data, $where) {
        self::$_db->update("fd_users", $data, $where);
    }
}