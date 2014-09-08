<?php

require_once("View\HTMLView.php");
require_once("View\LoginView.php");
$view = new HTMLView();
$login = new LoginView();

$viewLogin = $login->ViewLogin();
$view->echoHTML($viewLogin);