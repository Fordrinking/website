<?php
/**
 *
 * Author:  kaidi - ykdacd@outlook.com
 * Version: 
 * Date:    01/13, 2015
 */

namespace models;

use core\Pea;

class User extends Pea {

    private $email;

    private $username;

    private $avatar;

    private $password;

    public function __construct($email, $username, $password, $avatar) {
        $this->email    = $email;
        $this->username = $username;
        $this->password = $password;
        $this->avatar   = $avatar;
    }


    /**
     * @return array
     */
    public function getData() {
        return array(
            'username' => $this->username,
            'email'    => $this->email,
            'password' => $this->password,
            'avatar'   => $this->avatar
        );
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}