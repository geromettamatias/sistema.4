<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$idAlumno = (isset($_POST['idAlumno'])) ? $_POST['idAlumno'] : '';
$cuilAlumnos = (isset($_POST['cuilAlumnos'])) ? $_POST['cuilAlumnos'] : '';
$nombreAlumno = (isset($_POST['nombreAlumno'])) ? $_POST['nombreAlumno'] : '';
$domicilioAlumno = (isset($_POST['domicilioAlumno'])) ? $_POST['domicilioAlumno'] : '';
$emailAlumno = (isset($_POST['emailAlumno'])) ? $_POST['emailAlumno'] : '';
$telefonoAlumno = (isset($_POST['telefonoAlumno'])) ? $_POST['telefonoAlumno'] : '';

$discapasidadAlumnos = (isset($_POST['discapasidadAlumnos'])) ? $_POST['discapasidadAlumnos'] : '';
$nombreTutor = (isset($_POST['nombreTutor'])) ? $_POST['nombreTutor'] : '';
$dniTutor = (isset($_POST['dniTutor'])) ? $_POST['dniTutor'] : '';
$TelefonoTutor = (isset($_POST['TelefonoTutor'])) ? $_POST['TelefonoTutor'] : '';



   $consulta = "UPDATE `datosalumnos` SET `nombreAlumnos`='$nombreAlumno ',`cuilAlumnos`='$cuilAlumnos',`domicilioAlumnos`='$domicilioAlumno',`emailAlumnos`='$emailAlumno',`telefonoAlumnos`='$telefonoAlumno',`discapasidadAlumnos`='$discapasidadAlumnos',`nombreTutor`='$nombreTutor',`dniTutor`='$dniTutor',`TelefonoTutor`='$TelefonoTutor' WHERE `idAlumnos`='$idAlumno'";  
     
    $resultado = $conexion->prepare($consulta);
    $resultado->execute(); 

  


echo 1;
$conexion = NULL;