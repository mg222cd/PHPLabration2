<?php

class CookieStorage{
    private $cookieName = "CookieStorage";

    public function save($string){
        setcookie($this->cookieName, $string, -1);
    }

    public function deleteCookie(){
        setcookie($this->cookieName, "", time() - 1);
    }
}
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 2014-09-15
 * Time: 10:36
 */ 