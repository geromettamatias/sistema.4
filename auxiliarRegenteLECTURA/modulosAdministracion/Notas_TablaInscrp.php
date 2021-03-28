
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
<input hidden="" id="cicloFinal" value="<?php echo $cicloLectivo; ?>">
<div id="libreTaOcul">


                    <div class="table-responsive">        
                        <table id="tablaInscripcion" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>N°</th>
                                <th>DNI</th>
                                <th>APELL-NOMBRE</th>
                                <th>ANALÍTICO</th>
                                <th>ASIG. PENDI-EQUI</th>
                                <th>ASISTENCIA</th>
                                <th>LIBRETA/FICHA</th>
                            
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
                                    <button id='btn2' class="btn btn-outline-primary glyphicon glyphicon-pencil" onclick="analiticosFinalPPP('<?php echo $idAlumnos; ?>')">Analíticos</button>

                                  

                                </td>   

                                <td>

                                <button class="btn btn-outline-success glyphicon glyphicon-pencil" onclick="botonAsignaturaPendiente('<?php echo $idAlumnos ?>')">ASIGNATURAS PENDIENTES-EQUI</button> 

                                 </td>

                                <td>
                                    
                                  <button class="btn btn-outline-info glyphicon glyphicon-pencil" onclick="asistencia('<?php echo $idAlumnos ?>')">ASISTENCIA</button>
                                  

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



function analiticosFinalPPP(idAlumnos) {

  cadena="idAlumnos=" + idAlumnos;

  

$.ajax({
    type:"POST",
    url:"modulosAdministracion/elementos/probarAnalitico.php",
    data:cadena,
    beforeSend: function() {
          $("#imagenProceso").show();
         
                              },
    success:function(res){

      if (res==0) {

            Swal.fire({
                        title: 'Problema',
                        text: "El Alumno no tiene cargado el analitico, desea cargar el mismo?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Cargar'
                      }).then((result) => {
                        if (result.isConfirmed) {
                         
                          cargaAnalitico(cadena);
                        }
                      })

          $("#imagenProceso").hide();
                

      }else{

   

              $('#libreTaOcul').hide();
              $("#imagenProceso").hide();

            $('#libretaFina').load('modulosAdministracion/alumnosAnalitico2.php');
                            


      }
    
    
        

    }
  });



  


    

}







function cargaAnalitico(cadena) {
  
  $.ajax({
    type:"POST",
    url:"modulosAdministracion/elementos/seccionAnalitico.php",
    data:cadena,
    beforeSend: function() {
          $("#imagenProceso").show();
          
                              },
    success:function(r){

       $("#imagenProceso").hide();
      

      Swal.fire(
            'MuyBien',
            'You clicked the button!',
            'success'
                    )
    
     

    }
  });
}


function asistencia(idAlumnos) {



cicloLectivoFina=$('#cicloFinal').val();

    $.ajax({
        url: "asistencias/secion/alumno.php",
        type: "POST",
        dataType: "json",
        data: {id:idAlumnos, cicloLectivoFina:cicloLectivoFina},
        success: function(data){  


            $('#libreTaOcul').hide();
              $("#imagenProceso").hide();

            $('#libretaFina').load('asistencias/asistenciaAlumno_Tabla.php');
             
    
              
        }        
    });

}





</script>