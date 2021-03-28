<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();

$cicloLectivo=$_SESSION['cicloLectivo'];

$idIns = (isset($_POST['idIns'])) ? $_POST['idIns'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

$idAlumnos = (isset($_POST['idAlumnos'])) ? $_POST['idAlumnos'] : '';
$cursoSe = (isset($_POST['cursoSe'])) ? $_POST['cursoSe'] : '';


$respuesta='';



switch($opcion){
    case 1: //alta
        $consulta = "INSERT  INTO `inscrip_curso_alumno_$cicloLectivo`(`idIns`, `idCurso`, `idAlumno`) VALUES (null,'$cursoSe','$idAlumnos')";            
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta1 = "SELECT `idIns`, `idCurso`, `idAlumno` FROM `inscrip_curso_alumno_$cicloLectivo` WHERE `idAlumno`='$idAlumnos'";
        $resultado1 = $conexion->prepare($consulta1);
        $resultado1->execute();
        $data1=$resultado1->fetchAll(PDO::FETCH_ASSOC);
        foreach($data1 as $dat1) {
            $idIns=$dat1['idIns'];
        }


        $consulta = "SELECT `plan_datos_asignaturas`.`idAsig` FROM `plan_datos_asignaturas` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`ciclo` = `plan_datos_asignaturas`.`ciclo` AND `curso_$cicloLectivo`.`idPlan` = `plan_datos_asignaturas`.`idPlan` WHERE `curso_$cicloLectivo`.`idCurso`='$cursoSe'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                foreach($data as $dat) { 
                    $idAsig=$dat['idAsig'];
                            
                    $c1onsulta = "INSERT INTO `libreta_digital_$cicloLectivo`(`id_libreta`, `idIns`, `idAsig`) VALUES (null,'$idIns','$idAsig')";
                    $r1esultado = $conexion->prepare($c1onsulta);
                    $r1esultado->execute();

                   
                } 




        $consulta = "SELECT `inscrip_curso_alumno_$cicloLectivo`.`idIns`, `datosalumnos`.`dniAlumnos`, `datosalumnos`.`nombreAlumnos`, `curso_$cicloLectivo`.`nombre` FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos`= `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `inscrip_curso_alumno_$cicloLectivo`.`idCurso` ORDER BY `inscrip_curso_alumno_$cicloLectivo`.`idIns` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();     
        $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($data1 as $dat1) {
            $idIns=$dat1['idIns'];
            $dniAlumnos=$dat1['dniAlumnos'];
            $nombreAlumnos=$dat1['nombreAlumnos'];
            $nombre=$dat1['nombre'];
        }

        $respuesta=$idIns.'||'.$dniAlumnos.'||'.$nombreAlumnos.'||'.$nombre;

        echo $respuesta;

        break;      
    case 2://baja

        $consulta1 = "SELECT `datosalumnos`.`idAlumnos`, `datosalumnos`.`idPlanEstudio` FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos` =  `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idIns` = '$idIns'";
        $resultado1 = $conexion->prepare($consulta1);
        $resultado1->execute();
        $data1=$resultado1->fetchAll(PDO::FETCH_ASSOC);
        foreach($data1 as $dat1) {
        $idAlumnos=$dat1['idAlumnos'];    
        $idPlanEstudio=$dat1['idPlanEstudio'];
        
       
        $respuesta=$idAlumnos.'||'.$idPlanEstudio;

            }
        
        $consulta = "DELETE FROM `inscrip_curso_alumno_$cicloLectivo` WHERE `idIns`='$idIns' ";      
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "DELETE FROM `libreta_digital_$cicloLectivo` WHERE `idIns`='$idIns' ";      
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

       

        
        echo $respuesta;

          $data=2;                      
        break;
     case 3://Cambio
        
            $consulta = "UPDATE `inscrip_curso_alumno_$cicloLectivo` SET `idCurso`='$cursoSe' WHERE `idIns`='$idIns'";      
             $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            $consulta = "DELETE FROM `libreta_digital_$cicloLectivo` WHERE `idIns`='$idIns' ";      
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            $consulta = "SELECT `plan_datos_asignaturas`.`idAsig` FROM `plan_datos_asignaturas` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`ciclo` = `plan_datos_asignaturas`.`ciclo` AND `curso_$cicloLectivo`.`idPlan` = `plan_datos_asignaturas`.`idPlan` WHERE `curso_$cicloLectivo`.`idCurso`='$cursoSe'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                foreach($data as $dat) { 
                    $idAsig=$dat['idAsig'];
                            
                    $c1onsulta = "INSERT INTO `libreta_digital_$cicloLectivo`(`id_libreta`, `idIns`, `idAsig`) VALUES (null,'$idIns','$idAsig')";
                    $r1esultado = $conexion->prepare($c1onsulta);
                    $r1esultado->execute();

                   
                }



            $consulta = "SELECT `inscrip_curso_alumno_$cicloLectivo`.`idAlumno`, `curso_$cicloLectivo`.`nombre` FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `inscrip_curso_alumno_$cicloLectivo`.`idCurso` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idIns` ='$idIns'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                foreach($data as $dat) { 
                    $idAlumno=$dat['idAlumno'];
                    $nombre=$dat['nombre'];

                    $respuesta=$idAlumno.'||'.$nombre;

                 
                }

                 
            echo $respuesta;
   
          $data=2;                      
        break;            
}


$conexion = NULL;



   
                    
                  