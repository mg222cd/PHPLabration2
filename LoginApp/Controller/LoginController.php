<?php

require_once('.\View\LoginView.php');
require_once('.\Model\UserModel.php');
require_once('.\View\LoggedinView.php');
require_once('.\Helpers\CookieStorage.php');

class LoginController{
    private $view;
    private $model;
    private $loggedInView;
    private $cookieHelper;

    public function __construct(){
        $this->view = new LoginView();
        $this->model = new UserModel();
        $this->loggedInView = new LoggedInView();
        $this->cookieHelper = new CookieStorage();
    }

    public function doControl(){
        if(isset($_POST['submit'])){
            $this->view->getInformation();
            $username = $this->view->getUsername();
            $password = $this->view->getPassword();
            if(!$this->model->validateLogin($username, $password)){
                $this->view->failedLogIn($username, $password);
            }
            else {
                $this->cookieHelper->save($username, $password);
                $message = $this->view->LogInSuccessMessage();
                $this->loggedInView->setMessage($message);
            };
        }

        $userLogOut = $this->loggedInView->userPressedLogOut();
        if($userLogOut === true){
            $message = $this->loggedInView->logOutSuccessMessage();
            $this->view->setMessage($message);
            $this->model->LogOut();
        }

        $loginView = $this->view->ViewLogin();

        $authenticated = $this->model->getAuthenticatedUser();

        $loggedInView = $this->loggedInView->LoggedInView();
        if($authenticated === true){
            return $loggedInView;
        }
        else{
            return $loginView;
        }
    }
}