
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
    if (isset($_SESSION['idIns'])){
        $idIns=$_SESSION['idIns'];

        $cicloLectivo=$_SESSION['cicloLectivo'];

          $cursoSe=$_SESSION['cursoSe'];
     

                $c2onsulta = "SELECT `datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos`, `curso_$cicloLectivo`.`nombre` FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos` = `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `inscrip_curso_alumno_$cicloLectivo`.`idCurso` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idIns`='$idIns'";
                $r2esultado = $conexion->prepare($c2onsulta);
                $r2esultado->execute();
                $d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

                foreach($d2ata as $d2at) {
                    $nombreAlumnos=$d2at['nombreAlumnos'];
                    $dniAlumnos=$d2at['dniAlumnos'];
                    $nombreCurso=$d2at['nombre'];
                 } 

           

?>

<form id="inpudProbar">

<input hidden="" id="cursoSe" value="<?php echo $cursoSe; ?>">
<input hidden="" id="ciclo" value="<?php echo $cicloLectivo; ?>">



        
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
             <button type="submit"  type="button" class="btn btn-outline-primary btn-block modalCRUD_Libreta_Docentefi">Libreta  <span class="badge badge-light"> GUARDAR LOS DATOS EDITADOS Y ACTUALIZAR ANALÍTICO</span></button>
            
        </div>




                    <div class="table-responsive">        
                        <table id="tablaLibreta11" class="table table-bordered border-primar">

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

                                    $descrip = array();

                                     $nom=0; 

                               

                                    foreach($data1 as $dat1) {
                                        $contador++; 

                                        array_push($columnas, $dat1['nombre']);

                                        array_push($descrip, $dat1['descri']);
                              
                              

                                                                                      
                                ?>
                                <th><span style='  font-size: 24px;writing-mode: vertical-rl; transform: rotate(180deg); vertical-align:middle;'>
 
                                <?php echo $dat1['nombre']; ?>


                            



                                </span></th>
                                <?php 

                                $nom++;


                            } ?>
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
                                    $contadoresDescrip=0;
                                    foreach ($columnas as &$Nombrecolum) {

                                        $consulta = "SELECT `id_libreta`, `$Nombrecolum` FROM `libreta_digital_$cicloLectivo` WHERE `id_libreta`= '$id_libretaF'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                         foreach($data as $dat) {

                                            $nota=$dat[''.$Nombrecolum.''];

                                        }

                                        $contadoresF++;


                                        if ($descrip[$contadoresDescrip]=='TEXTO') {
                                       

                                           ?>
                                    

                                    <td><input type="text" class="form-control bg-dark-x border-0" id="<?php echo $id_libretaF.'-'.$contadoresF; ?>" value="<?php 


                                     if ($nota=='undefined'){

                                      echo '';
                                    }else{

                                      echo $nota;
                                    } 


                                    ?>" disabled="true"></td>
                                    <?php



                                        }else{


                                    ?>
                                    

                                    <td>


                                      <input type="number" class="form-control bg-dark-x border-0" id="<?php echo $id_libretaF.'-'.$contadoresF; ?>" value="<?php if ($nota=='undefined'){

                                      echo '';
                                    }else{

                                      echo $nota;
                                    } ?>" min="3" max="10" disabled="true">

                                  


                                    </td>
                                    <?php


                                    }


                                    $contadoresDescrip++;

                                    
                                    }

                                     ?>

                                 
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
         
</form> 
<input hidden="" id="contadorF" value="<?php echo $contador; ?>">

<div id="cargaImprimir"></div>





 <script type="text/javascript">
$(document).ready(function(){

    


  Swal.fire(
          'IMPORTANTE !!',
          'No se olvide de guardar los datos despues de modificarlos',
          'warning'
        )


    var tablaLibreta = $('#tablaLibreta11').DataTable({ 

    "destroy":true,

     scrollY:        "400px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns: true,
        fixedColumns:   {
            leftColumns: 2//Le indico que deje fijas solo las 2 primeras columnas
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



$("#RegresarLibreta").click(function(e){
e.preventDefault(); 
  $('#imagenProceso').show();

      $('#libreTaOcul').show();

      $('#libretaFina').html('');
                

           
    
 $('#imagenProceso').hide(); 

}); 



//botón EDITAR    
 $("#inpudProbar").submit(function(e){
                e.preventDefault();    
             

    fila = $(this).closest("tr");




Swal.fire({
  title: 'ESTA SEGURO DE EDITAR',
  text: "Una vez editado no se podra recuperar la nota",
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


         $.ajax({
          type:"post",
          data:datosEviar,
          url:'bd/crud_Notas_LibretaDigitalFinalAna.php',
          success:function(r){
          
          

          }
        });
}
}    






</script>




<?php  } ?>



