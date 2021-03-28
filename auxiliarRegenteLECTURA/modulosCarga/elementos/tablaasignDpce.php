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



         <div class="form-group">
            <label for="curso" class="col-form-label">CICLO:</label>
             <select class="form-control" id="cicloLectivo">
              <option>Seleccione un año lectivo</option>
               <?php echo $cat;  ?>
            </select>



        </div>

     




 <div id="fim"></div>






 <script type="text/javascript">
$(document).ready(function(){



$("#cicloLectivo").change(function(){

      cicloLectivo= $('#cicloLectivo').val();

      
      if (cicloLectivo=='Seleccione un año lectivo') {

  
        $('#fim').html('');

      }else{
      
       $.ajax({
          type:"post",
          data:'cicloLectivoFINAL=' + cicloLectivo,
          url:'modulosCarga/elementos/sessi.php',
          beforeSend: function() {
            $('#imagenProceso').show();
                              },
          success:function(r){


   
           $('#fim').load('modulosCarga/elementos/taAsig.php');
           $('#imagenProceso').hide();
          }
        });

      }

      });

    


    
});


</script>