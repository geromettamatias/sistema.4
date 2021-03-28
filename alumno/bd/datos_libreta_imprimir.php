 <?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

$arreglo["data"]=[];

if (isset($_SESSION['s_usuarioEstudiante'])){
$s_usuarioEstudiante=$_SESSION['s_usuarioEstudiante'];


         $c3onsulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor` FROM `datosalumnos` WHERE `dniAlumnos`='$s_usuarioEstudiante'";
        $r3esultado = $conexion->prepare($c3onsulta);
        $r3esultado->execute();
        $d3ata=$r3esultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($d3ata as $d3at) {
            $idAlumnos=$d3at['idAlumnos'];
            $nombreAlumnos=$d3at['nombreAlumnos'];
            $dniAlumnos=$d3at['dniAlumnos'];
         }


$idIns='';
  $consulta = "SELECT `idIns`, `idCurso`, `idAlumno` FROM `inscrip_curso_alumno` WHERE `idAlumno`='$idAlumnos'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($data as $dat) {
            $idIns=$dat['idIns'];
         }



 
$consulta = "SELECT `id_libreta`, `idIns`, `idAsig`, `nota1`, `nota2`, `nota3`, `integrador`, `diciembre`, `marzo`, `nota_final` FROM `libreta_digital` WHERE `idIns`='$idIns' ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);




                           
                            foreach($data as $dat) {

                            $id_libreta=$dat['id_libreta'];
                            $idAsig=$dat['idAsig'];
                            $nota1=$dat['nota1'];
                            $nota2=$dat['nota2'];
                            $nota3=$dat['nota3'];
                            $integrador=$dat['integrador'];
                            $diciembre=$dat['diciembre'];
                            $marzo=$dat['marzo'];
                            $nota_final=$dat['nota_final']; 
 

                                    $c1onsulta = "SELECT `idAsig`, `idPlan`, `nombre`, `ciclo`, `idDocente` FROM `plan_datos_asignaturas` WHERE `idAsig`='$idAsig'";
                                        $r1esultado = $conexion->prepare($c1onsulta);
                                        $r1esultado->execute();
                                        $d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);

                                         foreach($d1ata as $d1at) {
                                            $nombre=$d1at['nombre'];
                                            } 
 


                          

                            $json = ["id_libreta" => $id_libreta,
                                      "nombre" => $nombre,
                                      "nota1" => $nota1,
                                      "nota2" => $nota2,
                                      "nota3" => $nota3,
                                      "integrador" => $integrador,
                                      "diciembre"=>$diciembre,
                                      "marzo" => $marzo,
                                      "nota_final" => $nota_final, ];


                        array_push ( $arreglo["data"] , $json );

                            





                                }
                        print json_encode($arreglo, JSON_UNESCAPED_UNICODE);

                        $conexion = NULL;
}

                            ?>  