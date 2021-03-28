 <?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

$arreglo["data"] = [];


 
$consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor` FROM `datosalumnos`";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

                                foreach($data as $dat) {
                                    $idAlumnos=$dat['idAlumnos'];
                                    $nombreAlumnos=$dat['nombreAlumnos'];
                                    $dniAlumnos=$dat['dniAlumnos'];
                                      
                                
                           

     
                          

                            $json = ["idAlumnos" => $idAlumnos,
                                      "nombreAlumnos" => $nombreAlumnos,
                                      "dniAlumnos" => $dniAlumnos,
                                     
                                       ];


                        array_push ( $arreglo["data"] , $json );

                            



                                }
                        print json_encode($arreglo, JSON_UNESCAPED_UNICODE);

                        $conexion = NULL;


                            ?> 