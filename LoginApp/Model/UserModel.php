<?php

class UserModel{
    private $username = 'Admin';
    private $password = 'password';
    private $authenticatedUser = false;
    /**
     * @param $username
     * @param $password
     * @return bool
     * Tittar om användarnamnoch lösenord från användaren stämmer överens.
     */

    public function validateLogin($username, $password){
        $this->authenticatedUser = ($this->username === $username && $this->password === $password);
        if($this->authenticatedUser){
            $_SESSION["ValidLogin"] = $this->username;
        }
        return $this->authenticatedUser;
    }

    public function getAuthenticatedUser(){
        if(isset($_SESSION["ValidLogin"])){
            $this->authenticatedUser = true;
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
    }
}