 <?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

$arreglo["data"] = [];


 
$consulta = "SELECT `idDocente`, `dni`, `nombre` FROM `datos_docentes`";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

                                foreach($data as $dat) {
                                    $idDocente=$dat['idDocente'];
                                    $nombre=$dat['nombre'];
                                    $dni=$dat['dni'];
                                      
                                
                           

     
                          

                            $json = ["idDocente" => $idDocente,
                                      "nombre" => $nombre,
                                      "dni" => $dni,
                                     
                                       ];


                        array_push ( $arreglo["data"] , $json );

                            



                                }
                        print json_encode($arreglo, JSON_UNESCAPED_UNICODE);

                        $conexion = NULL;


                            ?> 