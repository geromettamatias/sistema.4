<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();

$Libro='';
$Folio='';
$nLegajo='';
$nacionalidadAlumno='';
$procedenciaAlumno='';
$nacionalidadTutor='';
$auxiliar='';
$piePagina='';
$res='';

if (isset($_SESSION['cicloLectivo'])){
$cicloLectivo=$_SESSION['cicloLectivo'];


$idAlumno = (isset($_POST['idAlumno'])) ? $_POST['idAlumno'] : '';



        $consulta = "SELECT `idDatoExtraFicha`, `idAlumno`, `Libro`, `Folio`, `nLegajo`, `nacionalidadAlumno`, `procedenciaAlumno`, `nacionalidadTutor`, `auxiliar`, `piePagina` FROM `datosficha_$cicloLectivo` WHERE `idAlumno`='$idAlumno'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
      
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);


                            foreach($data as $dat) { 

                
                            $Libro=$dat['Libro'];
                            $Folio=$dat['Folio'];
                            $nLegajo=$dat['nLegajo'];

                            $nacionalidadAlumno=$dat['nacionalidadAlumno'];
                            $procedenciaAlumno=$dat['procedenciaAlumno'];
                            $nacionalidadTutor=$dat['nacionalidadTutor'];
                            $auxiliar=$dat['auxiliar'];
                            $piePagina=$dat['piePagina'];

                  
                          
                            
                        }

                        $res= $Libro.'||'.$Folio.'||'.$nLegajo.'||'.$nacionalidadAlumno.'||'.$procedenciaAlumno.'||'.$nacionalidadTutor.'||'.$auxiliar.'||'.$piePagina;

                        echo $res;
     
}else{

     $res= $Libro.'||'.$Folio.'||'.$nLegajo.'||'.$nacionalidadAlumno.'||'.$procedenciaAlumno.'||'.$nacionalidadTutor.'||'.$auxiliar.'||'.$piePagina;

     echo $res;
}
$conexion = NULL;