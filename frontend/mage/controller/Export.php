<?php

require "../config.php";
require "../model/DB.php";
require "DataAdmin.php";

class Export extends DataAdmin
{
    public $nama_file;

	/**
     * build
     * 
     * @return void
     */
    public function __construct(){
        if(!isset($_SESSION)) session_start();
        
        if($_SESSION['mage_admin']){
            if(isset($_GET['export'])){
                $this->nama_file = (isset($_GET['nama'])) ? $_GET['nama'] : 'data';

                // Fungsi header dengan mengirimkan raw data excel
                header("Content-type: application/vnd-ms-excel");
                 
                // Mendefinisikan nama file ekspor "hasil-export.xls"
                header("Content-Disposition: attachment; filename=".$this->nama_file.".xls"); 

                if($_GET['export'] == 'workshop')
                    $this->exportWS();
                else if($_GET['export'] == 'competition')
                    $this->exportCM();
                else if($_GET['export'] == 'esport')
                    $this->exportES();
            }         
        }
        else die("Something wrong, my friend!!");
    } 

    /**
     *
     * 
     * @return void
     */
    public function exportWS(){
       $this->getWorkshopData();

        echo "
            <table border='1px'>
                <tr bgcolor='#00FF00' bordercolor='#000000'>
                    <th class='center'> NO </th>
                    <th class='center'> ID </th>
                    <th class='center'> NAMA </th>
                    <th class='center'> BAYAR </th>
                    <th class='center'> EMAIL </th>
                    <th class='center'> HP </th>
                    <th class='center'> KATEGORI </th>
                    <th class='center'> INSTANSI </th>
                    <th class='center'> INFO </th>
                    <th class='center'> CREATED AT </th>
                </tr>
        ";

        for($i = 0; $i < count($this->workshop); $i++){
            $no = $i + 1;

            $confirm = 'Belum';
            $status = 'background-color:pink;';
                            
            if($this->workshop[$i]['is_confirm']){
                $confirm = 'Sudah';
                $status = '';
            }     

            echo"
                <tr>
                    <td class='center'>
                        {$no}
                    </td>
                    <td class='center'>
                        {$this->workshop[$i]['no']}
                    </td>
                    <td class='center'>
                        {$this->workshop[$i]['nama']}
                    </td>
                    <td class='center' style='{$status}'>
                        {$confirm}
                    </td>
                    <td class='center'>
                        {$this->workshop[$i]['email']}
                    </td>
                    <td class='center'>
                        {$this->workshop[$i]['hp']}
                    </td>
                    <td class='center'>
                        {$this->workshop[$i]['kategori']}
                    </td>
                    <td class='center'>
                        {$this->workshop[$i]['instansi']}
                    </td>
                    <td class='center'>
                        {$this->workshop[$i]['info']}
                    </td>
                    <td class='center'>
                        {$this->workshop[$i]['created_at']}
                    </td>
                </tr>
            ";
                        
        }
        echo "</table>";
    }

    /**
     *
     * 
     * @return void
     */
    public function exportCM(){
       $this->getCompetitionData();

        echo "
            <table border='1px'>
                <tr bgcolor='#00FF00' bordercolor='#000000'>
                    <th class='center'> NO </th>
                    <th class='center'> ID (Referensi)</th>
                    <th class='center'> TIM </th>
                    <th class='center'> TAHAP </th>
                    <th class='center'> BAYAR </th>
                    <th class='center'> KETUA </th>
                    <th class='center'> ANGGOTA 1 </th>
                    <th class='center'> ANGGOTA 2 </th>
                    <th class='center'> EMAIL </th>
                    <th class='center'> HP </th>
                    <th class='center'> KATEGORI </th>
                    <th class='center'> INSTANSI </th>
                    <th class='center'> INFO </th>
                    <th class='center'> CREATED AT </th>
                    <th class='center'> KARTU </th>
                    <th class='center'> PROPOSAL </th>
                    <th class='center'> POSTER </th>
                    <th class='center'> VIDEO </th>
                </tr>
        ";

        for($i = 0; $i < count($this->competition); $i++){
            $no = $i + 1;

            $proposal = '';
            $poster = '';
            $video = '';
            $kartu = '';
            $confirm = 'Belum';
            $status = 'background-color:pink;';
            $status_tahap = '';
                            
            if($this->competition[$i]['is_confirm']){
                $confirm = 'Sudah';
                $status = '';
            }
            $status_active = ($this->competition[$i]['is_active']) ? '' : 'background-color:pink;';

            if($this->competition[$i]['proposal'] != ''){
                $proposal = "<a href='{$this->competition[$i]['proposal']}' target='_blank' style='color:blue;'>{$this->competition[$i]['proposal']}</a>";
            }
            if($this->competition[$i]['poster'] != ''){
                $poster = "<a href='{$this->competition[$i]['poster']}' target='_blank' style='color:blue;'>{$this->competition[$i]['poster']}</a>";
            }
            if($this->competition[$i]['video'] != ''){
                $video = "<a href='{$this->competition[$i]['video']}' target='_blank' style='color:blue;'>{$this->competition[$i]['video']}</a>";
            }
            if($this->competition[$i]['kartu'] != ''){
                $kartu = "<a href='{$this->competition[$i]['kartu']}' target='_blank' style='color:blue;'>{$this->competition[$i]['kartu']}</a>";
            }
            if($this->competition[$i]['tahap'] == 0 && $this->competition[$i]['proposal'] != '' && $this->competition[$i]['poster'] != '' && $this->competition[$i]['kartu'] != ''){
                $status_tahap = "background-color:yellow;";
            }
            else if($this->competition[$i]['tahap'] == 2 && !$this->competition[$i]['is_confirm']){
                $status_tahap = "background-color:#0ff;";
            }

            if($this->competition[$i]['tahap'] == -1)
                $tahap = 'Tidak Lolos';
            else if($this->competition[$i]['tahap'] == 0)
                $tahap = 'Tahap 1';
            else if($this->competition[$i]['tahap'] == 1)
                $tahap = 'Tahap 2 - Menunggu Pembayaran';
            else if($this->competition[$i]['tahap'] == 2 && !$this->competition[$i]['is_confirm'])
                $tahap = 'Tahap 2 - Verifikasi Pembayaran';
            else if($this->competition[$i]['tahap'] == 2 && $this->competition[$i]['is_confirm'])
                $tahap = 'Tahap 2 - Pembayaran Diterima';
            else if($this->competition[$i]['tahap'] == 3)
                $tahap = 'Tahap 2 - Upload Video';
            else if($this->competition[$i]['tahap'] == 4)
                $tahap = 'Grand Final';

            echo"
                <tr>
                    <td class='center' style='{$status_active}'>
                        {$no}
                    </td>
                    <td class='center'>
                        {$this->competition[$i]['no']}
                    </td>
                    <td class='center'>
                        {$this->competition[$i]['tim']}
                    </td>
                    <td class='center' style='{$status}'>
                        {$confirm}
                    </td>
                    <td class='center' style='{$status_tahap}'>
                        {$tahap}
                    </td>
                    <td class='center'>
                        {$this->competition[$i]['ketua']}
                    </td>
                    <td class='center'>
                        {$this->competition[$i]['anggota1']}
                    </td>
                    <td class='center'>
                        {$this->competition[$i]['anggota2']}
                    </td>
                    <td class='center'>
                        {$this->competition[$i]['email']}
                    </td>
                    <td class='center'>
                        {$this->competition[$i]['hp']}
                    </td>
                    <td class='center'>
                        {$this->competition[$i]['kategori']}
                    </td>
                    <td class='center'>
                        {$this->competition[$i]['instansi']}
                    </td>
                    <td class='center'>
                        {$this->competition[$i]['info']}
                    </td>
                    <td class='center'>
                        {$this->competition[$i]['created_at']}
                    </td>
                    <td class='center'>
                        {$kartu}
                    </td>
                    <td class='center'>
                        {$proposal}
                    </td>
                    <td class='center'>
                        {$poster}
                    </td>
                    <td class='center'>
                        {$video}
                    </td>
                </tr>
            ";
                        
        }
        echo "</table>";
    }


    /**
     *
     * 
     * @return void
     */
    public function exportES(){
       $this->getEsportData();

       echo "
            <table border='1px'>
                <tr bgcolor='#00FF00' bordercolor='#000000'>
                    <th class='center'> NO </th>
                    <th class='center'> ID </th>
                    <th class='center'> TIM </th>
                    <th class='center'> BAYAR </th>
                    <th class='center'> EMAIL </th>
                    <th class='center'> HP </th>
                    <th class='center'> KATEGORI </th>
                    <th class='center'> INFO </th>
                    <th class='center'> CREATED AT </th>
                    <th class='center'> KETUA </th>
                    <th class='center'> ANGGOTA1 </th>
                    <th class='center'> ANGGOTA2 </th>
                    <th class='center'> ANGGOTA3 </th>
                    <th class='center'> ANGGOTA4 </th>
                    <th class='center'> STANDIN1 </th>
                    <th class='center'> STANDIN2 </th>
                </tr>
        ";

        for($i = 0; $i < count($this->esport); $i++){
            $this->getDetail($this->esport[$i]['id']);
            $no = $i + 1;

            $confirm = 'Belum';
            $status = 'background-color:pink;';
                            
            if($this->esport[$i]['is_confirm']){
                $confirm = 'Sudah';
                $status = '';
            }     

            echo"
                <tr>
                    <td class='center'>
                        {$no}
                    </td>
                    <td class='center'>
                        {$this->esport[$i]['no']}
                    </td>
                    <td class='center'>
                        {$this->esport[$i]['tim']}
                    </td>
                    <td class='center' style='{$status}'>
                        {$confirm}
                    </td>
                    <td class='center'>
                        {$this->esport[$i]['email']}
                    </td>
                    <td class='center'>
                        {$this->esport[$i]['hp']}
                    </td>
                    <td class='center'>
                        {$this->esport[$i]['kategori']}
                    </td>
                    <td class='center'>
                        {$this->esport[$i]['info']}
                    </td>
                    <td class='center'>
                        {$this->esport[$i]['created_at']}
                    </td>
            ";

            for ($j=0; $j < count($this->detail); $j++){
                echo "
                    <td class='center'>
                        {$this->detail[$j]['nama']}
                    </td>
                ";
            }
            echo "

                </tr>
            ";
            $this->detail = null;
                        
        }
        echo "</table>";
    }
   
}


new Export;