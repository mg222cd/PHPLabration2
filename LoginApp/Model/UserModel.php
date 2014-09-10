<?php

class UserModel{
    private $username = 'Admin';
    private $password = 'password';
    private $authenticatedUser = false;

    /**
     * @param $username
     * @param $password
     * @return bool
     * Check if username and password from user is correct.
     */

    public function validateLogin($username, $password){
        $this->authenticatedUser = ($this->username == $username && $this->password == $password);
        return $this->authenticatedUser;
    }

    public function getAuthenticatedUser(){
        return $this->authenticatedUser;
    }
}