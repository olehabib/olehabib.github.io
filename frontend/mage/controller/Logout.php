<?php

if(!isset($_SESSION)) session_start();

session_destroy();

if(isset($_SESSION['mage_user']) || isset($_SESSION['mage_admin'])){
	if($_SESSION['mage_user'])
		header("Location:../account/login");
	else if($_SESSION['mage_admin'])
		header("Location:../admin/login");
}
die("Something wrong, my friend!!");
