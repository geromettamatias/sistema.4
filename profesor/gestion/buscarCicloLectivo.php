<h3>Gestión- Notas de los Alumnos</h3>
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



          <label for="cursoSe" class="col-form-label">AÑO LECTIVO:</label> 
             <select class="form-control" id="cicloLectivoFina">
              <option>Seleccione un año lectivo</option>
              <?php echo $cat;  ?>
            </select>

 




    <div id="buscarAsignaturas"></div>
    <script type="text/javascript">
      $('#imagenProceso').hide();
    $("#cicloLectivoFina").change(function(){


      $('#imagenProceso').show();

      cicloLectivoFina= $('#cicloLectivoFina').val();

      if (cicloLectivoFina=='Seleccione un año lectivo') {
        $('#tablaInstitucional').html('');
         $('#contenidoAyuda').html(''); 
           
            $('#buscarAsignaturas').html('');    
                $('#buscarTablaInstitucional').show();

                $('#imagenProceso').hide();

      }else{
      
      
       $.ajax({
          type:"post",
          data:'cicloLectivoFina=' + cicloLectivoFina,
          url:'gestion/seccionCiclo.php',
          success:function(r){
          
            $('#contenidoAyuda').html(''); 
           
            $('#buscarAsignaturas').load('gestion/buscarlibrebretaDigital.php');    
                $('#tablaInstitucional').html('');
                $('#buscarTablaInstitucional').show();
          }
        });

      }

      });

 
  </script>

