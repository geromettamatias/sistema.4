<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();

$cicloLectivo=$_SESSION['cicloLectivo'];


$contador = (isset($_POST['contador'])) ? $_POST['contador'] : '';
$libreta = (isset($_POST['libreta'])) ? $_POST['libreta'] : '';


$consulta = "SELECT `idCabezera`, `nombre`, `descri` FROM `cabezera_libreta_digital_$cicloLectivo`";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
$contaFin=0;
$editarDatos='';




foreach($data1 as $dat1) {
	$contaFin++;

	$dato= (isset($_POST[''.$libreta.'-'.$contaFin])) ? $_POST[''.$libreta.'-'.$contaFin] : '';
                                       
    $cabesado= $dat1['nombre']; 


    if($contador==$contaFin){

    	$editarDatos.='`'.$cabesado.'`'.'='."'".$dato."'";



    }else{
    	$editarDatos.='`'.$cabesado.'`'.'='."'".$dato."',";
    }
}


$consulta = "UPDATE `libreta_digital_$cicloLectivo` SET $editarDatos WHERE `id_libreta`='$libreta'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  


echo $consulta;
$conexion = NULL;