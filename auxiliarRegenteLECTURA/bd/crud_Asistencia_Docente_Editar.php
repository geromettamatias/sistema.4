<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$nom='';

        $consulta = "SELECT asistenciadocente.id_Asistencia, asistenciadocente.idDocente, asignacion_asignatura_docente.idAsig, asistenciadocente.fecha, asistenciadocente.cantidad, asistenciadocente.justificado FROM asistenciadocente INNER JOIN asignacion_asignatura_docente ON asignacion_asignatura_docente.idCurso= asistenciadocente.idCurso AND asignacion_asignatura_docente.idAsignatura = asistenciadocente.idAsignatura WHERE asistenciadocente.id_Asistencia ='$id'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($dat1a as $da1t) { 
            $nom=$da1t['id_Asistencia'].'||'.$da1t['idAsig'].'||'.$da1t['fecha'].'||'.$da1t['cantidad'].'||'.$da1t['justificado'];
        }
  

echo $nom;
$conexion = NULL;