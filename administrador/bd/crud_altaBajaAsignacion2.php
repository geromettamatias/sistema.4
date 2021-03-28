<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();
$idAsig = (isset($_POST['idAsig'])) ? $_POST['idAsig'] : '';
$idcursoAsig = (isset($_POST['idcursoAsig'])) ? $_POST['idcursoAsig'] : '';
$idAsignaturaAsig = (isset($_POST['idAsignaturaAsig'])) ? $_POST['idAsignaturaAsig'] : '';

$cicloLectivo = (isset($_POST['cicloLectivo'])) ? $_POST['cicloLectivo'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

if ($cicloLectivo!="") {


if ((isset($_SESSION['docenteSEL']))){
   $idDocente=$_SESSION['docenteSEL'];

   $pre=0;

         $consulta = "SELECT `datos_docentes`.`nombre`, `datos_docentes`.`dni` FROM `asignacion_asignatura_docente_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `asignacion_asignatura_docente_$cicloLectivo`.`idAsignatura` = `plan_datos_asignaturas`.`idAsig` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `asignacion_asignatura_docente_$cicloLectivo`.`idCurso` INNER JOIN `datos_docentes` ON `datos_docentes`.`idDocente`= `asignacion_asignatura_docente_$cicloLectivo`.`idDocente` WHERE `asignacion_asignatura_docente_$cicloLectivo`.`idCurso`='$idcursoAsig' AND `asignacion_asignatura_docente_$cicloLectivo`.`idAsignatura`='$idAsignaturaAsig'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
         foreach($data as $dat) {                                 
            $pre=$dat['nombre'].'--'.$dat['dni'];
        }
      


echo $pre;


$conexion = NULL;

}    
}

