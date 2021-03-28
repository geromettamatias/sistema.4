<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
 

$id_mensaje = (isset($_POST['id_mensaje'])) ? $_POST['id_mensaje'] : '';
$id_usuario = (isset($_POST['id_usuario'])) ? $_POST['id_usuario'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
$mensaje = (isset($_POST['mensaje'])) ? $_POST['mensaje'] : '';
$datos = (isset($_POST['datos'])) ? $_POST['datos'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';



switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `mensajes`(`id_mensaje`, `id_usuario`, `fecha`, `mensaje`, `datos`) VALUES ('$id_mensaje','$id_usuario','$fecha','$mensaje','$datos')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT `id_mensaje`, `id_usuario`, `fecha`, `mensaje`, `datos` FROM `mensajes` ORDER BY `id_mensaje` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE `mensajes` SET `id_mensaje`='$id_mensaje',`id_usuario`='$id_usuario',`fecha`='$fecha',`mensaje`='$mensaje',`datos`='$datos' WHERE `id_mensaje`='$id_mensaje'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT `id_mensaje`, `id_usuario`, `fecha`, `mensaje`, `datos` FROM `mensajes` WHERE `id_mensaje`='$id_mensaje'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM `mensajes` WHERE `id_mensaje`='$id_mensaje'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
                                
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;