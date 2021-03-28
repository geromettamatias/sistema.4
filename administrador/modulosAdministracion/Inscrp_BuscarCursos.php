<h3>Matriculación</h3>
<?php
                  
                  include_once '../bd/conexion.php';
                  $objeto = new Conexion();
                  $conexion = $objeto->Conectar();

                  $cat="";


                  $consulta = "SELECT `idCiclo`, `ciclo` FROM `cliclo`ORDER BY `ciclo`";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a as $da1t) { 
                    $ciclo=$da1t['ciclo'];

                     $cat.="<option>".$ciclo."</option>";


                  }

?>


         <label for="cursoSe" class="col-form-label">AÑO LECTIVO:</label> 
         <div class="col-lg-12 p-2">
             <select class="form-control" id="cicloLectivoFina">
              <option>Seleccione un año lectivo</option>
              <?php echo $cat;  ?>
            </select>



       
        <div id="contenidoCursos"></div>

<script type="text/javascript">

   $('#imagenProceso').hide();
  $("#cicloLectivoFina").change(function(){
    cicloLectivoFina= $('#cicloLectivoFina').val();
    $('#tablaInstitucional').html('');


    if (cicloLectivoFina!='Seleccione un año lectivo') {

     $.ajax({
          type:"post",
          data:'cicloLectivo=' + cicloLectivoFina,
          url:'modulosAdministracion/elementos/seccionCursos.php',
          success:function(r){
            $('#contenidoCursos').load('modulosAdministracion/Inscrp_BuscarCursosPrinci.php');
          }
        });

     }else{

        $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');



     }

   });



</script>
