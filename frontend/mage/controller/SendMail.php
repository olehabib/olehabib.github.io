<?php
require "lib/CommonControl.php";

class SendMail extends CommonControl
{
	/**
     * build
     * 
     * @return void
     */
    public function __construct(){

    }

    /**
     * send a mail confirmation
     * 
     * @return boolean
     */
    public function sendConfirm($id, $table = 'tb_user'){
        $query = "SELECT *
            FROM $table WHERE id = '$id'
           ";

        $email = '';
        $kategori = '';
        $tim = '';
        $db = new DB;
        if($result = $db->query($query)){
            while ($data = $result->fetch_assoc()) {
                $tim = ($table == 'tb_workshop') ? $data['nama'] : $data['tim'];
                $email = $data['email'];
                $kategori = $data['kategori'];
            }
            
            if($table == 'tb_user'){
                $type = 'Competition';
                $body = 'Pembayaran telah diterima..<br>
                Silakan masuk ke dalam akun Tim Anda untuk mengirim berkas seleksi.. <br>
                Nantikan pengumuman bagi tim yanng lolos ke tahap selanjutnya dan stay tune di website dan media sosial kami!<br>
                Selamat berkompetisi!';
            }
            else if($table == 'tb_esport'){
                $type = 'E-Sport';
                $nama = ($kategori == 110) ? 'PES 2017' : (($kategori == 120) ? 'DOTA 2' : 'MOBILE LEGENDS');
                $tm = ($kategori == 110) ? '' : 
                    (($kategori == 120) ? 'Jangan lewatkan technical meeting peserta di grup Discord MAGE 2018 pada 19 Januari 2018 pukul 19.00 WIB.' : 
                        'Jangan lewatkan technical meeting peserta di grup Line ML MAGE 2018 pada 26 Januari 2018 pukul 16.00 WIB.');
                
                $body = 'Terima kasih telah melakukan pendaftaran di <b>E-SPORT '.$nama.' MAGE 2018</b>.
                '.$tm.'<br>
                Tetap stay tune di website dan media sosial kami untuk info lebih lanjut.. <br>
                Selamat berkompetisi!';
            }
            else if($table == 'tb_workshop'){
                $type = 'Workshop';
                $nama = ($kategori == 210) ? 'Aplikasi' : 'Web';
                $body = 'Terima kasih telah melakukan pendaftaran <b>workshop '.$nama.' MAGE 2018</b> dan stay tune di website dan media sosial kami untuk mendapatkan informasi jadwal dan pengumuman!';
            }

            $datacurl = array(
                'mailtype' => 'MAGE 2018 - '.$type,
                'subject' => 'Konfirmasi Pembayaran',
                'to' => $email,
                'body' =>
                    'Halo, <b>'.$tim.'</b>! <br>'.$body

            );
            return $this->curlMail(_CURLMAIL, $datacurl);
        }
        return false;
    }

    /**
     * send a mail to activate account
     * 
     * @return boolean
     */
    public function sendActivate($id){
    	$query = "SELECT *
            FROM tb_user WHERE id = '$id'
           ";

        $code = '';
        $email = '';
        $db = new DB;
        if($result = $db->query($query)){
        	while ($data = $result->fetch_assoc()) {
            	$code = $data['code_activate'];
                $email = $data['email'];
            }
            $link = _PATH_ACTIVATE."?email=".$email."&code=".$code;
            $link = urlencode($link);
            
            $datacurl = array(
                'mailtype' => 'MAGE 2018 - Aktivasi Akun',
                'subject' => 'Aktivasi Akun',
                'to' => $email,
                'body' =>
                    'Yeah, pendaftaran berhasil..<br>
                    Klik link berikut untuk mengaktifkan akun Anda<br> '.$link
            );
            return $this->curlMail(_CURLMAIL, $datacurl);
        }
        return false;
    }


    /**
     * send a mail to reset password
     * 
     * @return boolean
     */
    public function sendReset($email){
        $newpass = uniqid("m4g3_");
        $pass = $this->hashPassword($newpass);
        
        $query = "UPDATE tb_user 
            SET password = '$pass'
            WHERE email = '$email'
           ";
           
        $db = new DB;
        if($db->query($query)){
            if($db->affectedRows() > 0){
                $datacurl = array(
                    'mailtype' => 'MAGE 2018 - Reset Password',
                    'subject' => 'Reset Password',
                    'to' => $email,
                    'body' =>
                        'Password baru akun tim Anda :<br>
                        <h1><b>'.$newpass.'</b></h1>'
                );
                return $this->curlMail(_CURLMAIL, $datacurl);
            }
        }
        return false;
    }

}

if(isset($_GET['run'])){
    $mail = new SendMail;
    if($_GET['run'] == "send-activate" && isset($_GET['id'])){
        $id = abs((int) $_GET['id']);
        $mail->message (($mail->sendActivate($id)) ? $mail->success_mail : $mail->failed_mail);

    }
    else if($_GET['run'] == "send-reset" && isset($_GET['email'])){
        $mail->message (($mail->sendReset($_GET['email'])) ? $mail->success_mail : $mail->failed_mail);
    }
    $mail->redirect(_PATH_LOGIN);
}