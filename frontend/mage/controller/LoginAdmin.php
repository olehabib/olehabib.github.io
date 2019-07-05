<?php
require "lib/CommonControl.php";

class LoginAdmin extends CommonControl
{
	/**
     * build
     * 
     * @return void
     */
    public function __construct(){
        if(!isset($_SESSION)) session_start();
        $this->auth();
    }   

    /**
     * Get login
     *
     * @return void
     */
    public function auth() {
        $error = false;

        $user       = $this->filterForm($_POST['username']);
        $password   = $this->filterForm($_POST['password']);
    
        /* start validation */
        $required   = array(
            $user, $password
        );

        if($this->isEmpty($required))
            $error = true;
        /* end validation */

        if(!$error){
            if($user === _ADMUSER && $password === _ADMPASS){
                $_SESSION ['mage_admin'] = $user;
                $this->redirect(_PATH_DASHBOARDADM);
            }
            $this->message($this->failed_login);
        }
        else $this->message($this->error_input_login);
        $this->redirect(_PATH_LOGINADM);
    }
}