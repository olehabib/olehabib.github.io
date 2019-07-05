<?php

require "Register.php";
require "register/RegisterCompetition.php";
require "register/RegisterESport.php";
require "register/RegisterWorkshop.php";

if(isset($_POST['regist_esport'])){
	$regist = new RegisterESport;
	if(isset($_POST['pes'])){
		$regist->esportPES();
	}
	else if(isset($_POST['dota'])){
		$regist->esportDota();
	}
	else if(isset($_POST['ml'])){
		$regist->esportML();
	}
}
else if(isset($_POST['regist_workshop'])){
	$regist = new RegisterWorkshop;
}
else if(isset($_POST['regist_competition'])){
	$regist = new RegisterCompetition;
}
else{
	die("Something wrong, my friend!!");
}