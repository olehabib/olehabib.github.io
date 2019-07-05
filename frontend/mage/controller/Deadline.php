<?php
require "../../../config.php";

class Deadline
{
    public $isLogin;
    public $user;
    public $ketua;
    public $anggota;

	/**
     * build
     * 
     * @return void
     */
    public function __construct(){
    }   

    public function inESport(){
        $this->check(_DATE_START_ESPORT, _DATE_END_ESPORT);

    }

    public function inWorkshop(){
        $this->check(_DATE_START_WORKSHOP, _DATE_END_WORKSHOP);
    }

    public function inCompetition(){
        $this->check(_DATE_START_COMPETITION, _DATE_END_TAHAP1);
    }

    public function check($start, $end){
        if(_DATENOW < $start)
            $this->redirect(_PATH_COMING);
        else if(_DATENOW >= $end)
            $this->redirect(_PATH_CLOSED);
    }

    public function redirect($path){
        header("Location:".$path);
        die();
    }
}