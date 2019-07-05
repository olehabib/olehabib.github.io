<?php
require "Login.php";

class Submit extends Login
{
    /* data tim */
    public $id;
    public $tahap;
    public $is_confirm;
	/* */

	/**
     * build
     * 
     * @return void
     */
    public function __construct(){
        if(!isset($_SESSION)) session_start();
        
        if(!isset($_SESSION['mage_user'])){
            $this->redirect(_PATH_LOGIN);
        }

        $this->id = $_SESSION['mage_user']['id'];
        
        $this->getData($this->id);
        $this->tahap = $_SESSION['mage_user']['tahap'];
        $this->is_confirm = $_SESSION['mage_user']['is_confirm'];
    }   

    /**
     * Submit tahap 1
     *
     * @return void
     */
    public function tahap1() {
        if(_DATENOW < _DATE_START_COMPETITION || _DATENOW >= _DATE_END_TAHAP1 || $this->tahap < 1){
            $this->message($this->time_up);
            $this->redirect(_PATH_DASHBOARD);
        }
        
        $error = false;

        $ketua      = $this->filterForm($_POST['ketua'], true);
        $anggota1   = $this->filterForm($_POST['anggota1'], true);
        $anggota2   = $this->filterForm($_POST['anggota2'], true);
        $kartu      = $this->filterForm($_POST['kartu']);
        $proposal   = $this->filterForm($_POST['proposal']);
        $poster     = $this->filterForm($_POST['poster']);
    
        /* start validation */
        $required   = array(
            $ketua
        );

        $url   = array(
            $kartu, $proposal, $poster
        );
        
        if($this->isEmpty($required))
            $error = true;
        if(!$this->isURL($url))
            $error = true;
        /* end validation */

        if(!$error){
            $query = "UPDATE tb_detail_user
            SET
            ketua = '$ketua',
            anggota1 = '$anggota1',
            anggota2 = '$anggota2'
            WHERE id = '$this->id'
            ";

            $query1 = "UPDATE tb_user
            SET 
            kartu = '$kartu',
            proposal = '$proposal',
            poster = '$poster',
            tahap = '2'
            WHERE id = '$this->id'
            ";
                
            $db = new DB;
            if($db->query($query)){
                if($db->query($query1)){
                    $this->message($this->success_save);
                    $this->getData($this->id);
                }
                else $this->message($this->failed_save);
                
            }
            else $this->message($this->failed_save);
        }
        else $this->message($this->error_input_submit);
        $this->redirect(_PATH_DASHBOARD);
    }

    /**
     * Submit tahap 2
     *
     * @return void
     */
	public function tahap2() {
        if(_DATENOW < _DATE_START_TAHAP2 || _DATENOW >= _DATE_END_TAHAP2 || $this->tahap < 3){
            $this->message($this->time_up);
            $this->redirect(_PATH_DASHBOARD);
        }

        $error = false;

        $progres   = $this->filterForm($_POST['progres']);
        $video     = $this->filterForm($_POST['video']);
    
        /* start validation */
        $url   = array(
            $video, $progres
        );
        
        if(!$this->isURL($url))
            $error = true;
        /* end validation */

        if(!$error){
            $query = "UPDATE tb_user
            SET 
            progres = '$progres',
            video = '$video',
            tahap = '4'
            WHERE id = '$this->id'
            ";

            $db = new DB;
            if($db->query($query)){
                $this->message($this->success_save);
                $this->getData($this->id);
            }
            else $this->message($this->failed_save);
        }
        else $this->message($this->error_input_submit);
        $this->redirect(_PATH_DASHBOARD);
    }

    /**
     * Submit bukti pembayaran
     *
     * @return void
     */
    public function bukti() {
        if(_DATENOW < _DATE_START_COMPETITION || _DATENOW >= _DATE_END_TAHAP1 || $this->tahap != 0){
            $this->message($this->time_up);
            $this->redirect(_PATH_DASHBOARD);
        }

        $error     = false;
        $bukti     = $this->filterForm($_POST['bukti']);

        /* start validation */
        $required   = array(
            $bukti
        );

        if($this->isEmpty($required))
            $error = true;
        /* end validation */

        if(!$error){
            $query = "UPDATE tb_user
            SET 
            bukti = '$bukti',
            tahap = '1'
            WHERE id = '$this->id'
            ";
                
            $db = new DB;
            if($db->query($query)){
                $this->message($this->success_save);
                $this->getData($this->id);
            }
            else $this->message($this->failed_save);
        }
        else $this->message($this->error_input_submit);
        $this->redirect(_PATH_DASHBOARD);
    }   
}