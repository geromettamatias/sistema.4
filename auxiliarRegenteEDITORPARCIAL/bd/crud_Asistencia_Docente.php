<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS 
session_start();
  
 if (isset($_SESSION['cicloLectivo'])){

$cicloLectivo=$_SESSION['cicloLectivo'];


$id_Docente = (isset($_POST['id_Docente'])) ? $_POST['id_Docente'] : '';
$fecha_Docente = (isset($_POST['fecha_Docente'])) ? $_POST['fecha_Docente'] : '';
$cantidad_Docente = (isset($_POST['cantidad_Docente'])) ? $_POST['cantidad_Docente'] : '';
$justifico_Docente = (isset($_POST['justifico_Docente'])) ? $_POST['justifico_Docente'] : '';
$cursoAsignatura = (isset($_POST['cursoAsignatura'])) ? $_POST['cursoAsignatura'] : '';

$id = (isset($_POST['id'])) ? $_POST['id'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';



switch($opcion){
    case 1:
        $consulta = "SELECT `idAsig`, `idDocente`, `idCurso`, `idAsignatura` FROM `asignacion_asignatura_docente_$cicloLectivo` WHERE  `idAsig`='$cursoAsignatura'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($dat1a as $da1t) { 
            $idCurso=$da1t['idCurso'];
            $idAsignatura=$da1t['idAsignatura'];
        }

        $consulta = "INSERT INTO `asistenciadocente_$cicloLectivo`(`id_Asistencia`, `idDocente`, `idCurso`, `idAsignatura`, `fecha`, `cantidad`, `justificado`) VALUES (null,'$id_Docente','$idCurso','$idAsignatura','$fecha_Docente','$cantidad_Docente','$justifico_Docente')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT `asistenciadocente_$cicloLectivo`.`id_Asistencia`,`asistenciadocente_$cicloLectivo`.`idDocente`, `curso_$cicloLectivo`.`nombre` AS 'nombreCurso', `plan_datos_asignaturas`.`nombre` AS 'nombreAsignatura', `asistenciadocente_$cicloLectivo`.`idCurso`, `asistenciadocente_$cicloLectivo`.`idAsignatura`,`asistenciadocente_$cicloLectivo`.`fecha`, `asistenciadocente_$cicloLectivo`.`cantidad`, `asistenciadocente_$cicloLectivo`.`justificado` FROM `asistenciadocente_$cicloLectivo` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `asistenciadocente_$cicloLectivo`.`idCurso` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `asistenciadocente_$cicloLectivo`.`idAsignatura` ORDER BY `asistenciadocente_$cicloLectivo`.`id_Asistencia` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        
        break;
    case 2: 

        $consulta = "SELECT `idAsig`, `idDocente`, `idCurso`, `idAsignatura` FROM `asignacion_asignatura_docente_$cicloLectivo` WHERE  `idAsig`='$cursoAsignatura'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($dat1a as $da1t) { 
            $idCurso=$da1t['idCurso'];
            $idAsignatura=$da1t['idAsignatura'];
        }

        $consulta = "UPDATE `asistenciadocente_$cicloLectivo` SET `idCurso`='$idCurso',`idAsignatura`='$idAsignatura',`fecha`='$fecha_Docente',`cantidad`='$cantidad_Docente',`justificado`='$justifico_Docente' WHERE `id_Asistencia`='$id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT `asistenciadocente_$cicloLectivo`.`id_Asistencia`,`asistenciadocente_$cicloLectivo`.`idDocente`, `curso_$cicloLectivo`.`nombre` AS 'nombreCurso', `plan_datos_asignaturas`.`nombre` AS 'nombreAsignatura', `asistenciadocente_$cicloLectivo`.`idCurso`, `asistenciadocente_$cicloLectivo`.`idAsignatura`,`asistenciadocente_$cicloLectivo`.`fecha`, `asistenciadocente_$cicloLectivo`.`cantidad`, `asistenciadocente_$cicloLectivo`.`justificado` FROM `asistenciadocente_$cicloLectivo` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `asistenciadocente_$cicloLectivo`.`idCurso` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `asistenciadocente_$cicloLectivo`.`idAsignatura` WHERE `asistenciadocente_$cicloLectivo`.`id_Asistencia` = '$id'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM `asistenciadocente_$cicloLectivo` WHERE `id_Asistencia`='$id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
                                
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;

}else{

    echo "error";
}