<?php
require "SendMail.php";

class UpdateAdmin extends SendMail
{
	public $id;
	public $table;
    public $pilih;

	/**
     * build
     * 
     * @return void
     */
    public function __construct(){
        if(!isset($_SESSION)) session_start();
        
        if(isset($_SESSION['mage_admin'])){
        	$this->pilih      = $_POST['pilih'];
			
			$ws_action = (
				isset($_POST['ws_confirm']) || 
				isset($_POST['ws_unconfirm']) || 
				isset($_POST['ws_delete'])
        	);

            $es_action = (
                isset($_POST['es_confirm']) || 
                isset($_POST['es_unconfirm']) || 
                isset($_POST['es_delete'])
            );

        	$cm_action = (
				isset($_POST['cm_confirm']) || 
				isset($_POST['cm_unconfirm']) || 
				isset($_POST['cm_delete']) ||
				isset($_POST['cm_password']) ||
				isset($_POST['cm_status']) || 
                isset($_POST['cm_activate'])
        	);

			$action = (
				$ws_action ||
				$cm_action ||
                $es_action
			);


        	$sub = "?table=";
        	if($ws_action){
        		$sub .= "workshop";
        		$this->table = "tb_workshop";
        	}
        	else if($cm_action){
        		$sub .= "competition";
        		$this->table = "tb_user";
        	}
            else if($es_action){
                $sub .= "esport";
                $this->table = "tb_esport";
            }

	        if(count($this->pilih) > 0 && $action){
				$this->id = $this->pilih[0];
				for($no = 1; $no < count($this->pilih); $no++){
					$this->id .= ",{$this->pilih[$no]}";
				}

        		if(isset($_POST['ws_confirm']) || isset($_POST['cm_confirm']) || isset($_POST['es_confirm']) )
	        		$this->confirm(1);
	        	else if(isset($_POST['ws_unconfirm']) || isset($_POST['cm_unconfirm']) || isset($_POST['es_unconfirm']) )
	        		$this->confirm(0);
	        	else if(isset($_POST['ws_delete']) || isset($_POST['cm_delete']) || isset($_POST['es_delete']) )
	        		$this->delete();
	        	else if(isset($_POST['cm_password']))
	        		$this->generatePassword(_GENPASS);
	        	else if(isset($_POST['cm_status']))
	        		$this->status($_POST['status']);
                else if(isset($_POST['cm_activate']))
                    $this->activate(1);
	        }
       		else $this->message($this->no_data);
	        $this->redirect(_PATH_DASHBOARDADM.$sub);
        }
    }   

    /**
     * Update data
     *
     * @return void
     */
    private function confirm($val) {
        $query = "UPDATE $this->table
            SET is_confirm = '$val'
            WHERE id IN ($this->id)
            ";

        $db = new DB;
        if($db->query($query)){
        	$this->message($this->success_data);
            $mail = new SendMail;
            foreach($this->pilih as $pilih)
                $mail->sendConfirm($pilih, $this->table);
        }
        else $this->message($this->failed_save);
    }

    /**
     * Delete data
     *
     * @return void
     */
    private function delete() {
        $query = "UPDATE $this->table
            SET is_delete = '1'
            WHERE id IN ($this->id)
            ";

        $db = new DB;
        if($db->query($query)){
        	$this->message($this->success_data);
        }
        else $this->message($this->failed_save);
    }

    /**
     * Update Password
     *
     * @return void
     */
    private function generatePassword($val) {
    	$val = $this->hashPassword($val);

        $query = "UPDATE $this->table
            SET password = '$val'
            WHERE id IN ($this->id)
            ";

        $db = new DB;
        if($db->query($query)){
        	$this->message($this->success_data);
        }
        else $this->message($this->failed_save);
    }

    /**
     * Update Status
     *
     * @return void
     */
    private function status($val) {
    	if($val != ''){
            $val = (int) $val;
        	$tmp = ($val >= 1)? ', is_confirm = 1' : 
                    (($val != -1) ? ', is_confirm = 0' : '');
        
        	$query = "UPDATE $this->table
                SET tahap = '$val'
                $tmp
                WHERE id IN ($this->id)
                ";

            $db = new DB;
            if($db->query($query)){
            	$this->message($this->success_data);

                if($val == 1){
                    $mail = new SendMail;
                    foreach($this->pilih as $pilih)
                        $mail->sendConfirm($pilih, $this->table);
                }
            }
            else $this->message($this->failed_save);
        }
        else $this->message($this->failed_save);
    }

    /**
     * Activate account
     *
     * @return void
     */
    private function activate($val) {
        $query = "UPDATE $this->table
            SET is_active = '$val'
            WHERE id IN ($this->id)
            ";

        $db = new DB;
        if($db->query($query)){
            $this->message($this->success_data);
        }
        else $this->message($this->failed_save);
    }

}

new UpdateAdmin;