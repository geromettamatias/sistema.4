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


if (isset($_SESSION['cursoSeProfesor'])){
$cursoSeProfesor=$_SESSION['cursoSeProfesor'];

$cicloLectivo=$_SESSION['cicloLectivoFina'];


 
$consulta = "SELECT `asignacion_asignatura_docente_$cicloLectivo`.`idCurso`, `asignacion_asignatura_docente_$cicloLectivo`.`idAsignatura`, `curso_$cicloLectivo`.`nombre` AS 'nombreCurso', `plan_datos_asignaturas`.`nombre` AS 'nombreAsignacion' FROM `asignacion_asignatura_docente_$cicloLectivo` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `asignacion_asignatura_docente_$cicloLectivo`.`idCurso` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `asignacion_asignatura_docente_$cicloLectivo`.`idAsignatura` WHERE `asignacion_asignatura_docente_$cicloLectivo`.`idAsig` = '$cursoSeProfesor'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($dat1a as $da1t) { 
            $idCurso=$da1t['idCurso'];
            $idAsignatura=$da1t['idAsignatura'];

            $nombreCurso=$da1t['nombreCurso'];
            $nombreAsignacion=$da1t['nombreAsignacion'];
        }


?>

<form id="inpudProbar">

 

                <div class="col-lg-12 p-2">
                    <h1>PLANILLA DE CALIFICACIONES</h1>
                </div>
                <div class="col-lg-12 p-2">
                    <h2>CURSO: <?php echo $nombreCurso; ?></h2>
                </div>
                <div class="col-lg-12 p-2">
                    <h2>ASIGNATURA: <?php echo $nombreAsignacion; ?></h2>
                </div>
                <div class="col-lg-12 p-2">
                    <button type="button" id="irImprimir" class="btn btn-outline-info btn-block">Libreta Digital <span class="badge badge-light"> IMPRIMIR</span></button>
                </div>
                <div class="col-lg-12 p-2">
                    <button type="submit" type="button" class="btn btn-outline-danger btn-block modalCRUD_Libreta_Docentefi">Libreta Digital <span class="badge badge-light"> GUARDAR LOS DATOS EDITADOS</span></button>
                </div>
            

                        <table id="tablaLibreta" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                                       
                                <th>N°</th> 
                                <th>APELLIDO Y NOMBRE</th>
                                <th>DNI</th>
                                <?php
                                    $consulta = "SELECT `idCabezera`, `nombre`, `descri`, `editarDocente`, `corresponde` FROM `cabezera_libreta_digital_$cicloLectivo`";
                                    $resultado = $conexion->prepare($consulta);
                                    $resultado->execute();
                                    $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);

                                    $contador=0;

                                    $columnas = array(); 
                                    $preguntaDocente = array(); 
                                    $descrip = array(); 

                               

                                    foreach($data1 as $dat1) {
                                        $contador++;                                                        
                                ?>
                                <th><?php 

                                array_push($preguntaDocente, $dat1['editarDocente']);
                                array_push($columnas, $dat1['nombre']);
                                array_push($descrip, $dat1['descri']);
                              
                              



                                echo $dat1['nombre'] ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $consulta = "SELECT `libreta_digital_$cicloLectivo`.`id_libreta`, `datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos`, `curso_$cicloLectivo`.`nombre` FROM `libreta_digital_$cicloLectivo` INNER JOIN `inscrip_curso_alumno_$cicloLectivo` ON `inscrip_curso_alumno_$cicloLectivo`.`idIns` = `libreta_digital_$cicloLectivo`.`idIns` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos` = `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `inscrip_curso_alumno_$cicloLectivo`.`idCurso` WHERE `libreta_digital_$cicloLectivo`.`idAsig` ='$idAsignatura' AND `curso_$cicloLectivo`.`nombre`= '$nombreCurso'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                           
                            foreach($data as $dat) {

                            $id_libretaF=$dat['id_libreta'];
                            $nombre=$dat['nombreAlumnos'];
                            $dniAlumnos=$dat['dniAlumnos'];
                            ?>
                            <tr>

                                <td><?php echo $id_libretaF; ?></td>
                                <td><?php echo $nombre; ?></td>
                                <td><?php echo $dniAlumnos; ?></td>
                            
                                    <?php 
                                    $nota='';
                                    $contadoresF=0;
                                     $contadoresDescrip=0;
                                    foreach ($columnas as &$Nombrecolum) {

                                        $consulta = "SELECT  `$Nombrecolum` FROM `libreta_digital_$cicloLectivo` WHERE `id_libreta`= '$id_libretaF'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                         foreach($data as $dat) {

                                            $nota=$dat[$Nombrecolum];

                                        }

                                       

                                        if ($preguntaDocente[$contadoresF]=="SI") {
                                            # code...
                                             $contadoresF++;



                                         
                                   if ($descrip[$contadoresDescrip]=='TEXTO') {
                                       

                                           ?>
                                    

                                    <td><input type="text" class="form-control bg-dark-x border-0" id="<?php echo $id_libretaF.'-'.$contadoresF; ?>" value="<?php 

                                    if ($nota=='undefined'){

                                      echo '';
                                    }else{

                                      echo $nota;
                                    }

                                     ?>"></td>
                                    <?php



                                        }else{


                                    ?>
                                    

                                    <td><input type="number" class="form-control bg-dark-x border-0" id="<?php echo $id_libretaF.'-'.$contadoresF; ?>" value="<?php 


                                    if ($nota=='undefined'){

                                      echo '';
                                    }else{

                                      echo $nota;
                                    } 


                                    ?>" min="3" max="10"></td>
                                    <?php


                                    }


                                    $contadoresDescrip++;







                                        }else{
                                             $contadoresF++;
                                      ?>
                                    

                                    <td><input type="text" class="form-control bg-dark-x border-0" id="<?php echo $id_libretaF.'-'.$contadoresF; ?>" value="<?php  if ($nota=='undefined'){

                                      echo '';
                                    }else{

                                      echo $nota;
                                    } ?>" disabled></td>


                                    <?php


                                        }
                                    
                                    }

                                     ?>

                                 
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    


</form> 
<input hidden="" id="contadorF" value="<?php echo $contador; ?>">



 <script type="text/javascript">
$(document).ready(function(){

$('#imagenProceso').hide();
    var tablaLibreta = $('#tablaLibreta').DataTable({ 


   
    "destroy":true,

     scrollY:        "400px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns: true,
        fixedColumns:   {
            leftColumns: 3//Le indico que deje fijas solo las 2 primeras columnas
        },

   
     language: {
      lengthMenu: "Display _MENU_ records per page",
      zeroRecords: "Nothing found - sorry",
      info: "Showing page _PAGE_ of _PAGES_",
      infoEmpty: "No records available",
      search: "",
      searchPlaceholder: "Buscar",
      loadingRecords: "Cargando...",
      processing: "Procesando....",
      paginate: {
        first: "primero",
        last: "ultimo",
        next: "siguiente",
        previous: "anterior"
      },
      infoFiltered: "(filtered from _MAX_ total records)"
    },
   

                
    });



var fila; //capturar la fila para editar o borrar el registro
 

$('#irImprimir').click(function(e) {
e.preventDefault();         
 window.open('gestion/librebretaDigitalImprimir.php', '_blank');

    });





//botón EDITAR    
 $("#inpudProbar").submit(function(e){
                e.preventDefault();    
             

  fila = $(this).closest("tr");


Swal.fire({
  title: 'ESTA SEGURO DE EDITAR ESTOS REGISTROS',
  text: "Una vez editado no se podra recuperar los datos",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes'
}).then((result) => {
  if (result.isConfirmed) {
    

        tablaLibreta.rows().data().each(function (value) {
            var libreta= value[0];
           
               
            editar_Nota(libreta);


            });
          
            Swal.fire(
          'MUY BIEN',
          'Los datos fueron registrados y guardados en la base de dato',
          'success'
        )
            


  }
})



});



function editar_Nota(libreta) {

contador = $("#contadorF").val();

if (contador > 0) {

datosEviar='contador='+contador + '&libreta='+libreta;
 
for (var i = contador; i > 0; i--) {

    ideElemento=libreta+'-'+i;
    
    nota = $('#'+ideElemento).val();

    datosEviar  =datosEviar+ '&'+ideElemento+'='+ nota;
   
   
}

        $.ajax({
          type:"post",
          data:datosEviar,
          url:'bd/crud_Notas_LibretaDigital.php',
          success:function(r){
          
          
          }
        });


     


}
}    








  

});

</script>



   <?php
                                }
                            ?> 
