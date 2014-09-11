<?php

require_once('LoginView.php');

class LoggedInView{
    private $view;
    private $signOut = "SignOut";

    public function __construct(){
        $this->view = new LoginView();
    }

    public function userPressedLogOut(){
        if(isset($_GET[$this->signOut])){
            return true;
        }
        else{
            return false;
        }
    }

    public function LoggedInView(){
        $username = $this->view->getUsername();
        $ret = "<h2>Laborationskod för mf222nb</h2>

        <h3>$username är inloggad</h3>

        <p>Inloggningen lyckades</p>

        <a href='?$this->signOut'>Logga ut</a>";

        return $ret;
    }
}
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 2014-09-10
 * Time: 12:13
 */ 