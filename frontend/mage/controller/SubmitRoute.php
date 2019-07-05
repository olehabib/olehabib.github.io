<?php

require "Submit.php";

$sub = new Submit;

if(isset($_POST['sub_tahap1'])){
	$sub->tahap1();
}
else if(isset($_POST['sub_tahap2'])){
	$sub->tahap2();
}
else if(isset($_POST['sub_bukti'])){
	$sub->bukti();
}
else{
	die("Something wrong, my friend!!");
}