<?php

class LoginView{
    private $username;
    private $password;

    public function ViewLogin(){
        $ret = "<h2>Inloggningsmodul för xx222xx</h2>

        <form method='post'>
            Användarnamn: <input type='text' name='username'>
            Lösenord: <input type='password' name='password'>
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
}