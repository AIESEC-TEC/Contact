<?php
	session_start();
	if(isset($_SESSION['userlogin'])){
	  unset($_SESSION['userlogin']);
	}
	session_destroy();
?>