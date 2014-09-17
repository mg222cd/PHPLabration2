<?php

require_once('.\View\LoginView.php');
require_once('.\Model\UserModel.php');
require_once('.\View\LoggedinView.php');
require_once('.\View\CookieView.php');
require_once('.\Helpers\ServiceHelper.php');

class LoginController{
    private $view;
    private $model;
    private $loggedInView;
    private $cookieView;
    private $serviceHelper;

    public function __construct(){
        $this->view = new LoginView();
        $this->model = new UserModel();
        $this->loggedInView = new LoggedInView();
        $this->cookieView = new CookieStorage();
        $this->serviceHelper = new ServiceHelper();
    }

    public function doControl(){
        $userAgent = $this->serviceHelper->getUserAgent();

        if($this->view->getSubmit()){
            $this->view->getInformation();
            $username = $this->view->getUsername();
            $password = $this->view->getPassword();
            $realAgent = $this->serviceHelper->getUserAgent();
            if(!$this->model->validateLogin($username, $password, $realAgent)){
                $this->view->failedLogIn($username, $password);
            }
            else {
                if($this->view->wantCookie()){
                    $randomString = $this->model->getRandomString();
                    $time = $this->cookieView->save($randomString);
                    $this->model->saveCookieTime($time);
                    $message = $this->cookieView->cookieSaveMessage();
                    $this->loggedInView->setMessage($message);
                }
                else{
                    $message = $this->view->LogInSuccessMessage();
                    $this->loggedInView->setMessage($message);
                }
            }
        }

        $authenticated = $this->model->getAuthenticatedUser($userAgent);
        if($authenticated === false){
            if($this->cookieView->loadCookie()){
                $cookieValue = $this->cookieView->cookieExist();
                if($this->model->controlCookieValue($cookieValue, $userAgent)){
                    $message = $this->cookieView->cookieLoadMessage();
                    $this->loggedInView->setMessage($message);
                }
                else{
                    $message = $this->cookieView->cookieModifiedMessage();
                    $this->view->setMessage($message);
                }
            }
        }

        $authenticated = $this->model->getAuthenticatedUser($userAgent);
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
        $authenticated = $this->model->getAuthenticatedUser($userAgent);

        if($authenticated === true){
            return $loggedInView;
        }
        else{
            return $loginView;
        }
    }
}