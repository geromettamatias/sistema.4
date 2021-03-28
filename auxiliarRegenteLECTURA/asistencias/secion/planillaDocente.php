<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
 

$id_Inasistencia = (isset($_POST['id_Inasistencia'])) ? $_POST['id_Inasistencia'] : '';


        $consulta = "SELECT  asistenciadocente_no_asignado.fecha, asistenciadocente_no_asignado.ob FROM asistenciadocente_no_asignado INNER JOIN datos_docentes ON datos_docentes.idDocente = asistenciadocente_no_asignado.idDocente WHERE asistenciadocente_no_asignado.id_Inasistencia ='$id_Inasistencia'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);


                            foreach($data as $dat) { 

                              

                        
                            $fecha=$dat['fecha'];
                            $ob=$dat['ob'];
                          

                        

                            $res= $fecha.'||'.$ob;
                        }

                        echo $res;


$conexion = NULL;