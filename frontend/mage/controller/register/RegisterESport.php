<?php

class RegisterESport extends Register
{   
    public $tim;
    public $email;
    public $hp;
    public $line;
    public $info;
    public $error;
    public $query;

    /**
     * build
     * 
     * @return void
     */
    public function __construct(){
        $this->deadline();

        $this->tim        = $this->filterForm($_POST['tim']);
        $this->email      = $this->filterForm($_POST['email']);
        $this->hp         = $this->filterForm($_POST['hp']);
        $this->line       = $this->filterForm($_POST['line']);
        $this->info       = $this->filterForm($_POST['info']);
        
        if($info == 'Lain-lain')
            $info   = $this->filterForm($_POST['other']);

        $required   = array(
            $this->tim,
            $this->email,
            $this->hp,
            $this->info,
            $this->line
        );

        $this->error = false;
        if($this->isEmpty($required))
            $this->error = true;
        else if(!$this->isMail($this->email))
            $this->error = true;
        else if(!$this->isValidPattern('/[^0-9]/', $this->hp))
            $this->error = true;

    }

    /**
     * check Deadline
     *
     * @return void
     */
    public function deadline() {
        if(_DATENOW < _DATE_START_ESPORT)
            $this->redirect(_PATH_COMING);
        else if(_DATENOW >= _DATE_END_ESPORT)
            $this->redirect(_PATH_CLOSED);
    }

    public function setQuery($kategori){
        $this->query = "INSERT INTO tb_esport
            (tim, email, hp, line, kategori, info, created_at)
            VALUES (
                '$this->tim',
                '$this->email', 
                '$this->hp', 
                '$this->line', 
                '$kategori', 
                '$this->info', 
                '$this->now'
            )";
    }

	/**
     * Create a new register for e-sport PES
     *
     * @return void
     */
    public function esportPES() {
        $ketua      = $this->filterForm($_POST['ketua'], true);
        $anggota1   = $this->filterForm($_POST['anggota1'], true);

    	/* start validation */
    	$required	= array(
            $ketua, $anggota1
        );

        if($this->isEmpty($required))
			$this->error = true;
    	/* end validation */
    	
        if(!$this->error){
            $this->setQuery(110);
            
            $db = new DB;
            if($db->query($this->query)){
                $id = $db->insertID();
    
                $subquery = "INSERT INTO tb_detail_esport
                (id, nama, status)
                VALUES
                ('$id', '$ketua', '0'),
                ('$id', '$anggota1', '1')
                ";
                    
                if($db->query($subquery)){
                    //$this->message($this->success_regist);
                    $this->redirect(_PATH_REGIST_ESPORT."?success&k=PES2017&n={$this->tim}&p=60.000");
                } 
            }
            $this->message($this->failed_regist_esport);
	   	}
        else $this->message($this->error_input_regist);
        $this->redirect(_PATH_REGIST_ESPORT);
    }


    /**
     * Create a new register for e-sport Dota2
     *
     * @return void
     */
    public function esportDota() {
        $ketua      = $this->filterForm($_POST['ketua'], true);
        $anggota1   = $this->filterForm($_POST['anggota1'], true);
        $anggota2   = $this->filterForm($_POST['anggota2'], true);
        $anggota3   = $this->filterForm($_POST['anggota3'], true);
        $anggota4   = $this->filterForm($_POST['anggota4'], true);
        $standin1   = $this->filterForm($_POST['standin1'], true);
        $standin2   = $this->filterForm($_POST['standin2'], true);
        $linkK      = $this->filterForm($_POST['linkK']);
        $linkA1     = $this->filterForm($_POST['linkA1']);
        $linkA2     = $this->filterForm($_POST['linkA2']);
        $linkA3     = $this->filterForm($_POST['linkA3']);
        $linkA4     = $this->filterForm($_POST['linkA4']);
        $linkS1     = $this->filterForm($_POST['linkS1']);
        $linkS2     = $this->filterForm($_POST['linkS2']);
        
        /* start validation */
        $required = array(
            $ketua, $anggota1, $anggota2, $anggota3, $anggota4
        );

        $url = array(
            $linkK, $linkA1, $linkA2, $linkA3, $linkA4
        );

        if(!$this->isEmpty($standin1))
            $url[] = $linkS1;
        if(!$this->isEmpty($standin2))
            $url[] = $linkS2;
        
        if($this->isEmpty($required))
            $this->error = true;
        else if(!$this->isURL($url))
            $this->error = true;
        /* end validation */

        if(!$this->error){
            $this->setQuery(120);
            
            $db = new DB;
            if($db->query($this->query)){
                $id = $db->insertID();
    
                $subquery = "INSERT INTO tb_detail_esport
                (id, nama, link, status)
                VALUES
                ('$id', '$ketua', '$linkK', '0'),
                ('$id', '$anggota1', '$linkA1', '1'),
                ('$id', '$anggota2', '$linkA2', '1'),
                ('$id', '$anggota3', '$linkA3', '1'),
                ('$id', '$anggota4', '$linkA4', '1'),
                ('$id', '$standin1', '$linkS1', '2'),
                ('$id', '$standin2', '$linkS2', '2')
                ";
                    
                if($db->query($subquery)){
                    //$this->message($this->success_regist);
                    $this->redirect(_PATH_REGIST_ESPORT."?success&k=DOTA2&n={$this->tim}&p=100.000");
                }  
            }
            $this->message($this->failed_regist_esport);
        }

        else $this->message($this->error_input_regist);
        $this->redirect(_PATH_REGIST_ESPORT);
    }

     /**
     * Create a new register for e-sport ML
     *
     * @return void
     */
    public function esportML() {
        $ketua      = $this->filterForm($_POST['ketua'], true);
        $anggota1   = $this->filterForm($_POST['anggota1'], true);
        $anggota2   = $this->filterForm($_POST['anggota2'], true);
        $anggota3   = $this->filterForm($_POST['anggota3'], true);
        $anggota4   = $this->filterForm($_POST['anggota4'], true);
        $standin1   = $this->filterForm($_POST['standin1'], true);
        $linkK      = $this->filterForm($_POST['linkK']);
        $linkA1     = $this->filterForm($_POST['linkA1']);
        $linkA2     = $this->filterForm($_POST['linkA2']);
        $linkA3     = $this->filterForm($_POST['linkA3']);
        $linkA4     = $this->filterForm($_POST['linkA4']);
        $linkS1     = $this->filterForm($_POST['linkS1']);
        
        /* start validation */
        $required = array(
            $ketua, $anggota1, $anggota2, $anggota3, $anggota4
        );

        $url = array(
            $linkK, $linkA1, $linkA2, $linkA3, $linkA4
        );

        if(!$this->isEmpty($standin1))
            $url[] = $linkS1;
        
        if($this->isEmpty($required))
            $this->error = true;
        else if($this->isEmpty($url))
            $this->error = true;
        /* end validation */

        if(!$this->error){
            $this->setQuery(130);
            
            $db = new DB;
            if($db->query($this->query)){
                $id = $db->insertID();
    
                $subquery = "INSERT INTO tb_detail_esport
                (id, nama, link, status)
                VALUES
                ('$id', '$ketua', '$linkK', '0'),
                ('$id', '$anggota1', '$linkA1', '1'),
                ('$id', '$anggota2', '$linkA2', '1'),
                ('$id', '$anggota3', '$linkA3', '1'),
                ('$id', '$anggota4', '$linkA4', '1'),
                ('$id', '$standin1', '$linkS1', '2')
                ";
                    
                if($db->query($subquery)){
                    //$this->message($this->success_regist);
                    $this->redirect(_PATH_REGIST_ESPORT."?success&k=ML&n={$this->tim}&p=50.000");
                }  
            }
            $this->message($this->failed_regist_esport);
        }

        else $this->message($this->error_input_regist);
        $this->redirect(_PATH_REGIST_ESPORT);
    }
}