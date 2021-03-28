<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
 

$id_mensaje = (isset($_POST['id_mensaje'])) ? $_POST['id_mensaje'] : '';

$datos = (isset($_POST['datos'])) ? $_POST['datos'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';



switch($opcion){
    case 2: //modificación
        $consulta = "UPDATE `mensajesdocente` SET `id_mensaje`='$id_mensaje',`datos`='$datos' WHERE `id_mensaje`='$id_mensaje'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT `id_mensaje`, `id_usuario`, `usuarioDocente`, `fecha`, `mensaje`, `datos` FROM `mensajesdocente` WHERE `id_mensaje`='$id_mensaje'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM `mensajesdocente` WHERE `id_mensaje`='$id_mensaje'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
                                
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;