<?php
require "lib/CommonControl.php";

class Activate extends CommonControl
{
	/**
     * build
     * 
     * @return void
     */
    public function __construct(){
        if(isset($_GET['email']) && isset($_GET['code']))
            $this->activate();
    }

    /**
     * activate account
     * 
     * @return void
     */
    public function activate(){
        $error = false;
        $email = $this->filterForm($_GET['email']);
        $code  = $this->filterForm($_GET['code']);

        /* start validation */
        $required   = array(
            $email, $code
        );
        
        if($this->isEmpty($required))
            $error = true;
        else if(!$this->isMail($email))
            $error = true;
        /* end validation */

        if(!$error){
            $query = "UPDATE tb_user
                    SET is_active = '1'
                    WHERE email = '$email'
                    AND code_activate = '$code'
                    ";

            $db = new DB;
            if($db->query($query)){
                if($db->affectedRows() > 0){
                    $this->redirect(_PATH_LOGIN."?activate");          
                }
                 else{
                    die("Account was activated!!");
                }
            }

        }
    }


}

new Activate;
die("Something wrong, my friend!!");