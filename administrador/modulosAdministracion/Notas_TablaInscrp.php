
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


if ((isset($_SESSION['cursoSe']))){
$cursoSe=$_SESSION['cursoSe'];

  $cicloLectivo=$_SESSION['cicloLectivo'];



if ($cursoSe!='0'){


 
$consulta = "SELECT `idIns`, `idCurso`, `idAlumno` FROM `inscrip_curso_alumno_$cicloLectivo` WHERE `idCurso`='$cursoSe'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


?>

<div id="libreTaOcul">


                    <div class="table-responsive">        
                        <table id="tablaInscripcion" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>N°inscrip</th>
                                <th>DNI</th>
                                <th>Apellido y Nombre</th>
                                <th>Asignaturas Pendientes</th>
                                <th>Datos Extas</th>
                                <th>Botones</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php  

                            foreach($data as $dat) { 

                              

                                $idIns=$dat['idIns'];
                                $idAlumno=$dat['idAlumno'];

                              


                                $consulta1 = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor`, `idPlanEstudio` FROM `datosalumnos` WHERE `idAlumnos`='$idAlumno'";
                                    $resultado1 = $conexion->prepare($consulta1);
                                    $resultado1->execute();
                                    $d1ata=$resultado1->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($d1ata as $d1at) {
                                        $idAlumnos=$d1at['idAlumnos'];
                                        $dniAlumnos=$d1at['dniAlumnos'];
                                        $nombreAlumnos=$d1at['nombreAlumnos'];

                                        
                                    }
                            ?>
                            <tr>
                              
                      
                                <td><?php echo $idIns ?></td>

                                <td><?php echo $dniAlumnos ?></td>
                             
                                <td><?php echo $nombreAlumnos ?></td>
                                 <td>
                                    <button class="btn btn-outline-success glyphicon glyphicon-pencil" onclick="botonAsignaturaPendiente('<?php echo $idAlumnos ?>')">ASIGNATURAS PENDIENTES-EQUI</button>

                                  

                                </td>    



                                <td>
                                    <button class="btn btn-outline-info glyphicon glyphicon-pencil" onclick="botonDatosFicha('<?php echo $idAlumnos ?>')">Datos Ficha</button><br>
                                    <button class="btn btn-outline-dark glyphicon glyphicon-pencil" onclick="botonDatosLibreta('<?php echo $idAlumnos ?>')">Datos Libreta</button>

                                  

                                </td>
           
                                <td>
                                    <button class="btn btn-outline-danger glyphicon glyphicon-pencil" onclick="botonNotas('<?php echo $idIns ?>')">LIBRETA/FICHA</button>

                                  

                                </td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
     
      
</div>


<div id="libretaFina"></div>









<?php  }

} ?>






  



<script type="text/javascript">
$(document).ready(function(){

var tablaInscripcion = $('#tablaInscripcion').DataTable({ 

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