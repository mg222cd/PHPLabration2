<?php

require_once('.\View\LoginView.php');
require_once('.\Model\UserModel.php');
require_once('.\View\LoggedinView.php');
require_once('.\View\CookieView.php');

class LoginController{
    private $view;
    private $model;
    private $loggedInView;
    private $cookieView;

    public function __construct(){
        $this->view = new LoginView();
        $this->model = new UserModel();
        $this->loggedInView = new LoggedInView();
        $this->cookieView = new CookieStorage();
    }

    public function doControl(){
        if($this->view->getSubmit()){
            $this->view->getInformation();
            $username = $this->view->getUsername();
            $password = $this->view->getPassword();
            if(!$this->model->validateLogin($username, $password)){
                $this->view->failedLogIn($username, $password);
            }
            else {
                if($this->view->wantCookie()){
                $randomString = $this->model->getRandomString();
                $this->cookieView->save($randomString);
                }
                $message = $this->view->LogInSuccessMessage();
                $this->loggedInView->setMessage($message);
            };
        }

        $authenticated = $this->model->getAuthenticatedUser();
        if($authenticated === true){
            $userLogOut = $this->loggedInView->userPressedLogOut();
            if($userLogOut === true){
                $this->cookieView->deleteCookie();
                $message = $this->loggedInView->logOutSuccessMessage();
                $this->view->setMessage($message);
                $this->model->LogOut();
            }
        }

        $loginView = $this->view->ViewLogin();

        $loggedInView = $this->loggedInView->LoggedInView();
        $authenticated = $this->model->getAuthenticatedUser();

        if($authenticated === true){
            return $loggedInView;
        }
        else{
            return $loginView;
        }
    }
}