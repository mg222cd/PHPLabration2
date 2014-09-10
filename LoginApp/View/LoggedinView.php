<?php

require_once('LoginView.php');

class LoggedInView{
    private $view;

    public function __construct(){
        $this->view = new LoginView();
    }

    public function LoggedInView(){
        $username = $this->view->getUsername();
        $time = date("l, d F, Y [G:i:s].");
        $ret = "<h2>Laborationskod för mf222nb</h2>

        <h3>$username är inloggad</h3>

        <p>Inloggningen lyckades</p>

        <a href='?SignOut'>Logga ut</a>

        <p>$time</p>";

        return $ret;
    }
}
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 2014-09-10
 * Time: 12:13
 */ 