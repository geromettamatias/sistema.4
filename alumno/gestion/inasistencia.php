
 <?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();


if (isset($_SESSION['s_usuarioEstudiante'])){
$s_usuarioEstudiante=$_SESSION['s_usuarioEstudiante'];

$cicloLectivo=$_SESSION['cicloLectivo'];



  
        $c9onsulta = "SELECT datosalumnos.idAlumnos, datosalumnos.nombreAlumnos, datosalumnos.dniAlumnos, plan_datos.nombre AS 'nombrePlan', plan_datos.numero AS 'numeroPlan' FROM datosalumnos INNER JOIN plan_datos ON plan_datos.idPlan = datosalumnos.idPlanEstudio WHERE datosalumnos.dniAlumnos = '$s_usuarioEstudiante'";
        $r9esultado = $conexion->prepare($c9onsulta);
        $r9esultado->execute();
        $d9ata=$r9esultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($d9ata as $d9at) {
            $idAlumnos=$d9at['idAlumnos'];
            $nombreAlumnos=$d9at['nombreAlumnos'];
            $dniAlumnos=$d9at['dniAlumnos'];
            $nombrePlan=$d9at['nombrePlan'];
            $numeroPlan=$d9at['numeroPlan'];
         }




?>


<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <h2>INASISTENCIA - Ciclo : <?php echo $cicloLectivo; ?></h2><br>
                    <div id="datosF411"><h5>Modalidad: <?php echo $nombrePlan; ?> // N°<?php echo $numeroPlan; ?></h5></div>
                    <div id="nombreAlumnosF311"><h5>Apellido y Nombre del Alumno:<?php echo $nombreAlumnos; ?></h5></div>
                    <div id="dniF311"><h5>DNI del Alumno:<?php echo $dniAlumnos; ?></h5></div>
                </div>
        </div>
</div>



<input type="text" hidden=""  id="datosF311" value="<?php echo 'Modalidad: '.$nombrePlan.'// N°'.$numeroPlan. ' -- Apellido y nombre: '.$nombreAlumnos.'; DNI: : '.$dniAlumnos; ?>">

 
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="INASISTENCIA_ALUMNO" class="table table-striped table-bordered table-condensed" style="width:100%">
                       <thead class="text-center">
                            <tr>
                         
                                <th>ID</th>
                                <th>FECHA</th>
                                <th>CANTIDAD</th>
                                <th>JUSTIFICO</th> 
                                <th>CORRESPONDE</th>
                                <th>OBSERV.</th>
                           
                            </tr>
                        </thead>
                                 <tbody>
                            <?php 

                            $consulta = "SELECT `id_Asistencia`, `idAlumno`, `fecha`, `cantidad`, `justificado`, `observacion`, `encabezado` FROM `asistenciaalumno_$cicloLectivo` WHERE `idAlumno`='$idAlumnos'";       
                                $resultado = $conexion->prepare($consulta);
                                $resultado->execute();
                                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                          


                            foreach($data as $dat) {

                            $id_Asistencia=$dat['id_Asistencia'];
               
                            $fecha=$dat['fecha'];
                            $cantidad=$dat['cantidad'];
                            $justificado=$dat['justificado'];
                            $observacion=$dat['observacion'];
                            $encabezado=$dat['encabezado'];
                                

                            ?>
                            <tr>
                              
                                <td><?php echo $id_Asistencia ?></td>
                                <td><?php echo $fecha ?></td>
                                <td><?php echo $cantidad ?></td>
                                <td><?php echo $justificado; ?></td>
                                <td><?php echo $encabezado; ?></td>
                                <td><?php echo $observacion; ?></td>
           
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
$('#imagenProceso').hide();

     var datos=$("#nombreAlumnosF311").html();
    var datos1=$("#dniF311").html();
    var datosF=$("#datosF411").html();

    var datosF3=$("#datosF311").val();





   
    INASISTENCIA_ALUMNO=$('#INASISTENCIA_ALUMNO').DataTable({ 
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
        messageTop: datosF3, //Coloca el título dentro del excel
        className: 'btn btn-success',
        title: 'INASISTENCIA'
      },
      {
        extend:    'pdfHtml5',
        text:      '<i class="fas fa-file-pdf"></i> ',
        titleAttr: 'Exportar a PDF',
        messageTop: datosF3, //Coloca el título dentro del pdf
        className: 'btn btn-danger',
        title: 'INASISTENCIA'
      },
      {
        extend:    'print',
        text:      '<i class="fa fa-print"></i> ',
        titleAttr: 'Imprimir',
        messageTop: datosF+datos+datos1, //Coloca el título dentro del imprimir
        className: 'btn btn-info',
        title: 'INASISTENCIA'
      },
    ] 
    });



});


 


</script>




<?php  } ?>



