<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();


if (isset($_SESSION['s_usuarioEstudiante'])){
$s_usuarioEstudiante=$_SESSION['s_usuarioEstudiante'];


  
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
                    <h2>ANALITICO</h2><br>
                    <div id="datosF411"><h5>Modalidad: <?php echo $nombrePlan; ?> // N°<?php echo $numeroPlan; ?></h5></div>
                    <div id="nombreAlumnosF311"><h5>Apellido y Nombre del Alumno:<?php echo $nombreAlumnos; ?></h5></div>
                    <div id="dniF311"><h5>DNI del Alumno:<?php echo $dniAlumnos; ?></h5></div>


                <button type="button" class="btn btn-success  modalCRUD_AnaliticoAlumnoFinas">Analítico (MODELO VIEJO)<span class="badge badge-light"> Imprimir</span></button>
                 <button type="button" class="btn btn-info modalCRUD_AnaliticoAlumnoFinasNuevo">Analítico (NUEVO MODELO)<span class="badge badge-light"> Imprimir</span></button>
            

                </div>
        </div>
</div>



<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablanotasFina333222" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                               <th>N°</th>
                                <th>CICLO</th> 
                                <th>ESPACIO CURRICULAR</th>
                                <th >CALIF NUME</th>
                                <th style="width: 50px;">CALIF ESCR</th> 
                                <th>CONDICIÓN</th> 
                                <th>MES</th> 
                                <th>AÑO</th>
                                <th>ESTABLECI.</th> 
                                
                                                    
                             
                            </tr>
                        </thead>
                        <tbody>
                            <?php 

                            $consulta = "SELECT analitico.idAnalitico, plan_datos_asignaturas.nombre, plan_datos_asignaturas.ciclo, analitico.nota, analitico.notaEscr,  analitico.fechaMes, analitico.fechaAño,  analitico.condicion,  analitico.establecimiento FROM analitico INNER JOIN plan_datos_asignaturas ON plan_datos_asignaturas.idAsig = analitico.idAsig WHERE analitico.idAlumno = '$idAlumnos'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                           
                            foreach($data as $dat) {                                
                    
                                $idAnalitico=$dat['idAnalitico'];
                                $nota=$dat['nota'];
                                $notaEscr=$dat['notaEscr'];

                                $ciclo=$dat['ciclo'];
                                $nombre=$dat['nombre'];

                                $fechaMes=$dat['fechaMes'];
                                 $fechaAño=$dat['fechaAño'];
                                $condicion=$dat['condicion'];
                                 $establecimiento=$dat['establecimiento'];
                            

                            ?>
                            <tr>
                              
                                <td><?php echo $idAnalitico ?></td>
                                <td><?php echo $ciclo ?></td>
                                <td><?php echo $nombre ?></td>

                                <td><?php echo $nota; ?></td>

                                <td><?php echo $notaEscr; ?></td>

                                <td><?php echo $condicion; ?></td>

                                <td><?php echo $fechaMes; ?></td>

                                <td><?php echo $fechaAño; ?></td>

                                <td><?php echo $establecimiento; ?></td>


                                
           
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


$(document).on("click", ".modalCRUD_AnaliticoAlumnoFinas", function(){


 window.open('gestion/analiticoImprimir.php', '_blank');   

});



$(document).on("click", ".modalCRUD_AnaliticoAlumnoFinasNuevo", function(){


 window.open('gestion/alumnosAnalitico4.php', '_blank');   

});


   
    tablanotasFina333222=$('#tablanotasFina333222').DataTable({


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
      
    });



});


 


</script>




<?php  } ?>



