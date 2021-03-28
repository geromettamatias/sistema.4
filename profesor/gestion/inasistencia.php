
<!--INICIO del cont principal-->
<div class="container">
<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();


if (isset($_SESSION["s_usuarioProfesor"])){
$s_usuarioProfesor=$_SESSION['s_usuarioProfesor'];


$cicloLectivo=$_SESSION['cicloLectivo'];






         $c3onsulta = "SELECT `idDocente`, `dni`, `nombre` FROM `datos_docentes` WHERE `dni`='$s_usuarioProfesor'";
        $r3esultado = $conexion->prepare($c3onsulta);
        $r3esultado->execute();
        $d3ata=$r3esultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($d3ata as $d3at) {
            $idDocente=$d3at['idDocente'];
            $nombre=$d3at['nombre'];
            $dni=$d3at['dni'];
         }






?>


<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <h2>INASISTENCIA - Ciclo <?php echo $cicloLectivo; ?></h2><br>
                    
                    <div id="nombreAlumnosF311"><h5>Apellido y Nombre del Docente:<?php echo $nombre; ?></h5></div>
                    <div id="dniF311"><h5>DNI del Docente: <?php echo $dni; ?></h5></div>
                </div>
        </div>
</div>


<input type="text" hidden=""  id="datosF311" value="<?php echo $nombre; ?>; DNI:<?php echo $dni; ?>">

 
<div class="container">
    <div class="row">
        <div class="col-lg-12 p-2">
            <div class="table-responsive">
                <table id="INASISTENCIA_Docente" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>CURSO</th>
                                <th>ASIGNATURA</th>
                                <th>FECHA</th>
                                <th>CANTIDAD</th> 
                                <th>JUSTIFICO</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            
                        

                            $consulta = "SELECT `asistenciadocente_$cicloLectivo`.`id_Asistencia`, `curso_$cicloLectivo`.`nombre` AS 'nombreCurso', `plan_datos_asignaturas`.`nombre`, `asistenciadocente_$cicloLectivo`.`fecha`, `asistenciadocente_$cicloLectivo`.`cantidad`, `asistenciadocente_$cicloLectivo`.`justificado` FROM `asistenciadocente_$cicloLectivo` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `asistenciadocente_$cicloLectivo`.`idCurso` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `asistenciadocente_$cicloLectivo`.`idAsignatura` WHERE `asistenciadocente_$cicloLectivo`.`idDocente` = '$idDocente'";       
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                            foreach($data as $dat) { 

                            $id_Asistencia=$dat['id_Asistencia'];
                            $nombreCurso=$dat['nombreCurso'];
                            $nombreAsign=$dat['nombre'];
                           
                            $fecha=$dat['fecha'];
                            $cantidad=$dat['cantidad'];
                            $justificado=$dat['justificado'];
                                                                                  
                            ?>
                            <tr>
                              
                                <td><?php echo $id_Asistencia ?></td>
                                <td><?php echo $nombreCurso ?></td>
                                <td><?php echo $nombreAsign ?></td>
                                <td><?php echo $fecha ?></td>
                                <td><?php echo $cantidad ?></td>
                                <td><?php echo $justificado ?></td>
                                 
  
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
       
      

      
<!--Modal para CRUD-->
 
  
</div>


 <script type="text/javascript">
$(document).ready(function(){

$('#imagenProceso').hide();
     var datos=$("#nombreAlumnosF311").html();
    var datos1=$("#dniF311").html();
    

    var datosF3=$("#datosF311").val();





   
    INASISTENCIA_Docente=$('#INASISTENCIA_Docente').DataTable({ 

 
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
        messageTop:'INASISTENCIA DE '+datosF3, //Coloca el título dentro del excel
        className: 'btn btn-success'
      },
      {
        extend:    'pdfHtml5',
        text:      '<i class="fas fa-file-pdf"></i> ',
        titleAttr: 'Exportar a PDF',
        messageTop:'INASISTENCIA DE '+datosF3, //Coloca el título dentro del pdf
        className: 'btn btn-danger'
      },
      {
        extend:    'print',
        text:      '<i class="fa fa-print"></i> ',
        titleAttr: 'Imprimir',
        messageTop: '<h2>INASISTENCIA</h2>'+datos+datos1+'', //Coloca el título dentro del imprimir
        className: 'btn btn-info'
      },
    ] 
    });



});


 


</script>




<?php  } ?>

