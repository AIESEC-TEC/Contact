<?php
session_start();
	if(isset($_SESSION['userlogin'])){
		include_once("../config/conector.php");
		include("../config/conexion.php");
		$bd = new conector($server,$username,$usrpassword,$dbname);
		mysqli_set_charset($bd,'utf8');
		$user_id = $_POST["userId"];
		$consulta = "SELECT * FROM users WHERE idUser='".$user_id."'";
		if ($result = $bd->query($consulta)) {
			$row = $result->fetch_array(MYSQLI_ASSOC);
			// name&lastname[0], cellphone[1], aiesecemail[2],university[3],profesion[4],skype[5],email[6],area[7],LC[8]
			echo $row["name"].' '.$row["lastname"].'<-->'.str_replace(' ', '',$row["cellphone"]).'<-->'.$row["aiesecemail"].'<-->'.$row["university"].'<-->'.$row["profesion"].'<-->'.$row["skype"].'<-->'.$row["email"].'<-->'.$row["area"].'<-->'.$row["local_comitee"].'<-->'.$row["phone"];
			/* free result set */
			$result->close();
		}
	}
	else {
		echo "<--NOUSER-->";
	}
?>