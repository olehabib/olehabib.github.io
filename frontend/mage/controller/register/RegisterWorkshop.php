<?php

class RegisterWorkshop extends Register
{

    /**
     * build
     * 
     * @return void
     */
    public function __construct(){
        $this->deadline();
        $this->workshop();
    }

    /**
     * check Deadline
     *
     * @return void
     */
    public function deadline() {
        if(_DATENOW < _DATE_START_WORKSHOP)
            $this->redirect(_PATH_COMING);
        else if(_DATENOW >= _DATE_END_WORKSHOP)
            $this->redirect(_PATH_CLOSED);
    }

	/**
     * Create a new register for workshop
     *
     * @return void
     */
    public function workshop() {
        $error      = false;

        $nama       = $this->filterForm($_POST['nama'], true);
        $email      = $this->filterForm($_POST['email']);
        $hp         = $this->filterForm($_POST['hp']);
        $instansi   = $this->filterForm($_POST['instansi'], true);
        $info       = $this->filterForm($_POST['info']);
        $kategori   = abs((int) $_POST['kategori']);
        $bukti      = $this->filterForm($_POST['bukti']);

        if($info == 'Lain-lain')
            $info   = $this->filterForm($_POST['other']);

        
        /* start validation */
        $required   = array(
            $nama, $email, $hp, $instansi, $info, $kategori, $bukti
        );

        if($this->isEmpty($required))
            $error = true;
        else if(!$this->isMail($email))
            $error = true;
        else if(!$this->isValidPattern('/[^0-9]/', $hp))
            $error = true;
        
        /* end validation */
        
        if(!$error){
            $query = "SELECT id FROM tb_workshop
            WHERE kategori = '$kategori'
            ";

            $db = new DB;
            if($db->query($query)->num_rows < _MAX_WS){
                $created_at = $this->now;

                $query = "INSERT INTO tb_workshop
                (nama, email, hp, instansi, kategori, bukti, info, created_at)
                VALUES 
                ('$nama', '$email', '$hp', '$instansi', '$kategori', '$bukti', '$info', '$created_at')
                ";
                    
                if($db->query($query)){
                    //echo "success";
                    //$this->message($this->success_regist);
                    $this->redirect(_PATH_REGIST_WORKSHOP.'?success');    
                }
            }
            $this->message($this->failed_regist);
        }
        else $this->message($this->error_input_regist);
        $this->redirect(_PATH_REGIST_WORKSHOP);
    }
    
}