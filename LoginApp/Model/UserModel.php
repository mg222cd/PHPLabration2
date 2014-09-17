<?php

class UserModel{
    private $username = 'Admin';
    private $password = 'password';
    private $authenticatedUser = false;
    private $randomString = "dsdididjsadladacm";

    /**
     * @param $username
     * @param $password
     * @param $userAgent
     * @return bool
     * Tittar om användarnamnoch lösenord från användaren stämmer överens.
     */

    public function validateLogin($username, $password, $userAgent){
        $this->authenticatedUser = ($this->username === $username && $this->password === $password);
        if($this->authenticatedUser){
            $_SESSION["ValidLogin"] = $this->username;
            $_SESSION["UserAgent"] = $userAgent;
        }
        return $this->authenticatedUser;
    }

    public function getAuthenticatedUser($userAgent){
        if(isset($_SESSION["UserAgent"]) && $_SESSION["UserAgent"] === $userAgent){
            if(isset($_SESSION["ValidLogin"])){
                $this->authenticatedUser = true;
            }
        }
        return $this->authenticatedUser;
    }

    public function __construct(){
        session_start();
    }

    public function LogOut(){
        if(isset($_SESSION["ValidLogin"])){
            unset($_SESSION["ValidLogin"]);
        }
        return $this->authenticatedUser = false;
    }

    public function getRandomString(){
        return $this->randomString;
    }

    public function controlCookieValue($cookieValue, $userAgent){
        $time = file_get_contents("exist.txt");
        if($time > time()){
            if($this->randomString === $cookieValue){
                $_SESSION["ValidLogin"] = $this->username;
                $_SESSION["UserAgent"] = $userAgent;
                return $this->authenticatedUser = true;
            }
            else{
                return $this->authenticatedUser = false;
            }
        }
    }

    public function saveCookieTime($time){
        file_put_contents("exist.txt", $time);
    }
}