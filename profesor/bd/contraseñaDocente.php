<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$idDocente = (isset($_POST['idDocente'])) ? $_POST['idDocente'] : '';
$contraseñaVieja = (isset($_POST['contraseñaVieja'])) ? $_POST['contraseñaVieja'] : '';
$nuevaContraseña = (isset($_POST['nuevaContraseña'])) ? $_POST['nuevaContraseña'] : '';


$consulta = "SELECT * FROM `datos_docentes` WHERE `idDocente`='$idDocente' AND `passwordDocente`='$contraseñaVieja'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

if($resultado->rowCount() >= 1){
  
    $consulta = "UPDATE `datos_docentes` SET `passwordDocente`='$nuevaContraseña' WHERE `idDocente`='$idDocente'";  
     
    $resultado = $conexion->prepare($consulta);
    $resultado->execute(); 

	session_start();
	session_destroy();
	echo 1;
	$conexion = NULL;

}else{
    
    echo 2;
	$conexion = NULL;
}








   