<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();
$Libro = (isset($_POST['Libro'])) ? $_POST['Libro'] : '';
$Folio = (isset($_POST['Folio'])) ? $_POST['Folio'] : '';
$nLegajo = (isset($_POST['nLegajo'])) ? $_POST['nLegajo'] : '';
$nacionalidadAlumno = (isset($_POST['nacionalidadAlumno'])) ? $_POST['nacionalidadAlumno'] : '';
$procedenciaAlumno = (isset($_POST['procedenciaAlumno'])) ? $_POST['procedenciaAlumno'] : '';
$nacionalidadTutor = (isset($_POST['nacionalidadTutor'])) ? $_POST['nacionalidadTutor'] : '';
$idAlumno = (isset($_POST['idAlumno'])) ? $_POST['idAlumno'] : '';
$auxiliar = (isset($_POST['auxiliar'])) ? $_POST['auxiliar'] : '';
$piePagina = (isset($_POST['piePagina'])) ? $_POST['piePagina'] : '';

if (isset($_SESSION['cicloLectivo'])){
$cicloLectivo=$_SESSION['cicloLectivo'];
	
	$pref=0;

	$consulta = "SELECT `idDatoExtraFicha`, `idAlumno` FROM `datosficha_$cicloLectivo` WHERE `idAlumno`='$idAlumno'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

            foreach($data as $dat) { 

            $pref=1;                

            }

    if ($pref==0) {
                 
        $consulta = "INSERT INTO `datosficha_$cicloLectivo`(`idDatoExtraFicha`, `idAlumno`, `Libro`, `Folio`, `nLegajo`, `nacionalidadAlumno`, `procedenciaAlumno`, `nacionalidadTutor`, `auxiliar`, `piePagina`) VALUES (null,'$idAlumno','$Libro','$Folio','$nLegajo','$nacionalidadAlumno','$procedenciaAlumno','$nacionalidadTutor','$auxiliar','$piePagina')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

      	
    }else{

    
    	  $consulta = "UPDATE `datosficha_$cicloLectivo` SET `Libro`='$Libro',`Folio`='$Folio',`nLegajo`='$nLegajo',`nacionalidadAlumno`='$nacionalidadAlumno',`procedenciaAlumno`='$procedenciaAlumno',`nacionalidadTutor`='$nacionalidadTutor',`auxiliar`='$auxiliar',`piePagina`='$piePagina' WHERE `idAlumno`='$idAlumno'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
    }    

echo "Muy Bien";
$conexion = NULL;

}