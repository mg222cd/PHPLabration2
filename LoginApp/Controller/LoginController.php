<?php

require_once('.\View\LoginView.php');
require_once('.\Model\UserModel.php');
class LoginController{
    private $view;
    private $model;

    public function __construct(){
        $this->view = new LoginView();
        $this->model = new UserModel();
    }


    public function doControl(){
        $loginView = $this->view->ViewLogin();
        if(isset($_POST['submit'])){
            $this->view->getInformation();
            $username = $this->view->getUsername();
            $password = $this->view->getPassword();
            $this->model->validateLogin($username, $password);
        }
        return $loginView;
    }


}