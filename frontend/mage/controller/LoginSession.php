<?php
require "../../../config.php";

class LoginSession
{
    public $isLogin;
    public $user;
    public $detail;

	/**
     * build
     * 
     * @return void
     */
    public function __construct(){
    	if(!isset($_SESSION)) session_start();
    	$this->isLogin = (isset($_SESSION['mage_user'])) ? true : false;
    }   

    public function inLogin(){
        if($this->isLogin)
            $this->redirect(_PATH_DASHBOARD);
    }

    public function inDashboard(){
        if(!$this->isLogin)
            $this->redirect(_PATH_LOGIN);
        
	$this->user = $_SESSION ['mage_user'];
        $this->detail = $_SESSION ['mage_detail'];
    }

    public function redirect($path){
        header("Location:".$path);
        die();
    }
}
