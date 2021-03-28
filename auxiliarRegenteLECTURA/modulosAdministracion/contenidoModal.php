
                <div class="form-group">
                <label for="asignatura" class="col-form-label ediCur">ASIGNATURA Y CICLO:</label>
                        <select class="form-control" id="asignatura" >
                            <option value="0">Seleccione un curso</option>
                             <?php

                             include_once '../bd/conexion.php';
                                $objeto = new Conexion();
                                $conexion = $objeto->Conectar();
                                session_start();



                             $c1onsulta = "SELECT `idAsig`, `nombre`, `ciclo`, `idPlan` FROM `plan_datos_asignaturas` ORDER BY `ciclo`";
                                $r1esultado = $conexion->prepare($c1onsulta);
                                $r1esultado->execute();
                                $d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($d1ata as $d1at) {

                                         $idAsig = $d1at['idAsig'];
                                         $nombre = $d1at['nombre'];
                                         $ciclo = $d1at['ciclo'];
                                         $idPlan = $d1at['idPlan'];

                               
                                        $consulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos` WHERE `idPlan`='$idPlan'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($data as $dat) {

                                                $idPlan = $dat['nombre'];

                                        }



                                ?>
                                <option value="<?php echo $idAsig; ?>"><?php echo $ciclo.'--'.$nombre.'--'.$idPlan; ?></option>
                                <?php } ?>
                        </select>
                    </div>
                   

                  
                <div class="form-group">
                  <label for="fechaActa" class="col-form-label">FECHA INICIO</label>
                  <div class="col-10">
                    <input class="form-control" type="date" id="fechaActa">
                  </div>
                </div>
                <div class="form-group">
                  <label for="fechaActa" class="col-form-label">FECHA CIERRE</label>
                  <div class="col-10">
                    <input class="form-control" type="date" id="fechaActaCierre">
                  </div>
                </div>

                <div class="form-group">
                <label for="docente1" class="col-form-label">DOCENTE-PRESIDENTE:</label>
                        <select class="form-control" id="docente1">
                            <option value="0">Seleccione un DOCENTE</option>
                             <?php



                                $c1onsulta = "SELECT `idDocente`, `dni`, `nombre` FROM `datos_docentes`";
                                $r1esultado = $conexion->prepare($c1onsulta);
                                $r1esultado->execute();
                                $d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($d1ata as $d1at) {
                                ?>
                                <option value="<?php echo $d1at['idDocente'] ?>"><?php echo $d1at['nombre'].'--'.$d1at['dni'] ?></option>
                                <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                <label for="docente2" class="col-form-label">DOCENTE-1er SUPLENTE:</label>
                        <select class="form-control" id="docente2">
                            <option value="0">Seleccione un DOCENTE</option>
                             <?php



                                $c1onsulta = "SELECT `idDocente`, `dni`, `nombre` FROM `datos_docentes`";
                                $r1esultado = $conexion->prepare($c1onsulta);
                                $r1esultado->execute();
                                $d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($d1ata as $d1at) {
                                ?>
                                <option value="<?php echo $d1at['idDocente'] ?>"><?php echo $d1at['nombre'].'--'.$d1at['dni'] ?></option>
                                <?php } ?>
                        </select>
                    </div>
                       <div class="form-group">
                <label for="docente3" class="col-form-label">DOCENTE-2do SUPLENTE:</label>
                        <select class="form-control" id="docente3">
                            <option value="0">Seleccione un DOCENTE</option>
                             <?php



                                $c1onsulta = "SELECT `idDocente`, `dni`, `nombre` FROM `datos_docentes`";
                                $r1esultado = $conexion->prepare($c1onsulta);
                                $r1esultado->execute();
                                $d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($d1ata as $d1at) {
                                ?>
                                <option value="<?php echo $d1at['idDocente'] ?>"><?php echo $d1at['nombre'].'--'.$d1at['dni'] ?></option>
                                <?php } ?>
                        </select>
                    </div>
             
  
  