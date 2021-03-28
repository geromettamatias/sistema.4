<?php
session_start();

include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//recepción de datos enviados mediante POST desde ajax
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';

$pass = base64_encode($password); //encripto la clave enviada por el usuario para compararla con la clava encriptada y almacenada en la BD

$consulta = "SELECT * FROM usuario_administrador WHERE usuario='$usuario' AND password='$pass'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

if($resultado->rowCount() >= 1){
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["s_usuario"] = $usuario;


    $consulta1 = "SELECT `id`, `usuario`, `password` FROM `usuario_administrador` WHERE usuario='$usuario' AND password='$pass'";
    $resultado1 = $conexion->prepare($consulta1);
    $resultado1->execute();
    $data1=$resultado1->fetchAll(PDO::FETCH_ASSOC);
    foreach($data1 as $dat1) {                                                        
        $_SESSION["id_admin"] = $dat1['id'];
            }

    




}else{
    $_SESSION["s_usuario"] = null;
    $data=null;
}

print json_encode($data);
$conexion=null;
