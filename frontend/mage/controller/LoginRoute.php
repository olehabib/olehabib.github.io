<?php

require "Login.php";

if(isset($_POST['login_user']))
	new Login;
else
	die("Something wrong, my friend!!");
