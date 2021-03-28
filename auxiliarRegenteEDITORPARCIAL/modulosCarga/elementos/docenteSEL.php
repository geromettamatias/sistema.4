<?php 
	session_start();

	$idDocente=$_POST['idDocente'];
	$_SESSION['docenteSEL']=$idDocente;

	echo $idDocente;
	


 ?>