
    <style>
   
            table.table-bordered{
    border:1px solid black;
 
        }
      table.table-bordered > thead > tr > th{
          border:1px solid black;
      }
      table.table-bordered > tbody > tr > td{
          border:1px solid black;
      }
    </style>
<?php
    include_once '../bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    session_start();
    if (isset($_SESSION['idAlumnos'])){
        $idAlumnos=$_SESSION['idAlumnos'];

        $cicloLectivo=$_SESSION['cicloLectivo'];

          $cursoSe=$_SESSION['cursoSe'];
     


                $c2onsulta = "SELECT `datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos`, `curso_$cicloLectivo`.`nombre` FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos` = `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `inscrip_curso_alumno_$cicloLectivo`.`idCurso` WHERE `datosalumnos`.`idAlumnos`='$idAlumnos'";
                $r2esultado = $conexion->prepare($c2onsulta);
                $r2esultado->execute();
                $d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

                foreach($d2ata as $d2at) {
                    $nombreAlumnos=$d2at['nombreAlumnos'];
                    $dniAlumnos=$d2at['dniAlumnos'];
                    $nombreCurso=$d2at['nombre'];
                 } 


        $consulta = "SELECT `asignaturas_pendientes_$cicloLectivo`.`idAsigPendiente`,`asignaturas_pendientes_$cicloLectivo`.`idAlumno`,`asignaturas_pendientes_$cicloLectivo`.`asignaturas`, `asignaturas_pendientes_$cicloLectivo`.`situacion`, `plan_datos_asignaturas`.`nombre`, `plan_datos_asignaturas`.`ciclo` FROM `asignaturas_pendientes_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig`= `asignaturas_pendientes_$cicloLectivo`.`asignaturas`  WHERE `asignaturas_pendientes_$cicloLectivo`.`idAlumno`='$idAlumnos'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

           

?>



<input hidden="" id="cicloFinalLet" value="<?php echo $cicloLectivo; ?>">


        
        <div class="col-lg-12 p-2">
            <div id="datosF"><h5>Curso: <?php echo $nombreCurso; ?></h5></div>
        </div>
        <div class="col-lg-12 p-2">
            <div id="nombreAlumnosF"><h5>Apellido y Nombre del Alumno:<?php echo $nombreAlumnos; ?></h5></div>
            <div id="dniF"><h5>DNI del Alumno:<?php echo $dniAlumnos; ?></h5></div>
        </div>
        <div class="col-lg-12 p-2">
            <button type="button" class="btn btn-outline-dark btn-block" id="RegresarLibreta">Libreta / Ficha <span class="badge badge-light"> Regresar lista de Alumno del curso</span></button>
        </div>
        <div class="col-lg-12 p-2">
            
            
            <button type="button" class="btn btn-outline-success btn-block modalCRUD_Libreta_DocentefiFinalFichaAlumno2">Ficha Digital <span class="badge badge-light"> Imprimir la segunda carilla</span></button>
        </div>
 

                    <div class="table-responsive">        
                        <table id="tablaAsignacion" class="table table-bordered border-primar">

                        <thead class="text-center">
                            <tr>
                                        
                                <th>N°</th>
                                <th>N°AS</th>
                                <th>SITUACIÓN</th> 
                                <th>ASIGNATURA</th>
                           
                           
                            </tr>
                        </thead>
                        <tbody>
                          <?php                            
                            foreach($data as $dat) {                                                        
                            ?>

                            <tr>
                              <td><?php echo $dat['idAsigPendiente'] ?></td>
                              <td><?php echo $dat['asignaturas'] ?></td>
                              <td><?php echo $dat['situacion'] ?></td>
                              <td><?php echo $dat['nombre'].' '.$dat['ciclo']; ?></td>
                              

                            </tr>

                             <?php
                                }
                            ?>
                                                       
                        </tbody>        
                       </table>                    
                    </div>
         



 <script type="text/javascript">

 
$(document).ready(function(){

 var tablaAsignacion = $('#tablaAsignacion').DataTable({ 

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


 
$(document).on("click", ".modalCRUD_Libreta_DocentefiFinalFichaAlumno2", function(){


 
   window.open('modulosAdministracion/asignaturasPendientesFicha.php', '_blank'); 

    

});


$("#RegresarLibreta").click(function(){

  $('#imagenProceso').show();

      $('#libreTaOcul').show();

      $('#libretaFina').html('');
                

           
    
 $('#imagenProceso').hide(); 

}); 


});




</script>




<?php  } ?>



