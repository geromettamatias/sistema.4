
   <?php
                    include_once '../bd/conexion.php';
                    $objeto = new Conexion();
                    $conexion = $objeto->Conectar();

                    $consulta = "SELECT `idDocente`, `dni`, `nombre` FROM `datos_docentes` ORDER BY `nombre` ASC";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();
                    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                            
                        foreach($data as $dat) { 


                          $idDocente=$dat['idDocente'];
                          $nombre=$dat['nombre'];
                    

                          $Prof.='<option value=".$idDocente">'.$nombre.'</option>';
                            }
                       