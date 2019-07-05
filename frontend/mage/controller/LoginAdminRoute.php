<?php

require "LoginAdmin.php";

if(isset($_POST['login_admin']))
	new LoginAdmin;
else
	die("Something wrong, my friend!!");
