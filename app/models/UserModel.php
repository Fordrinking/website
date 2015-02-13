<?php
/**
 *
 * Author:  kaidi - ykdacd@outlook.com
 * Version: 
 * Date:    01/15, 2015
 */

namespace models;


use core\Model;
use daos\UserDao;

class UserModel extends Model {

    /**
     * @param string $email
     * @return bool
     */
    public function isMailExist($email) {
        $data = UserDao::selectEmail($email);
        if (count($data) != 0) {
            return true;
        }

        return false;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function isNameExist($name) {
        $data = UserDao::selectUsername($name);
        if (count($data) != 0) {
            return true;
        }

        return false;
    }

    public function getUID($email) {
        $data = UserDao::getUID($email);

        return $data[0]->uid;
    }

    public function getUser($uid) {
        $user = new User(
            UserDao::getUsername($uid),
            UserDao::getUsername($uid),
            UserDao::getPassword($uid),
            UserDao::getAvatar($uid),
            UserDao::getIntro($uid),
            UserDao::getPostNum($uid),
            UserDao::getFollowers($uid),
            UserDao::getFollows($uid));

        return $user;
    }

    public function getUsername($uid) {
        $data = UserDao::getUsername($uid);
        return $data[0]->username;
    }

    public function getPassword($uid) {
        $data = UserDao::getPassword($uid);
        return $data[0]->password;
    }

    public function getAvatar($uid) {
        $data = UserDao::getAvatar($uid);
        return $data[0]->avatar;
    }

    /**
     * @param string $username The name of the user
     * @param string $password The password of the user
     * @param string $email    The email of the user
     */
    public function addUser($username, $password, $email) {
        $data = array(
            'username' => $username,
            'password' => $password,
            'email'    => $email,
            'avatar'   => $this->makeGravatar($email),
            'intro'    => "Something about you!",
            'postNum'  => 0,
            'followers'=> 0,
            'follows'  => 0
        );

        UserDao::addUser($data);
    }



    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param  string $email  User's email
     * @param  int    $size   Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param  string $type   Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param  string $rating Maximum rating (inclusive) [ g | pg | r | x ]
     * @return string Url of the avatar
     */
    public function makeGravatar($email, $size = 80, $type = 'identicon', $rating = 'g') {
        $url  = 'http://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$size&d=$type&r=$rating";
        // use duoshuo as proxy
        $url = str_replace(array("www.gravatar.com","0.gravatar.com","1.gravatar.com","2.gravatar.com"),"gravatar.duoshuo.com",$url);

        return $url;
    }

}