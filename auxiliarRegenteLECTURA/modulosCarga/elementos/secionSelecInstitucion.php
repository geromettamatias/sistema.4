<?php 
	session_start();

	$selecInstitucion=$_POST['selecInstitucion'];

	$_SESSION['selecInstitucion']=$selecInstitucion;

	echo "1";

 ?>