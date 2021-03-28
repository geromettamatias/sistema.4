
    <style>
      .table-striped>tbody>tr:nth-child(odd)>td, 
      .table-striped>tbody>tr:nth-child(odd)>th {
       background-color: #9BFEA7;
      }
      .table-striped>tbody>tr:nth-child(even)>td, 
      .table-striped>tbody>tr:nth-child(even)>th {
       background-color: #DADFF8;
      }
      .table-striped>thead>tr>th {
         background-color:  #D4FAD7;
      }

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
     $cursoSe=$_SESSION['cursoSe'];
        $cicloLectivo=$_SESSION['cicloLectivo'];
       
         $columna = array();  

        $cantidadCabezeras=0;
      $consulta = "SELECT `idCabezera`, `nombre`, `descri`, `editarDocente`, `corresponde` FROM `cabezera_libreta_digital_$cicloLectivo` WHERE `corresponde`='FICHA/LIBRETA'";
      $resultado = $conexion->prepare($consulta);
      $resultado->execute();
      $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
      foreach($data1 as $dat1) {

        $cantidadCabezeras++;

         $cabeNombre= $dat1['nombre'];

         array_push($columna, $cabeNombre); 

    }




$c2onsulta = "SELECT  `inscrip_curso_alumno_$cicloLectivo`.`idIns`  FROM `inscrip_curso_alumno_$cicloLectivo` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idCurso`='$cursoSe'";
                $r2esultado = $conexion->prepare($c2onsulta);
                $r2esultado->execute();
                $d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

                foreach($d2ata as $d2at) {
                    $idIns=$d2at['idIns'];
                }



   $asignaturas = array();
      $notas = array();
      $consulta = "SELECT `libreta_digital_$cicloLectivo`.`id_libreta`, `plan_datos_asignaturas`.`nombre` FROM `libreta_digital_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `libreta_digital_$cicloLectivo`.`idAsig` WHERE `libreta_digital_$cicloLectivo`.`idIns`='$idIns'";
      $resultado = $conexion->prepare($consulta);
      $resultado->execute();
      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

      foreach($data as $dat) {
        $id_libretaF=$dat['id_libreta'];
        

        array_push($asignaturas, $dat['nombre']);

        foreach ($columna as &$Nombrecolum) {
                $consulta = "SELECT `id_libreta`, `$Nombrecolum` FROM `libreta_digital_$cicloLectivo` WHERE `id_libreta`= '$id_libretaF'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                foreach($data as $dat) {

                  array_push($notas, $dat[''.$Nombrecolum.'']);

                }

          }

}


                  
?>

<button type="button" class="btn btn-outline-success btn-block modalCRUD_Centralizadora2">Imprimir la Centralizadora </button>

<br>

 

 

<table id="tablaCentralizadora" class="table table-bordered table-striped" style="width:100%">
        <thead>
            <tr style='text-align: center;'>
                
                <th rowspan="2">Apellido y Nombre</th>
                <th rowspan="2">DNI</th>
                <?php
                $cantidadAsignatura=0;
                foreach ($asignaturas as &$asig) {

                  $cantidadAsignatura++;
                ?>
                <th colspan="<?php echo $cantidadCabezeras; ?>"><?php echo $asig; ?></th>

                <?php
                 }
                  
                ?>

               
            </tr>
            <tr style='text-align: center;'>
            <?php

              for ($i=0; $i < $cantidadAsignatura; $i++) { 
             

              foreach ($columna as &$Nombrecolum) {          
            ?>
              <th><?php echo $Nombrecolum; ?></th>

            <?php
              }  
              }
                  
            ?>


                
            </tr>
        </thead>


        <tbody>

          <?php
               
                $c2onsulta = "SELECT `datosalumnos`.`idAlumnos`,`datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos`, `curso_$cicloLectivo`.`nombre`, `inscrip_curso_alumno_$cicloLectivo`.`idIns`  FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos` = `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `inscrip_curso_alumno_$cicloLectivo`.`idCurso` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idCurso`='$cursoSe'";
                $r2esultado = $conexion->prepare($c2onsulta);
                $r2esultado->execute();
                $d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

                foreach($d2ata as $d2at) {
                    $idAlumnos=$d2at['idAlumnos'];
                    $nombreAlumnos=$d2at['nombreAlumnos'];
                    $dniAlumnos=$d2at['dniAlumnos'];
                    $nombreCurso=$d2at['nombre'];
                

                    $idIns=$d2at['idIns'];
                

                  
            ?>


            <tr style='text-align: center;'>
                
                <td><b><FONT COLOR="black"><?php  echo $nombreAlumnos;?></FONT></b></td>
                <td><b><FONT COLOR="black"><?php  echo $dniAlumnos;?></FONT></b></td>
                 <?php
              
      
                $consulta = "SELECT `libreta_digital_$cicloLectivo`.`id_libreta`, `plan_datos_asignaturas`.`nombre` FROM `libreta_digital_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `libreta_digital_$cicloLectivo`.`idAsig` WHERE `libreta_digital_$cicloLectivo`.`idIns`='$idIns'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

                foreach($data as $dat) {
                  $id_libretaF=$dat['id_libreta'];
                  
                  foreach ($columna as &$Nombrecolum) {
                          $consulta = "SELECT `id_libreta`, `$Nombrecolum` FROM `libreta_digital_$cicloLectivo` WHERE `id_libreta`= '$id_libretaF'";
                          $resultado = $conexion->prepare($consulta);
                          $resultado->execute();
                          $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                          foreach($data as $dat) {


            ?>

                            <td><b><?php  




                            $nota= $dat[''.$Nombrecolum.''];



                            if ($nota<6) {
                             echo '<FONT COLOR="red">'.$nota.'</FONT>';
                            }else{
                              echo '<FONT COLOR="black">'.$nota.'</FONT>';
                            }





                            ?></b></td>


                       <?php
           

                          }

                    }






          }
                  
            ?>  

            </tr>

             <?php
              }  
              
                  
            ?>
        </tbody>
      
    </table>

 <script type="text/javascript">
$(document).ready(function(){

     $('#IMAGENCARGANDO').hide();

    var tablaCentralizadora = $('#tablaCentralizadora').DataTable({ 

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





$(document).on("click", ".modalCRUD_Centralizadora2", function(e){

e.preventDefault(); 
 
   window.open('centralizadora/tablaImprimir.php', '_blank'); 

    

});



});



</script>






