<?php
session_start();

include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//recepción de datos enviados mediante POST desde ajax
$dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
$cuil = (isset($_POST['cuil'])) ? $_POST['cuil'] : '';

$consulta = "SELECT * FROM datosalumnos WHERE dniAlumnos='$dni' AND dniAlumnos='$cuil'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

if($resultado->rowCount() >= 1){
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["s_usuarioEstudiante"] = $dni;
}else{
    $_SESSION["s_usuarioEstudiante"] = null;
    $data=null;
}

print json_encode($data);
$conexion=null;

//usuarios de pruebaen la base de datos
//usuario:admin pass:12345
//usuario:demo pass:demo