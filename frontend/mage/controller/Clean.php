<?php
require "../config.php";
require "../model/DB.php";
require "DataAdmin.php";

class Clean extends DataAdmin
{
   
	 /**
     * build
     * 
     * @return void
     */
    public function __construct(){
      	$this->getCompetitionData();
      	$this->getWorkshopData();
      	
      	$cm_dir = '../public/img/competition';
      	$ws_dir = '../public/img/workshop';
		
		$cm_leave_files = array();
		for($i = 0; $i < count($this->competition); $i++){
        	if($this->competition[$i]['bukti'] != ''){
	       		$data = explode('/', $this->competition[$i]['bukti']);
	       		$cm_leave_files[] = $data[1];
	       	}
       	}
       	$ws_leave_files = array();
       	for($i = 0; $i < count($this->workshop); $i++){
        	if($this->workshop[$i]['bukti'] != ''){
	       		$data = explode('/', $this->workshop[$i]['bukti']);
	       		$ws_leave_files[] = $data[1];
	       	}
       	}

       	$cm_file = (array) glob("$cm_dir/*.jpg");
       	$ws_file = (array) glob("$ws_dir/*.jpg");

       	if($cm_file[0] != ''){
	       	foreach($cm_file as $file ) {
				if( !in_array(basename($file), $cm_leave_files) )
				    unlink($file);
			}
		}

		if($ws_file[0] != ''){
			foreach($ws_file as $file) {
				if( !in_array(basename($file), $ws_leave_files) )
				    unlink($file);
			}
		}
    }

}

if(!isset($_SESSION)) session_start();

if(isset($_SESSION['mage_admin']) && isset($_GET['run'])){
	new Clean();
	$_SESSION['message'] = "Okay, cleaned..";
	header("Location:"._PATH_DASHBOARDADM);
	die();
}
else{
	die("Something wrong, my friend!!");
}