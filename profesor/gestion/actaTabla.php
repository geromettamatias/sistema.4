<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();


if (isset($_SESSION['buscarTipo'])){
$buscarTipo=$_SESSION['buscarTipo'];


$s_usuarioProfesor=$_SESSION['s_usuarioProfesor'];



 $c3onsulta = "SELECT `idDocente` FROM `datos_docentes` WHERE `dni`='$s_usuarioProfesor'";
        $r3esultado = $conexion->prepare($c3onsulta);
        $r3esultado->execute();
        $d3ata=$r3esultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($d3ata as $d3at) {
            $idDocente=$d3at['idDocente'];
           
         }



?>

<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tabla_acta" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>N°</th>
                                <th>ASIGNATURA</th>
                                <th>FECHA Y HORA</th>
                         

                                <th>INSCRIPCIONES</th>
                          
                            </tr>
                        </thead>
                        <tbody>
                            <?php 



                            $consulta = "SELECT actas_examen_datos.idActa, plan_datos_asignaturas.ciclo, plan_datos_asignaturas.nombre AS 'nombreAsignatura', plan_datos_asignaturas.idPlan, actas_examen_datos.precentacion FROM actas_examen_datos INNER JOIN plan_datos_asignaturas ON plan_datos_asignaturas.idAsig = actas_examen_datos.idAsignatura WHERE actas_examen_datos.tipo = '$buscarTipo' AND actas_examen_datos.docente1='$idDocente'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $d1ata=$resultado->fetchAll(PDO::FETCH_ASSOC);


                            foreach($d1ata as $d1at) { 

                              

                            $idActa=$d1at['idActa'];
                            $ciclo=$d1at['ciclo'];
                            $idPlan=$d1at['idPlan'];
                            $nombreAsignatura=$d1at['nombreAsignatura'];
                            $precentacion=$d1at['precentacion'];

                                        $consulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos` WHERE `idPlan`='$idPlan'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($data as $dat) {

                                                $idPlan = $dat['nombre'];

                                        }



                            
                         

                            ?>
                            <tr>
                                <td><?php echo $idActa ?></td>
                               
                                <td><?php echo $idPlan.'--'.$ciclo.'--'.$nombreAsignatura; ?> <button class="btn btn-outline-info glyphicon glyphicon-pencil" onclick="personalDocenteEncargo('<?php echo $idActa ?>')"> PERSONAL DOCENTE</button></td>
                                <td><?php

                                $date = date_create($precentacion);
                                $cadena_fecha_actual = date_format($date, 'd-m-Y  // H:i:s');


                                 echo $cadena_fecha_actual; ?></td>
                                
                                <td><button class="btn btn-outline-danger glyphicon glyphicon-pencil" onclick="inscrpcionALUMNOS('<?php echo $idActa ?>')">VER ALUMNOS</button></td>
                            
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

    
    var tabla_acta = $('#tabla_acta').DataTable({ 

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
        },
        //para usar los botones   
        responsive: "true",
        dom: 'Bfrtilp',       
        buttons:[ 
      {
        extend:    'excelHtml5',
        text:      '<i class="fas fa-file-excel"></i> ',
        titleAttr: 'Exportar a Excel',
        className: 'btn btn-success'
      },
      {
        extend:    'pdfHtml5',
        text:      '<i class="fas fa-file-pdf"></i> ',
        titleAttr: 'Exportar a PDF',
        className: 'btn btn-danger'
      },
      {
        extend:    'print',
        text:      '<i class="fa fa-print"></i> ',
        titleAttr: 'Imprimir',
        className: 'btn btn-info'
      },
    ]         
    });





 
});

function personalDocenteEncargo(idActa) {

    $.ajax({
          type:"post",
          data:'idActa=' + idActa,
          url:'bd/actaDocenteACARGO.php',
          success:function(res){

            data = res.split('||');

            docentePresidente = data[0];            
            docente1erSuplente = data[1];
            docente2doSuplente = data[2];
          
            
            Swal.fire('Presidente es '+docentePresidente+'<br>1er suplente es '+docente1erSuplente+'<br>2do suplente es '+docente2doSuplente)
          
          }
        });
}


function inscrpcionALUMNOS(idActa) {
   
    $.ajax({
          type:"post",
          data:'idActa=' + idActa,
          url:'bd/session_actaInscrAlumno.php',
          success:function(res){

                $('#imagenProceso').show();
                $('#buscarTablaInstitucional').hide(''); 
                $('#tablaInstitucional').load('gestion/actaInsc-ALUMNO.php');
                $('#contenidoAyuda').html(''); 
                $('#imagenProceso').hide();

    
          
          }
        });
}

</script>  



<?php } ?> 

