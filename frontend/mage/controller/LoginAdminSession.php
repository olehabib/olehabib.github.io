<?php
require "../../../config.php";

class LoginAdminSession
{
    public $isLogin;

	/**
     * build
     * 
     * @return void
     */
    public function __construct(){
    	if(!isset($_SESSION)) session_start();
    	$this->isLogin = (isset($_SESSION['mage_admin'])) ? true : false;
    }   

    public function inLogin(){
        if($this->isLogin)
            $this->redirect(_PATH_DASHBOARDADM);
    }

    public function inDashboard(){
        if(!$this->isLogin)
            $this->redirect(_PATH_LOGINADM);
    }

    public function redirect($path){
        header("Location:".$path);
        die();
    }
}