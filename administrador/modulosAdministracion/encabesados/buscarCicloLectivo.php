<?php
                  
                  include_once '../../bd/conexion.php';
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
<div class="container">
    <div class="row">
        <div class="col-lg-12 p-2">
            <h3>AÑO LECTIVO</h3>
            
        </div>
        <div class="col-lg-12 p-2">
             <select class="form-control" id="cicloLectivo">
              <option>Seleccione un año lectivo</option>
              <?php echo $cat;  ?>
            </select>



        </div>
    </div>
</div>

<script type="text/javascript">


$('#imagenProceso').hide();
$("#cicloLectivo").change(function(){

    cicloLectivo= $('#cicloLectivo').val();

    if (cicloLectivo!='Seleccione un año lectivo') {

       $.ajax({
          type:"post",
          data:'cicloLectivo=' + cicloLectivo,
          url:'modulosAdministracion/elementos/seccionCicloLectivo.php',
          beforeSend: function() {
            $('#imagenProceso').show();
                              },
          success:function(r){

           
              $('#tablaInstitucional').html(''); 
               $('#tablaInstitucional').load('modulosAdministracion/encabesados/encabesados.php');
              $('#contenidoAyuda').html(''); 
            

              $('#imagenProceso').hide();
          }
        });

        }else{
          $('#tablaInstitucional').html(''); 
               
              $('#contenidoAyuda').html(''); 
            

              $('#imagenProceso').hide();

        }

      });



  </script>

