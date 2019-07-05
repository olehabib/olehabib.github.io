<?php
require "lib/CommonControl.php";

class Reset extends CommonControl
{
	/**
     * build
     * 
     * @return void
     */
    public function __construct(){
        if(isset($_POST['reset']))
            $this->reset();
    }

    /**
     * activate account
     * 
     * @return void
     */
    public function reset(){
        $error      = false;
        $newpass    = $this->filterForm($_POST['newpass']);
        $pass       = $this->filterForm($_POST['pass']);
        $id         = abs((int) $_POST['id']);
        
        /* start validation */
        $required   = array(
            $id, $newpass, $pass
        );
        
        if($this->isEmpty($required))
            $error = true;
        /* end validation */

        if(!$error){
            $pass = $this->hashPassword($_POST['pass']);
            $newpass = $this->hashPassword($_POST['newpass']);
                
            $query = "UPDATE tb_user
                SET password = '$newpass'
                WHERE id = '$id'
                AND password = '$pass'
            ";

            $db = new DB;
            if($db->query($query)){
                if($db->affectedRows() > 0)
                    $this->message($this->success_save);
                else if($pass != $newpass)
                    $this->message("Password Wrong!");
                else
                    $this->message("-_-'");
            }
            else $this->message($this->failed_save);
        }
        else $this->message($this->error_input_submit);
        $this->redirect(_PATH_DASHBOARD);
    }


}

new Reset;
die("Something wrong, my friend!!");