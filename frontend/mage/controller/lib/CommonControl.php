<?php
require "CommonVariable.php";

class CommonControl extends CommonVariable
{	
	/**
     * build
     * 
     * @return void
     */
    public function __construct(){
    	
    }    

	/**
     * Create redirect path
     * 
     * @return void
     */
	public function redirect($path){
		header("Location:".$path);
		die();
	}

	/**
     * Create session message
     * 
     * @return void
     */
	public function message($message){
		if(!isset($_SESSION)) session_start();
		$_SESSION['message']	= $message;
	}


	/**
     * Create validation empty form
     * 
     * @return boolean
     */
	public function isEmpty($string){
		$result = false;
		if(is_array($string)){
			for($i=0 ; $i<count($string) ; $i++){
				if($string[$i] == ''){
					$result = true;
					break;
				}
			}
		}
		else if($string == '')
			$result = true;

  		return $result;
	}

	
	/**
     * Create validation email form
     * 
     * @return boolean
     */
	public function isMail($string){
		$result = true;
		if(is_array($string)){
			for($i=0 ; $i<count($string) ; $i++){
				if(!filter_var($string[$i], FILTER_VALIDATE_EMAIL)){
					$result = false;
					break;
				}
			}
		}
		else if(!filter_var($string, FILTER_VALIDATE_EMAIL))
			$result = false;
  		
  		return $result;
	}

	/**
     * Create validation url form
     * 
     * @return boolean
     */
	public function isURL($string){
		$result = true;
		if(is_array($string)){
			for($i=0 ; $i<count($string) ; $i++){
				if(!filter_var($string[$i], FILTER_VALIDATE_URL)){
					$result = false;
					break;
				}
			}
		}
		else if(!filter_var($string, FILTER_VALIDATE_URL))
			$result = false;
  		
  		return $result;
	}

	
	/**
     * Create validation pattern form (find )
     * 
     * @return boolean
     */
	public function isValidPattern($pattern, $string){
		$result = true;
		if(is_array($string)){
			for($i=0 ; $i<count($string) ; $i++){
				if(!preg_match($pattern, $string[$i])){
					$result = false;
					break;
				}
			}
		}
		else if(!preg_match($pattern, $string))
			$result = false;

  		return !$result;
  		/**
  		 * Describes any character that is invalid. If preg_match finds a match (an invalid character), it will return 1.
  		 * Furthermore !1 is false and !0 is true. Thus isValidPattern returns false if an invalid character is found and true otherwise.
  		 */
	}

	/**
     * Create validation length form
     * 
     * @return boolean
     */
	public function isValidStrlen($string, $min, $max){
		$result = true;
		if(is_array($string)){
			for($i=0 ; $i<count($string) ; $i++){
				if(!(strlen($string[$i]) >= $min || strlen($string[$i]) <= $max)){
					$result = false;
					break;
				}
			}
		}
		else if(!(strlen($string) >= $min || strlen($string) <= $max))
			$result = false;

  		return $result;
	}

	/**
     * Create filter form
     * 
     * @return string
     */
	public function filterForm($value, $upper= false){
		$db = new DB;
		$value 	= $db->escapeString(addslashes(htmlentities(strip_tags(trim($value)))));
		if($upper)
			$value 	= strtoupper($value); //Uppercase a string
		
		return $value;
	}

	/**
     * Create hashing password
     * 
     * @return string
     */
	public function hashPassword($value){
		return sha1(sha1(md5(sha1($value))));
	}

	/**
     * Create upload image
     *
     * @return boolean
     */
    public function uploadImage($name, $subdir, &$filename){
        if(!isset($_FILES[$name]) || $_FILES[$name]['error'])
    		return false;

        $file       = explode('.', $_FILES[$name]['name']);
        $ext        = count($file) - 1;
        $filename   = $subdir.uniqid("kartu_").'.'.$file[$ext];
        $dir        = "../public/img/";
        $path       = $dir.$filename;
        $tmp        = $_FILES[$name]['tmp_name'];

        $check      = getimagesize($tmp);
        if($check !== false){
        	if($_FILES[$name]['size'] > 1048576){
	        	if($check['mime'] == 'image/jpeg')
	        		$image = imagecreatefromjpeg($tmp);
	        	else if($check['mime'] == 'image/gif')
	        		$image = imagecreatefromgif($tmp);
	        	else if($check['mime'] == 'image/png')
	        		$image = imagecreatefrompng($tmp);

	 	      	imagejpeg($image, $path, 50);
	 	      }
            else move_uploaded_file($tmp, $path);
            return true;
        }
        return false;
    }

    /**
     * Send mail with curl php
     *
     * @return boolean
     */
    public function curlMail($url, $datauser){
	
		$postdatauser = "";
		foreach($datauser as $k => $v){
	    	$postdatauser .=  $k . "=" . $v."&";
		}

		$curlHandle = curl_init();

		curl_setopt($curlHandle, CURLOPT_URL, $url);
		curl_setopt($curlHandle, CURLOPT_HEADER, 0);
		curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 0); // verifiksai ssl host
		curl_setopt($curlHandle, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0); // verifikasi ssl

		curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "POST"); // req method
		curl_setopt($curlHandle, CURLOPT_POST, 1);
		curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $postdatauser); //
		//curl_setopt($curlHandle, CURLOPT_COOKIEFILE, 'cookies.txt'); // set cookie file to given file
		//curl_setopt($curlHandle, CURLOPT_COOKIEJAR, 'cookies.txt'); // set same file as cookie jar

		$result = curl_exec($curlHandle);
		/*if ($result) {
			echo $result;
		}
		else echo curl_error($curlHandle);
		*/
		curl_close($curlHandle);
		return $result;
	}
}