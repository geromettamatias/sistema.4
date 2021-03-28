<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();

$cicloLectivo=$_SESSION['cicloLectivo'];


$contador = (isset($_POST['contador'])) ? $_POST['contador'] : '';
$libreta = (isset($_POST['libreta'])) ? $_POST['libreta'] : '';


$dato= (isset($_POST[''.$libreta.'-'.$contador])) ? $_POST[''.$libreta.'-'.$contador] : '';




$cicloLectivoAnali=$cicloLectivo;

$mes='NOV';

$consulta = "SELECT `idCabezera`, `nombre`, `descri` FROM `cabezera_libreta_digital_$cicloLectivo`";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data3=$resultado->fetchAll(PDO::FETCH_ASSOC);
$contaFin=0;

$contadorCICLO=0;
foreach($data3 as $dat3) {
    $contaFin++;

    $dato3= (isset($_POST[''.$libreta.'-'.$contaFin])) ? $_POST[''.$libreta.'-'.$contaFin] : '';
                                       
    $descri= $dat3['descri']; 


  if ($descri=='TEXTO') {

    $contadorCICLO++;

    if (($contadorCICLO==2)){
         
    if ($dato3!='') {
        

        $mes='DIS';

    }


    }else if (($contadorCICLO==4)) {
         
    if ($dato3!='') {
        

        $mes='MAR';

    }


    }





  }


}




if ($mes=='MAR') {
   $cicloLectivoAnali++;
}





if ($dato > 5) {
      # code...
  
     $consulta = "SELECT `inscrip_curso_alumno_$cicloLectivo`.`idAlumno`, `libreta_digital_$cicloLectivo`.`idAsig`, `plan_datos_asignaturas`.`idPlan` FROM `libreta_digital_$cicloLectivo` INNER JOIN `inscrip_curso_alumno_$cicloLectivo` ON `inscrip_curso_alumno_$cicloLectivo`.`idIns` = `libreta_digital_$cicloLectivo`.`idIns` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `libreta_digital_$cicloLectivo`.`idAsig` WHERE `libreta_digital_$cicloLectivo`.`id_libreta` = '$libreta'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data2=$resultado->fetchAll(PDO::FETCH_ASSOC);
         
                foreach($data2 as $dat2) {


                    $idAlumno= $dat2['idAlumno']; 
                    $idAsigFINAL= $dat2['idAsig']; 
                    $idPlan= $dat2['idPlan']; 


                    


                    $idAnalitico='';
                    $consulta = "SELECT `idAnalitico`FROM `analitico` WHERE `idAlumno`='$idAlumno'";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();
                    $data3=$resultado->fetchAll(PDO::FETCH_ASSOC);
                    foreach($data3 as $dat3) {
                        $idAnalitico= $dat3['idAnalitico']; 
                    }


                     if ($idAnalitico!='') {
                       



                              $numTex='';

                           if ($dato==10) {
                                $numTex='diez';
                                }else if ($dato==9) {
                                $numTex='nueve';
                                }else if ($dato==8) {
                                $numTex='ocho';
                                }else if ($dato==7) {
                                $numTex='siete';
                                }else if ($dato==6) {
                                $numTex='seis';
                                }




                            $consulta = "UPDATE `analitico` SET `nota`='$dato', `notaEscr`='$numTex', `fechaMes`='$mes',`fechaAño`='$cicloLectivoAnali',`condicion`='Regular',`establecimiento`='Este Establecimiento' WHERE `idAsig`='$idAsigFINAL' AND `idAlumno`='$idAlumno'";        
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute(); 







                    }else{

                         $consulta = "SELECT `idPlanEstudio` FROM `datosalumnos` WHERE `idAlumnos`='$idAlumno'";       
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                            foreach($data as $dat) {
                                $idPlanEstudio=$dat['idPlanEstudio'];
                            }

                            $consulta = "SELECT `idAsig`, `idPlan`, `nombre`, `ciclo` FROM `plan_datos_asignaturas` WHERE `idPlan`='$idPlanEstudio' OR `idPlan`='básico'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $d1ata=$resultado->fetchAll(PDO::FETCH_ASSOC);
                            foreach($d1ata as $d1at) {
                                $idAsig=$d1at['idAsig'];

                                $idPlanD=$d1at['idPlan'];
                                 
                                $consulta = "INSERT INTO `analitico`(`idAnalitico`, `idPlan`, `idAsig`, `idAlumno`, `nota`, `notaEscr`, `fechaMes`, `fechaAño`, `condicion`, `establecimiento`) VALUES  (null,'$idPlanD','$idAsig','$idAlumno','','','','','','')";            
                                $resultado = $conexion->prepare($consulta);
                                $resultado->execute(); 
                            }

                            
                            $numTex='';

                           if ($dato==10) {
                                $numTex='diez';
                                }else if ($dato==9) {
                                $numTex='nueve';
                                }else if ($dato==8) {
                                $numTex='ocho';
                                }else if ($dato==7) {
                                $numTex='siete';
                                }else if ($dato==6) {
                                $numTex='seis';
                                }




                            $consulta = "UPDATE `analitico` SET `nota`='$dato', `notaEscr`='$numTex', `fechaMes`='$mes',`fechaAño`='$cicloLectivoAnali',`condicion`='Regular',`establecimiento`='Este Establecimiento' WHERE `idAsig`='$idAsigFINAL' AND `idAlumno`='$idAlumno'";        
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute(); 




                    }


                }




 } 














 if (($dato<6) || ($dato=='')) {
   
  
         $consulta = "SELECT `inscrip_curso_alumno_$cicloLectivo`.`idAlumno`, `libreta_digital_$cicloLectivo`.`idAsig`, `plan_datos_asignaturas`.`idPlan` FROM `libreta_digital_$cicloLectivo` INNER JOIN `inscrip_curso_alumno_$cicloLectivo` ON `inscrip_curso_alumno_$cicloLectivo`.`idIns` = `libreta_digital_$cicloLectivo`.`idIns` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `libreta_digital_$cicloLectivo`.`idAsig` WHERE `libreta_digital_$cicloLectivo`.`id_libreta` = '$libreta'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data2=$resultado->fetchAll(PDO::FETCH_ASSOC);
         
                foreach($data2 as $dat2) {


                    $idAlumno= $dat2['idAlumno']; 
                    $idAsigFINAL= $dat2['idAsig']; 
                    $idPlan= $dat2['idPlan']; 


                    


                    $idAnalitico='';
                    $consulta = "SELECT `idAnalitico`FROM `analitico` WHERE `idAlumno`='$idAlumno'";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();
                    $data3=$resultado->fetchAll(PDO::FETCH_ASSOC);
                    foreach($data3 as $dat3) {
                        $idAnalitico= $dat3['idAnalitico']; 
                    }


                     if ($idAnalitico!='') {
                       



                            $consulta = "UPDATE `analitico` SET `nota`='', `notaEscr`='', `fechaMes`='',`fechaAño`='',`condicion`='',`establecimiento`='' WHERE `idAsig`='$idAsigFINAL' AND `idAlumno`='$idAlumno'";        
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute(); 







                    }else{

                         $consulta = "SELECT `idPlanEstudio` FROM `datosalumnos` WHERE `idAlumnos`='$idAlumno'";       
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                            foreach($data as $dat) {
                                $idPlanEstudio=$dat['idPlanEstudio'];
                            }

                            $consulta = "SELECT `idAsig`, `idPlan`, `nombre`, `ciclo` FROM `plan_datos_asignaturas` WHERE `idPlan`='$idPlanEstudio' OR `idPlan`='básico'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $d1ata=$resultado->fetchAll(PDO::FETCH_ASSOC);
                            foreach($d1ata as $d1at) {
                                $idAsig=$d1at['idAsig'];

                                $idPlanD=$d1at['idPlan'];
                                 
                                $consulta = "INSERT INTO `analitico`(`idAnalitico`, `idPlan`, `idAsig`, `idAlumno`, `nota`, `notaEscr`, `fechaMes`, `fechaAño`, `condicion`, `establecimiento`) VALUES  (null,'$idPlanD','$idAsig','$idAlumno','','','','','','')";            
                                $resultado = $conexion->prepare($consulta);
                                $resultado->execute(); 
                            }

                        




                    }


                }




 } 

$conexion = NULL;

