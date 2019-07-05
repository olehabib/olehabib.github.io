<?php

class RegisterCompetition extends Register
{
	/**
     * build
     * 
     * @return void
     */
    public function __construct(){
        $this->deadline();
    	$this->competition();
    }

    /**
     * check Deadline
     *
     * @return void
     */
    public function deadline() {
        if(_DATENOW < _DATE_START_COMPETITION)
            $this->redirect(_PATH_COMING);
        else if(_DATENOW >= _DATE_END_TAHAP1)
            $this->redirect(_PATH_CLOSED);
    }

	/**
     * Create a new register for all competition
     *
     * @return void
     */
    public function competition() {
    	$error 		= false;

    	$tim 		= $this->filterForm($_POST['tim']);
    	$email 		= $this->filterForm($_POST['email']);
    	$password	= $this->filterForm($_POST['password']);
    	$hp 		= $this->filterForm($_POST['hp']);
    	$instansi	= $this->filterForm($_POST['instansi'], true);
    	$kategori	= abs((int) $_POST['kategori']);
        $info       = $this->filterForm($_POST['info']);

        if($info == 'Lain-lain')
            $info   = $this->filterForm($_POST['other']);
    	
    	/* start validation */
    	$required	= array(
            $tim, $email, $password, $hp, $instansi, $kategori, $info
        );
        
        if($this->isEmpty($required))
			$error = true;
		else if(!$this->isMail($email))
			$error = true;
		else if(!$this->isValidPattern('/[^0-9]/', $hp))
			$error = true;
       
    	/* end validation */
    	if(!$error){
    		$password	= $this->hashPassword($_POST['password']);
    		$code		= sha1(uniqid());
    		$created_at = $this->now;

    	    $query = "INSERT INTO tb_user 
        	(tim, email, password, hp, instansi, kategori, info, code_activate, created_at)
        	VALUES 
        	('$tim', '$email', '$password', '$hp', '$instansi', '$kategori', '$info', '$code', '$created_at')
            ";

            $db = new DB;
            if($db->query($query)){
                $id = $db->insertID();
                
                $subquery = "INSERT INTO tb_detail_user 
                (id) VALUES ('$id')
                ";

                if($db->query($subquery)){
                    $mail = new SendMail;
                    $mail->sendActivate($id);
                    $this->redirect(_PATH_REGIST_COMPETITION.'?success');
                }
            }
            $this->message($this->failed_regist);
	   	}
        else $this->message($this->error_input_regist);
        $this->redirect(_PATH_REGIST_COMPETITION);
    }
}