<?php

class DataAdmin extends DB
{
    /* data */
    public $competition;
    public $num_game_p;
    public $num_game_m;
    public $num_app_p;
    public $num_app_m;
    public $num_iot_m;
    public $num_com_confirm;
    public $num_com_unconfirm;
    public $num_com_all;

    public $workshop;
    public $num_ws_web_confirm;
    public $num_ws_web_unconfirm;
    public $num_ws_app_confirm;
    public $num_ws_app_unconfirm;
    public $num_ws_web;
    public $num_ws_app;

    public $esport;
    public $num_es_pes_confirm;
    public $num_es_pes_unconfirm;
    public $num_es_dota_confirm;
    public $num_es_dota_unconfirm;
    public $num_es_ml_confirm;
    public $num_es_ml_unconfirm;

    public $gen_pass = _GENPASS;
    public $detail;
	/* */

	/**
     * build
     * 
     * @return void
     */
    public function __construct(){
        
    }  

    /**
     * Get data admin
     *
     * @return void
     */
    public function getSummary() {
        $db = new DB;

        $query = "SELECT id FROM tb_user
        WHERE is_delete = 0 AND ";

        $this->num_game_p = ($result = $db->query($query.'kategori = 311')) ? $result->num_rows : 0;
        $this->num_game_m = ($result = $db->query($query.'kategori = 312')) ? $result->num_rows : 0;
        $this->num_app_p = ($result = $db->query($query.'kategori = 321')) ? $result->num_rows : 0;
        $this->num_app_m = ($result = $db->query($query.'kategori = 322')) ? $result->num_rows : 0;
        $this->num_iot_m = ($result = $db->query($query.'kategori = 332')) ? $result->num_rows : 0;

        $this->num_com_confirm = ($result = $db->query($query.'is_confirm = 1')) ? $result->num_rows : 0;
        $this->num_com_unconfirm = ($result = $db->query($query.'is_confirm = 0')) ? $result->num_rows : 0;
        $this->num_com_all = $this->num_com_confirm + $this->num_com_unconfirm; 

        $query = "SELECT id FROM tb_workshop
        WHERE is_delete = 0 AND ";

        $this->num_ws_web_confirm = ($result = $db->query($query.'kategori = 220 AND is_confirm = 1')) ? $result->num_rows : 0;
        $this->num_ws_web_unconfirm = ($result = $db->query($query.'kategori = 220 AND is_confirm = 0')) ? $result->num_rows : 0;
        $this->num_ws_web = $this->num_ws_web_confirm + $this->num_ws_web_unconfirm;
        $this->num_ws_app_confirm = ($result = $db->query($query.'kategori = 210 AND is_confirm = 1')) ? $result->num_rows : 0;
        $this->num_ws_app_unconfirm = ($result = $db->query($query.'kategori = 210 AND is_confirm = 0')) ? $result->num_rows : 0;
        $this->num_ws_app = $this->num_ws_app_confirm + $this->num_ws_app_unconfirm;
        
        $query = "SELECT id FROM tb_esport
        WHERE is_delete = 0 AND ";

        $this->num_es_pes_confirm = ($result = $db->query($query.'kategori = 110 AND is_confirm = 1')) ? $result->num_rows : 0;
        $this->num_es_pes_unconfirm = ($result = $db->query($query.'kategori = 110 AND is_confirm = 0')) ? $result->num_rows : 0;
        $this->num_es_dota_confirm = ($result = $db->query($query.'kategori = 120 AND is_confirm = 1')) ? $result->num_rows : 0;
        $this->num_es_dota_unconfirm = ($result = $db->query($query.'kategori = 120 AND is_confirm = 0')) ? $result->num_rows : 0;
        $this->num_es_ml_confirm = ($result = $db->query($query.'kategori = 130 AND is_confirm = 1')) ? $result->num_rows : 0;
        $this->num_es_ml_unconfirm = ($result = $db->query($query.'kategori = 130 AND is_confirm = 0')) ? $result->num_rows : 0;
        
    }    

    /**
     * Get data competition
     *
     * @return void
     */
	public function getCompetitionData() {
        $query = "SELECT *, 
            tb_user.id AS id_user,
            DATE_FORMAT(created_at, '%d-%m-%Y') AS created_at
            FROM tb_user, tb_detail_user, tb_kategori_kompetisi
            WHERE tb_user.id = tb_detail_user.id
            AND tb_user.kategori = tb_kategori_kompetisi.id
            AND tb_user.is_delete = '0'
            ORDER BY tb_user.tahap DESC, tb_user.id DESC
            ";
                
        $db = new DB;
        if($result = $db->query($query)){
            while ($data = $result->fetch_assoc()) {
                $this->competition[] = array(
                    'id' => $data['id_user'],
                    'no' => ($data['no_ref'] + $data['id_user']),
                    'tim' => $data['tim'],
                    'ketua' => $data['ketua'],
                    'anggota1' => $data['anggota1'],
                    'anggota2' => $data['anggota2'],
                    'email' => $data['email'],
                    'hp' => $data['hp'],
                    'instansi' => $data['instansi'],
                    'kategori' => $data['nama'],
                    'id_kategori' => $data['kategori'],
                    'tahap' => $data['tahap'],
                    'is_confirm' => $data['is_confirm'],
                    'proposal' => $data['proposal'],
                    'poster' => $data['poster'],
                    'progres' => $data['progres'],
                    'video' => $data['video'],
                    'kartu' => $data['kartu'],
                    'bukti' => $data['bukti'],
                    'info' => $data['info'],
                    'created_at' => $data['created_at'],
                    'updated_at' => $data['updated_at'],
                    'is_active' => $data['is_active']
                );
            }
        }
    }

    /**
     * Get data workshop
     *
     * @return void
     */
    public function getEsportData() {
        $query = "SELECT *,
            tb_esport.id AS id_user,
            DATE_FORMAT(created_at, '%d-%m-%Y') AS created_at
            FROM tb_esport
            INNER JOIN tb_kategori_esport
            ON tb_esport.kategori = tb_kategori_esport.id
            WHERE tb_esport.is_delete = '0'
            ORDER BY tb_esport.id DESC
            ";
                
        $db = new DB;
        if($result = $db->query($query)){
            while ($data = $result->fetch_assoc()) {
                $this->esport[] = array(
                    'id' => $data['id_user'],
                    'no' => ($data['no_ref'] + $data['id_user']),
                    'tim' => $data['tim'],
                    'email' => $data['email'],
                    'hp' => $data['hp'],
                    'line' => $data['line'],
                    'kategori' => $data['nama'],
                    'id_kategori' => $data['kategori'],
                    'info' => $data['info'],
                    'is_confirm' => $data['is_confirm'],
                    'created_at' => $data['created_at']
                );
            }
        }
    }  

    /**
     * Get data workshop
     *
     * @return void
     */
    public function getWorkshopData() {
        $query = "SELECT *,
            tb_workshop.id AS id_user, 
            tb_workshop.nama AS nama_user, 
            DATE_FORMAT(created_at, '%d-%m-%Y') AS created_at
            FROM tb_workshop
            INNER JOIN tb_kategori_workshop
            ON tb_workshop.kategori = tb_kategori_workshop.id
            WHERE tb_workshop.is_delete = '0'
            ORDER BY tb_workshop.id DESC
            ";
                
        $db = new DB;
        if($result = $db->query($query)){
            while ($data = $result->fetch_assoc()) {
                $this->workshop[] = array(
                    'id' => $data['id_user'],
                    'no' => ($data['no_ref'] + $data['id_user']),
                    'nama' => $data['nama_user'],
                    'email' => $data['email'],
                    'hp' => $data['hp'],
                    'instansi' => $data['instansi'],
                    'kategori' => $data['nama'],
                    'id_kategori' => $data['kategori'],
                    'bukti' => $data['bukti'],
                    'info' => $data['info'],
                    'is_confirm' => $data['is_confirm'],
                    'created_at' => $data['created_at']
                );
            }
        }
    }

    /**
     * Get detail
     *
     * @return void
     */
    public function getDetail($id) {
        $id = abs((int) $id);

        $query = "SELECT *
            FROM tb_detail_esport, tb_esport
            WHERE tb_detail_esport.id = $id
            AND tb_detail_esport.id = tb_esport.id
            ORDER BY status ASC
            ";
                
        $db = new DB;
        if($result = $db->query($query)){
            while ($data = $result->fetch_assoc()) {
                $this->detail[] = array(
                    'kategori' => $data['kategori'],
                    'nama' => $data['nama'],
                    'link' => $data['link'],
                    'status' => $data['status']
                );
            }
        }
    }   
}