<?php
	session_start();
	include_once("../config/conector.php");
	include("conexion.php");
	$bdlogin = new conector($server,$username,$usrpassword,$dbname);
	$md5pass = MD5($_POST["password"]);
	$query = "SELECT CONCAT(name,' ',lastname) as nombrecompleto FROM users WHERE aiesecemail =  '".$_POST["useremail"]."' and pass='".$md5pass."'";
	$result = $bdlogin->query($query);
	if( $result->num_rows == 1 ) {
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$resultado = utf8_decode($row['nombrecompleto']);
		$_SESSION["userlogin"]=$resultado;
		echo "--userok--";
	}
	else {
		echo "--loginwrong--";
		session_destroy();
	}
	$bdlogin->close();
?>