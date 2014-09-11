<?php

require_once('.\View\LoginView.php');
require_once('.\Model\UserModel.php');
require_once('.\View\LoggedinView.php');

class LoginController{
    private $view;
    private $model;
    private $loggedInView;

    public function __construct(){
        $this->view = new LoginView();
        $this->model = new UserModel();
        $this->loggedInView = new LoggedInView();
    }


    public function doControl(){
        $loggedInView = $this->loggedInView->LoggedInView();

        if(isset($_POST['submit'])){
            $this->view->getInformation();
            $username = $this->view->getUsername();
            $password = $this->view->getPassword();
            if(!$this->model->validateLogin($username, $password)){
                $this->view->failedLogIn();
            };
        }

        $userLogOut = $this->loggedInView->userPressedLogOut();
        if($userLogOut === true){
            $this->model->LogOut();
        }

        $loginView = $this->view->ViewLogin();

        $authenticated = $this->model->getAuthenticatedUser();
        if($authenticated === true){
            return $loggedInView;
        }
        else{
            $this->model->LogOut();
            return $loginView;
        }
    }
}