
 <?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();


if (isset($_SESSION['s_usuarioEstudiante'])){
$s_usuarioEstudiante=$_SESSION['s_usuarioEstudiante'];

$cicloLectivo=$_SESSION['cicloLectivoFina'];
$tenerLibreta=0;


         $c3onsulta = "SELECT `inscrip_curso_alumno_$cicloLectivo`.`idIns`, `curso_$cicloLectivo`.`nombre` AS 'nombreCurso', `curso_$cicloLectivo`.`ciclo`, `inscrip_curso_alumno_$cicloLectivo`.`idAlumno`, `datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos`, `plan_datos`.`nombre` AS 'nombrePlan', `plan_datos`.`numero` AS 'numeroPlan' FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `inscrip_curso_alumno_$cicloLectivo`.`idCurso` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos` = `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` INNER JOIN `plan_datos` ON `plan_datos`.`idPlan` = `datosalumnos`.`idPlanEstudio` WHERE `datosalumnos`.`dniAlumnos` = '$s_usuarioEstudiante'";
        $r3esultado = $conexion->prepare($c3onsulta);
        $r3esultado->execute();
        $d3ata=$r3esultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($d3ata as $d3at) {
            $nombreCurso=$d3at['nombreCurso'];
            $ciclo=$d3at['ciclo'];
            $idAlumno=$d3at['idAlumno'];
            $nombreAlumnos=$d3at['nombreAlumnos'];
            $dniAlumnos=$d3at['dniAlumnos'];
            $nombrePlan=$d3at['nombrePlan'];
            $numeroPlan=$d3at['numeroPlan'];
            $idIns=$d3at['idIns'];

            $tenerLibreta=1;

         }



?>

<?php if ($tenerLibreta==0) { ?>
<div class="container">
        <div class="row">
                <div class="col-lg-12"><br><br>
                    <h3>ACTUALMENTE NO ESTA CARGADO SU LIBRETA DIGITAL</h3>
                    <img src="imag/alto.jpg" style='width: 50%'>
                </div>
        </div>
</div>
<?php }else{ ?>

<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <h2>LIBRETA DIGITAL</h2><br>
                    <div id="datosF"><h5>Modalidad: <?php echo $nombrePlan; ?> // N°<?php echo $numeroPlan; ?>; Curso: <?php echo $nombreCurso; ?></h5></div>
                    
                    <div id="nombreAlumnosF"><h5>Apellido y Nombre del Alumno:<?php echo $nombreAlumnos; ?></h5></div>
                    <div id="dniF"><h5>DNI del Alumno:<?php echo $dniAlumnos; ?></h5></div>
                </div>
        </div>
</div>

<br>
<button type="button" class="btn btn-outline-danger btn-block modalCRUD_Libreta_DocentefiFinal">Libreta Digital <span class="badge badge-light"> Imprimir Toda la Libreta</span></button><br>
 
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaLibreta" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                                       
                                <th>N°Lib</th> 
                                <th>Asignatura</th>
                                <?php
                                     $consulta = "SELECT `idCabezera`, `nombre`, `descri`, `editarDocente`, `corresponde` FROM `cabezera_libreta_digital_$cicloLectivo`";
                                    $resultado = $conexion->prepare($consulta);
                                    $resultado->execute();
                                    $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);

                                    $contador=0;

                                    $columnas = array(); 

                               

                                    foreach($data1 as $dat1) {
                                        $contador++;                                                        
                                ?>
                                <th><?php 

                                
                                array_push($columnas, $dat1['nombre']);
                              



                                echo $dat1['nombre'] ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 

                            $consulta = "SELECT `libreta_digital_$cicloLectivo`.`id_libreta`, `plan_datos_asignaturas`.`nombre` FROM `libreta_digital_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `libreta_digital_$cicloLectivo`.`idAsig` WHERE `libreta_digital_$cicloLectivo`.`idIns`='$idIns'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);


                           
                           foreach($data as $dat) {

                            $id_libretaF=$dat['id_libreta'];
                            $nombre=$dat['nombre'];
                         
                            ?>
                            <tr>

                                <td><?php echo $id_libretaF; ?></td>
                                <td><?php echo $nombre; ?></td>
                        
                            
                                    <?php 
                                    $nota=0;
                                    $contadoresF=0;
                                    foreach ($columnas as &$Nombrecolum) {

                                        $consulta = "SELECT  `$Nombrecolum` FROM `libreta_digital_$cicloLectivo` WHERE `id_libreta`= '$id_libretaF'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                         foreach($data as $dat) {

                                            $nota=$dat[''.$Nombrecolum.''];

                                        }

                                        $contadoresF++;
                                    ?>
                                    

                                    <td><?php if ($nota=='3' || $nota=='4' || $nota=='5' || $nota=='2' || $nota=='1' || $nota=='0') {
                                   echo 'EP';
                                }else{

                                         if ($nota=='undefined'){

                                      echo '';
                                    }else{

                                      echo $nota;
                                    }

                                    
                                } ?></td>


                                    <?php

                                    
                                    }

                                     ?>

                                 
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


    var datos=$("#nombreAlumnosF").html();
    var datos1=$("#dniF").html();
    var datos2=$("#datosF").html();

    var datosF3=$("#datosF3").val();


    $(document).on("click", ".modalCRUD_Libreta_DocentefiFinal", function(){


 
   window.open('gestion/LibretaDigitalExtra.php', '_blank'); 

    

});



    tablaLibreta=$('#tablaLibreta').DataTable({ 


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


<?php }  } ?> 

