<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
    
$idPlan = (isset($_POST['idPlan'])) ? $_POST['idPlan'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$idAsig = (isset($_POST['idAsig'])) ? $_POST['idAsig'] : '';
$ciclo = (isset($_POST['ciclo'])) ? $_POST['ciclo'] : '';


switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO plan_datos_asignaturas (idPlan, nombre, ciclo) VALUES('$idPlan', '$nombre', '$ciclo') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT idAsig, idPlan, nombre, ciclo FROM plan_datos_asignaturas ORDER BY idAsig DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE plan_datos_asignaturas SET idPlan='$idPlan', nombre='$nombre', ciclo='$ciclo' WHERE idAsig='$idAsig' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT idAsig, idPlan, nombre, ciclo FROM plan_datos_asignaturas WHERE idAsig='$idAsig' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM plan_datos_asignaturas WHERE idAsig='$idAsig' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
                                
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;