<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$idDocente = (isset($_POST['idDocente'])) ? $_POST['idDocente'] : '';
$nombreDocente = (isset($_POST['nombreDocente'])) ? $_POST['nombreDocente'] : '';
$domicilioDocente = (isset($_POST['domicilioDocente'])) ? $_POST['domicilioDocente'] : '';
$emailDocente = (isset($_POST['emailDocente'])) ? $_POST['emailDocente'] : '';
$telefonoDocente = (isset($_POST['telefonoDocente'])) ? $_POST['telefonoDocente'] : '';
$tituloDocente = (isset($_POST['tituloDocente'])) ? $_POST['tituloDocente'] : '';


   $consulta = "UPDATE `datos_docentes` SET `nombre`='$nombreDocente ',`domicilio`='$domicilioDocente',`email`='$emailDocente',`telefono`='$telefonoDocente',`titulo`='$tituloDocente' WHERE `idDocente`='$idDocente'";  
     
    $resultado = $conexion->prepare($consulta);
    $resultado->execute(); 



echo 1;
$conexion = NULL;