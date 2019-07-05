<?php
require "lib/CommonControl.php";

class Upload extends CommonControl
{
    public $result;

	 /**
     * build
     * 
     * @return void
     */
    public function __construct(){
        $this->result = true;

        if($_GET['dir'] == 'competiton/'){
            if(!isset($_SESSION)) session_start();
        
            if(!isset($_SESSION['mage_user'])){
                $this->result = false;
            }

            $tahap = $_SESSION['mage_user']['tahap'];

            if(_DATENOW < _DATE_START_TAHAP2 || _DATENOW >= _DATE_END_TAHAP2 || $tahap != 1){
                $this->result = false;
            }
        }

        else if($_GET['dir'] == 'workshop/'){
            if(_DATENOW < _DATE_START_WORKSHOP || _DATENOW >= _DATE_END_WORKSHOP)
                $this->result = false;
        }
    }

    public function image($name, $subdir){
        return ($this->uploadImage($name, $subdir, $filename)) ? 'success:'.$filename : 'false';
    }
}

if(isset($_GET['file']) && isset($_GET['dir'])){
	$upload = new Upload;
    if($upload->result)
	   echo $upload->image($_GET['file'], $_GET['dir']);
}

else{
    die("Something wrong, my friend!!");
}