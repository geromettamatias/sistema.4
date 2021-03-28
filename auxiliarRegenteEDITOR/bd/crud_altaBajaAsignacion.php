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

         $consulta = "SELECT `asignacion_asignatura_docente_$cicloLectivo`.`idAsig`, `plan_datos_asignaturas`.`nombre`, `curso_$cicloLectivo`.`nombre` AS 'nombreCurso' FROM `asignacion_asignatura_docente_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `asignacion_asignatura_docente_$cicloLectivo`.`idAsignatura` = `plan_datos_asignaturas`.`idAsig` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `asignacion_asignatura_docente_$cicloLectivo`.`idCurso`WHERE `asignacion_asignatura_docente_$cicloLectivo`.`idCurso`='$idcursoAsig' AND `asignacion_asignatura_docente_$cicloLectivo`.`idAsignatura`='$idAsignaturaAsig'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
         foreach($data as $dat) {                                 
            $pre=1;
        }
      


if ($pre==0) {


switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `asignacion_asignatura_docente_$cicloLectivo`(`idAsig`, `idDocente`, `idCurso`, `idAsignatura`) VALUES (null,'$idDocente','$idcursoAsig','$idAsignaturaAsig')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 



         $consulta = "SELECT `asignacion_asignatura_docente_$cicloLectivo`.`idAsig`, `plan_datos_asignaturas`.`nombre`, `curso_$cicloLectivo`.`nombre` AS 'nombreCurso' FROM `asignacion_asignatura_docente_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `asignacion_asignatura_docente_$cicloLectivo`.`idAsignatura` = `plan_datos_asignaturas`.`idAsig` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `asignacion_asignatura_docente_$cicloLectivo`.`idCurso`WHERE `asignacion_asignatura_docente_$cicloLectivo`.`idDocente`='1' ORDER BY `asignacion_asignatura_docente_$cicloLectivo`.`idAsig` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
       
        break; 

    case 2://baja
        $consulta = "DELETE FROM `asignacion_asignatura_docente_$cicloLectivo` WHERE `idAsig`='$idAsig'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
                                
        break;

}


    # code...
}else{

    print json_encode(0, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
       
}




$conexion = NULL;

}    
}

