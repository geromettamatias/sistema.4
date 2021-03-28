<?php
                  
     include_once '../bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    session_start();
     $cursoSe=$_SESSION['cursoSe'];
        $cicloLectivo=$_SESSION['cicloLectivo'];
                  $cat="";
              
              
                  $consulta = "SELECT `idCabezera`, `nombre`, `descri`, `editarDocente`, `corresponde` FROM `cabezera_libreta_digital_$cicloLectivo` WHERE `corresponde`='FICHA/LIBRETA'";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a as $da1t) { 
                    $nombre=$da1t['nombre'];

                     $cat.="<option>".$nombre."</option>";

                    

                  }

?>


<br>
          <input hidden="" id="cantidFFF" value="<?php echo $cantidFFF;  ?>">
          <label for="nombreColumna" class="col-form-label">NOTA-VISUALIZACIÓN:</label> 
             <select class="form-control" id="nombreColumna">
              <option>Seleccione una o todas las columnas</option>
              <option>Todas</option>
              <?php echo $cat;  ?>
            
            </select>
<br>
<hr>

<div id="IMAGENCARGANDO">
<img src="../1.gif"  style="width: 70px;"> CARGANDO <i class="fas fa-cog fa-spin mr-2 text-gray-800"></i>
</div>

<div id="tablaFi"></div>
<script type="text/javascript">

 $('#IMAGENCARGANDO').hide();

  $("#nombreColumna").change(function(){
    columnaSEle= $('#nombreColumna').val();

    $('#imagenProceso').show();
    $('#IMAGENCARGANDO').show();
    if (columnaSEle!='Seleccione una o todas las columnas') {
     
     $.ajax({
          type:"post",
          data:'columnaSEle=' + columnaSEle,
          url:'centralizadora/elementos/seccionCursosColum.php',
          beforeSend: function() {
              $('#imagenProceso').show();
                           
                              },
          success:function(r){

              if (columnaSEle=='Todas') {
                   $('#tablaFi').load('centralizadora/tabla.php');

                }else{
                    $('#tablaFi').load('centralizadora/tablaColu.php');
                }
             
              $('#imagenProceso').hide();


          }
        });

      }else{

        $('#tablaFi').html('');
        $('#imagenProceso').hide();
      }

   });



</script>