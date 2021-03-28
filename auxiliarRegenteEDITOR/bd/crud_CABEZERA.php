<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
 session_start();


if (isset($_SESSION['cicloLectivo'])){
$cicloLectivo=$_SESSION['cicloLectivo'];


$cabezera = (isset($_POST['cabezera'])) ? $_POST['cabezera'] : '';
$descrip = (isset($_POST['descrip'])) ? $_POST['descrip'] : '';
$idCabezera = (isset($_POST['idCabezera'])) ? $_POST['idCabezera'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$editarDocente = (isset($_POST['ediDocente'])) ? $_POST['ediDocente'] : '';
$cabezeraViejo = (isset($_POST['cabezeraViejo'])) ? $_POST['cabezeraViejo'] : '';
$corresponde = (isset($_POST['corresponde'])) ? $_POST['corresponde'] : '';



switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `cabezera_libreta_digital_$cicloLectivo`(`idCabezera`, `nombre`, `descri`, `editarDocente`, `corresponde`) VALUES (null,'$cabezera','$descrip','$editarDocente','$corresponde')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 


        $consulta = "ALTER TABLE `libreta_digital_$cicloLectivo` ADD `$cabezera` TEXT NULL AFTER `idAsig`";          
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();



        $consulta = "SELECT `idCabezera`, `nombre`, `descri`, `editarDocente`, `corresponde` FROM `cabezera_libreta_digital_$cicloLectivo` ORDER BY `idCabezera` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación


        $consulta = "UPDATE `cabezera_libreta_digital_$cicloLectivo` SET `nombre`='$cabezera',`descri`='$descrip',`editarDocente`='$editarDocente',`corresponde`='$corresponde' WHERE `idCabezera`='$idCabezera'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "ALTER TABLE `libreta_digital_$cicloLectivo` CHANGE `$cabezeraViejo` `$cabezera` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL";     
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT `idCabezera`, `nombre`, `descri`, `editarDocente`, `corresponde`  FROM `cabezera_libreta_digital_$cicloLectivo` WHERE `idCabezera`='$idCabezera'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM `cabezera_libreta_digital_$cicloLectivo` WHERE `idCabezera`='$idCabezera'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "ALTER TABLE `libreta_digital_$cicloLectivo` DROP `$cabezeraViejo`";      
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
     



        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;


}

