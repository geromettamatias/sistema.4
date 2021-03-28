<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();
  
 if (isset($_SESSION['cicloLectivo'])){

$cicloLectivo=$_SESSION['cicloLectivo'];

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$nom='';

        $consulta = "SELECT `asistenciadocente_$cicloLectivo`.`id_Asistencia`, `asistenciadocente_$cicloLectivo`.`idDocente`, `asignacion_asignatura_docente_$cicloLectivo`.`idAsig`, `asistenciadocente_$cicloLectivo`.`fecha`, `asistenciadocente_$cicloLectivo`.cantidad, `asistenciadocente_$cicloLectivo`.`justificado` FROM `asistenciadocente_$cicloLectivo` INNER JOIN `asignacion_asignatura_docente_$cicloLectivo` ON `asignacion_asignatura_docente_$cicloLectivo`.`idCurso`= `asistenciadocente_$cicloLectivo`.`idCurso` AND `asignacion_asignatura_docente_$cicloLectivo`.`idAsignatura` = `asistenciadocente_$cicloLectivo`.`idAsignatura` WHERE `asistenciadocente_$cicloLectivo`.`id_Asistencia` ='$id'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($dat1a as $da1t) { 
            $nom=$da1t['id_Asistencia'].'||'.$da1t['idAsig'].'||'.$da1t['fecha'].'||'.$da1t['cantidad'].'||'.$da1t['justificado'];
        }
  

echo $nom;
$conexion = NULL;

}else{

	echo "ERROR";
}