<?php

require_once('./View/LoginView.php');
require_once('./Model/UserModel.php');
require_once('./View/LoggedinView.php');
require_once('./View/CookieView.php');
require_once('./Helpers/ServiceHelper.php');

class LoginController{
    private $loginView;
    private $userModel;
    private $loggedInView;
    private $cookieView;
    private $serviceHelper;

    public function __construct(){
        $this->loginView = new LoginView();
        $this->userModel = new UserModel();
        $this->loggedInView = new LoggedInView();
        $this->cookieView = new CookieStorage();
        $this->serviceHelper = new ServiceHelper();
    }

    public function doControl(){
        $userAgent = $this->serviceHelper->getUserAgent();

        if($this->loginView->getSubmit()){
            $this->loginView->getInformation();
            $username = $this->loginView->getUsername();
            $password = $this->loginView->getPassword();
            $realAgent = $this->serviceHelper->getUserAgent();
            if(!$this->userModel->validateLogin($username, $password, $realAgent)){
                $this->loginView->failedLogIn($username, $password);
            }
            else {
                if($this->loginView->wantCookie()){
                    $randomString = $this->userModel->getRandomString();
                    $time = $this->cookieView->save($randomString);
                    $this->userModel->saveCookieTime($time);
                    $message = $this->cookieView->cookieSaveMessage();
                    $this->loggedInView->setMessage($message);
                }
                else{
                    $message = $this->loginView->LogInSuccessMessage();
                    $this->loggedInView->setMessage($message);
                }
            }
        }

        $authenticated = $this->userModel->getAuthenticatedUser($userAgent);
        if($authenticated === false){
            if($this->cookieView->loadCookie()){
                $cookieValue = $this->cookieView->cookieExist();
                if($this->userModel->controlCookieValue($cookieValue, $userAgent)){
                    $message = $this->cookieView->cookieLoadMessage();
                    $this->loggedInView->setMessage($message);
                }
                else{
                    $this->cookieView->deleteCookie();
                    $message = $this->cookieView->cookieModifiedMessage();
                    $this->loginView->setMessage($message);
                }
            }
        }

        $authenticated = $this->userModel->getAuthenticatedUser($userAgent);
        if($authenticated === true){
            $userLogOut = $this->loggedInView->userPressedLogOut();
            if($userLogOut === true){
                $this->cookieView->deleteCookie();
                $message = $this->loggedInView->logOutSuccessMessage();
                $this->loginView->setMessage($message);
                $this->userModel->LogOut();
            }
        }

        $loginView = $this->loginView->ViewLogin();

        $loggedInView = $this->loggedInView->LoggedInView();
        $authenticated = $this->userModel->getAuthenticatedUser($userAgent);

        if($authenticated === true){
            //Returnerar den inloggade vyn.
            return $loggedInView;
        }
        else{
            //Returnerar den icke inloggade vyn.
            return $loginView;
        }
    }
}