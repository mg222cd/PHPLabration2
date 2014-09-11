<?php

class LoginView{
    private $username;
    private $password;
    private $error;

    public function ViewLogin(){
        $ret = "<h2>Laborationskod för mf222nb</h2>
        <p>$this->error</p>
        <form method='post' action='?LoggedIn'>
            Användarnamn: <input type='text' name='username'>
            Lösenord: <input type='password' name='password'>
            Håll mig inloggad <input type='checkbox' name='check'>
            <input type='submit' value='Logga in' name='submit'>
        </form>";

        return $ret;
    }

    public function getInformation(){
        if(isset($_POST['username'])){
            $this->username = $_POST['username'];
        }
        if(isset($_POST['password'])){
            $this->password = $_POST['password'];
        }
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function failedLogIn(){
        $this->error = "Användarnamn och/eller lösenord saknas";
    }
}