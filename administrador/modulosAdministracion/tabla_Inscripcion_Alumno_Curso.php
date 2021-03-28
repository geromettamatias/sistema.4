<div class="modal fade" id="modalCRUD_tablaAlumnoMatriculacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
                
            <div class="modal-body">
                

          

<h1>LISTA DE ALUMNOS</h1>

<br><br>

          <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">       
                        <table id="tablaAlu"  class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>N°</th>
                                <th>Orientación</th> 
                                <th>DNI</th>
                                <th>Apellido y Nombre</th>
                                <th>Curso Asignado</th> 
                         

                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php 

                            include_once '../bd/conexion.php';
                  $objeto = new Conexion();
                  $conexion = $objeto->Conectar(); 
                  session_start();

                     $cicloLectivo=$_SESSION['cicloLectivo'];

      
                            $consulta1 = "SELECT `datosalumnos`.`idAlumnos`, `datosalumnos`.`idPlanEstudio`, `plan_datos`.`nombre`, `datosalumnos`.`dniAlumnos`, `datosalumnos`.`nombreAlumnos` FROM `datosalumnos` INNER JOIN `plan_datos` ON `plan_datos`.`idPlan`=`datosalumnos`.`idPlanEstudio`";
                            $resultado1 = $conexion->prepare($consulta1);
                            $resultado1->execute();
                            $data1=$resultado1->fetchAll(PDO::FETCH_ASSOC);


                    
                            foreach($data1 as $dat1) {

                                    $idPlanEstudio=$dat1['idPlanEstudio'];
                                    $idAlumnos=$dat1['idAlumnos'];
                                    $dniAlumnos=$dat1['dniAlumnos'];
                                    $nombreAlumnos=$dat1['nombreAlumnos'];
                                    $nombre=$dat1['nombre'];
                                    $datos=$idAlumnos.'||'.$idPlanEstudio;

                                    $nombreCurso='Sin Curso';
                                      $consulta1 = "SELECT `curso_$cicloLectivo`.`nombre` AS 'nombreCurso' FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` =`inscrip_curso_alumno_$cicloLectivo`.`idCurso` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` = '$idAlumnos'";
                                      $resultado1 = $conexion->prepare($consulta1);
                                      $resultado1->execute();
                                      $data2=$resultado1->fetchAll(PDO::FETCH_ASSOC);
                                      foreach($data2 as $dat2) {
                                        $nombreCurso=$dat2['nombreCurso'];
                                      }


                                    
                        
                                                              
                            ?>
                            <tr>


                                <td><?php echo $idAlumnos; ?></td>
                                <td><?php echo $nombre; ?></td>
                                <td><?php echo $dniAlumnos; ?></td>
                                <td><?php echo $nombreAlumnos; ?></td>
                                <td id="asig-<?php echo $idAlumnos; ?>"><?php echo $nombreCurso; ?></td>
                                <td id="botonAsig-<?php echo $idAlumnos; ?>">

                                <?php if ($nombreCurso=='Sin Curso') { ?>

                                <button id="boton-<?php echo $idAlumnos; ?>" class="btn btn-danger glyphicon glyphicon-pencil" onclick="botonInscribir('<?php echo $datos; ?>')">Inscribir</button>

                                <?php }else{ ?>

                                  <button id="boton-<?php echo $idAlumnos; ?>" class="btn btn-danger glyphicon glyphicon-pencil" onclick="botonInscribir('<?php echo $datos; ?>')" disabled>Inscribir</button>

                                <?php } ?>


                                </td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>  

                    </div> 

                    </div>

                </div>


               
                  <script type="text/javascript">
$(document).ready(function(){

    var tablaAlu = $('#tablaAlu').DataTable({ 
        "destroy":true,
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });


});





</script>
             

            </div>   
                               
            
            <div class="modal-footer">
                
                <button type="button" class="btn btn-light" data-dismiss="modal">Salir</button>
            </div>
       
        </div>
    </div>
</div>  

