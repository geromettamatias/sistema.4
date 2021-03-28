<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
 

$id_mensaje = (isset($_POST['id_mensaje'])) ? $_POST['id_mensaje'] : '';
$usuarioDocente = (isset($_POST['usuarioDocente'])) ? $_POST['usuarioDocente'] : '';
$ob = (isset($_POST['ob'])) ? $_POST['ob'] : '';

if ($ob==1) {

    $consulta = "SELECT `id_mensaje`, `id_usuario`, `usuarioDocente`, `fecha`, `mensaje`, `datos` FROM `mensajesdocente` WHERE `id_mensaje`='$id_mensaje'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
}else{

    $consulta = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente` FROM `datos_docentes` WHERE `idDocente`='$usuarioDocente'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    
}

        
   

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;