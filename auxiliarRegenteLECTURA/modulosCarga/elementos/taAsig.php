
 <div class="form-group">
                    <div class="table-responsive">        
                        <table id="tablaDocente_Asig" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>N°</th> 
                                <th>ASIGNATURA</th>
                                <th>CURSOS</th> 
                          
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                             include_once '../../bd/conexion.php';
                              $objeto = new Conexion();
                              $conexion = $objeto->Conectar();

                              session_start();

                            if ((isset($_SESSION['docenteSEL']))){
                            $idDocente=$_SESSION['docenteSEL'];

                  
                            $cicloLectivoFINAL=$_SESSION['cicloLectivoFINAL'];

                            
                            $consulta = "SELECT `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idAsig`, `plan_datos_asignaturas`.`nombre`, `curso_$cicloLectivoFINAL`.`nombre` AS 'nombreCurso' FROM `asignacion_asignatura_docente_$cicloLectivoFINAL` INNER JOIN `plan_datos_asignaturas` ON `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idAsignatura` = `plan_datos_asignaturas`.`idAsig` INNER JOIN `curso_$cicloLectivoFINAL` ON `curso_$cicloLectivoFINAL`.`idCurso` = `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idCurso`WHERE `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idDocente`='$idDocente'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

                                                
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                             
                                <td><?php echo $dat['idAsig'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['nombreCurso'] ?></td>
                              
                            </tr>
                            <?php
                                }}
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
 <script type="text/javascript">
$(document).ready(function(){



 var tablaDocente_Asig = $('#tablaDocente_Asig').DataTable({ 

          
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


</script>