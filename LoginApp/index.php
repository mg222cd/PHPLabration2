<?php

require_once('View\HTMLView.php');
require_once('Controller\LoginController.php');

//ini_set( 'default_charset', 'UTF-8' );

$view = new HTMLView();
$login = new LoginController();

$viewLogin = $login->doControl();
$view->echoHTML($viewLogin);