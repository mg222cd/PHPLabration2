<?php

class CookieStorage{
    private $cookieName = "CookieStorage";
    private $message;

    public function save($string){
        setcookie($this->cookieName, $string, -1);
    }

    public function deleteCookie(){
        setcookie($this->cookieName, "", time() - 1);
    }

    public function loadCookie(){
        if(isset($_COOKIE[$this->cookieName])){
            return true;
        }
    }

    public function cookieExist(){
        if(isset($_COOKIE[$this->cookieName])){
            return $_COOKIE[$this->cookieName];
        }
    }

    public function cookieSaveMessage(){
        return $this->message = "Inloggning lyckades och vi kommer att komma ihåg dig nästa gång";
    }

    public function cookieLoadMessage(){
        return $this->message = "Inloggning lyckades via cookies";
    }

    public function cookieModifiedMessage(){
        return $this->message = "Felaktig information i cookie";
    }
}

/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 2014-09-15
 * Time: 10:36
 */ 