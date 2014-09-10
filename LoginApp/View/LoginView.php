<?php

class LoginView{
    private $username;
    private $password;

    public function ViewLogin(){
        $time = date("l, d F, Y [G:i:s].");
        $ret = "<h2>Laborationskod för mf222nb</h2>

        <form method='post' action='?login'>
            Användarnamn: <input type='text' name='username'>
            Lösenord: <input type='password' name='password'>
            <input type='submit' value='Logga in' name='submit'>
        </form>

        <p>$time</p>";

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
}