<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
 

$idasigD = (isset($_POST['idasigD'])) ? $_POST['idasigD'] : '';


    $consulta = "SELECT `idAsig`, `idPlan`, `nombre`, `ciclo`, `idDocente` FROM `plan_datos_asignaturas` WHERE `idAsig`='$idasigD'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;