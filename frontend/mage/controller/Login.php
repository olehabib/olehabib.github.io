<?php
require "lib/CommonControl.php";

class Login extends CommonControl
{
    /* data tim */
    public $id;
    public $user;
	public $detail;
	/* */

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

        $email      = $this->filterForm($_POST['email']);
        $password   = $this->filterForm($_POST['password']);
    
        /* start validation */
        $required   = array(
            $email, $password
        );

        if($this->isEmpty($required))
            $error = true;
        else if(!$this->isMail($email))
            $error = true;
        /* end validation */

        if(!$error){
            $password   = $this->hashPassword($_POST['password']);
            
            $query = "SELECT id, is_active 
            FROM tb_user
            WHERE email = '$email' AND password = '$password'
            ";
                
            $db = new DB;
            if($result = $db->query($query)){
                if($result->num_rows > 0){
                    while ($data = $result->fetch_assoc()) {
                        $this->id = $data['id'];
                        $is_active = $data['is_active'];
                    }
                    if($is_active){
                        $this->getData($this->id);
                        $this->redirect(_PATH_DASHBOARD);
                    }
                    else{
                        $unactive_account = 
                            "Account is not active!!<br>
                            Please check your email to activate your account!<br>
                            Don't receive it?
                            <a href='../controller/SendMail.php?run=send-activate&id=$this->id' style='color:#7a4c03'>
                            <b>Send Again</b>
                            </a>";
                        $this->message($unactive_account);
                        $this->redirect(_PATH_LOGIN);
                    }
                }
            }
            $this->message($this->failed_login);
        }
        else $this->message($this->error_input_login);
        $this->redirect(_PATH_LOGIN);
    }

    /**
     * Get data user
     *
     * @return void
     */
	public function getData($id) {
        $this->id = $id;

        $query = "SELECT *, tb_kategori_kompetisi.id AS kategori_id
            FROM tb_user
            INNER JOIN tb_kategori_kompetisi
            ON tb_user.kategori = tb_kategori_kompetisi.id
            AND tb_user.id = '$this->id'
            ";
                
        $db = new DB;
        if($result = $db->query($query)){
            while ($data = $result->fetch_assoc()) {
                $this->user = array(
                    'id' => $this->id,
                    'no' => ($data['no_ref'] + $this->id),
                    'tim' => $data['tim'],
                    'email' => $data['email'],
                    'hp' => $data['hp'],
                    'instansi' => $data['instansi'],
                    'kategori' => $data['nama'],
                    'kategori_id' => $data['kategori_id'],
                    'tahap' => $data['tahap'],
                    'is_confirm' => $data['is_confirm'],
                    'proposal' => $data['proposal'],
                    'progres' => $data['progres'],
                    'poster' => $data['poster'],
                    'video' => $data['video'],
                    'kartu' => $data['kartu'],
                    'bukti' => $data['bukti']
                );
            }
        }


        $query = "SELECT *
            FROM tb_detail_user
            WHERE id = '$this->id';
            ";
                
        if($result = $db->query($query)){
            while ($data = $result->fetch_assoc()) {
                $this->detail = array(
                    'ketua' => $data['ketua'],
                    'anggota1' => $data['anggota1'],
                    'anggota2' => $data['anggota2']
                );
            }
        }
        
        $_SESSION ['mage_user'] = $this->user;
        $_SESSION ['mage_detail'] = $this->detail;
    }   
}