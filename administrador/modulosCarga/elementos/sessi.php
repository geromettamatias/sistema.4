<?php 
	session_start();

	$cicloLectivoFINAL=$_POST['cicloLectivoFINAL'];
	$_SESSION['cicloLectivoFINAL']=$cicloLectivoFINAL;

	echo $cicloLectivoFINAL;
	


 ?>