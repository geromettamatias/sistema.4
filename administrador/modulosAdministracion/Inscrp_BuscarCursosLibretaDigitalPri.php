<h3>Gestión-Ficha y Libreta</h3>
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

  
<script type="text/javascript">

 
$('#imagenProceso').hide();
  $("#cicloLectivoFina").change(function(){
    cicloLectivoFina= $('#cicloLectivoFina').val();
  
    
    if (cicloLectivoFina!='Seleccione un año lectivo') {
$('#imagenProceso').show();
        
     
     $.ajax({
          type:"post",
          data:'cicloLectivo=' + cicloLectivoFina,
          url:'modulosAdministracion/elementos/seccionCursosPPP.php',
          success:function(r){

               $('#tablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide(); 
            $('#tablaInstitucional').load('modulosAdministracion/Inscrp_BuscarCursosLibretaDigital.php');

             
    


          }
        });

     }else{

   
        $('#tablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide();  


     }

   });



</script>