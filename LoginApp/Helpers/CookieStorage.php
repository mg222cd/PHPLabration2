<?php

class CookieStorage{
    private $cookieName = "CookieStorage1";
    private $cookiePass = "CookieStorage2";

    public function save($username, $password){
        setcookie($this->cookieName, $username, -1);
        setcookie($this->cookiePass, $password, -1);
    }
}
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 2014-09-15
 * Time: 10:36
 */ 