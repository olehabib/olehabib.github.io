<?php

require "../config.php";
require "../model/DB.php";

class CommonVariable extends DB
{
	public $now = _DATENOW;

	/* error */
	public $error_input_regist = "Registration failed. Please fill the forms correctly!!";
	public $error_input_login = "Login failed. Please fill the forms correctly!!";
	public $error_input_submit = "Save failed. Please fill the forms correctly!!";

	/* success */
	public $success_regist = "Yes!!";
	public $success_save = "Save successfully! ";
	public $success_mail = "Request have been sent to your email! ";

	/* failed */
	public $failed_regist = "Oops!! Registration failed!! Email was used another one!";
	public $failed_regist_esport = "Oops!! Registration failed!! Team's name was used another one!";
	public $failed_login = "Oops!! Your email or password is invalid!";
	public $failed_save = "Oops!! Something wrong! Try again! ";
	public $failed_mail = "Failed send request to your email! ";
	public $time_up = "Sorry the forms was closed!!<br> The forms is disabled! [Read Only]";

	/* admin */
	public $no_data = "Tidak ada data terpilih";
	public $success_data = "Data berhasil diubah";
}