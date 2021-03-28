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
            <button id="btn_regresar" type="button" class="btn btn-success" data-toggle="modal">Regresar</button>
        </div>


         <div class="col-lg-12 p-2">
             <select class="form-control" id="cicloLectivo">
              <option>Seleccione un año lectivo</option>
               <?php echo $cat;  ?>
            </select>



        </div>

        <div class="col-lg-12 p-2">
                <label for="cursoSeleB" class="col-form-label">Corresponde al:</label>
                <select class="form-control" id="cursoSeleB">
                <option>Seleccione ciclo</option>
                <option>1° AÑO (1° AÑO P.C.)</option>
                <option>2° AÑO (2° AÑO P.C.)</option>
                </select>
        </div>

        
    </div>
</div>




    <script type="text/javascript">

    $("#cicloLectivo").change(function(){

      cursoSeleB= $('#cursoSeleB').val();
      cicloLectivo= $('#cicloLectivo').val();


      if (cursoSeleB!='Seleccione ciclo' && cicloLectivo!='Seleccione un año lectivo') {
     
           $.ajax({

              type:"post",
          data:'cursoSeleB=' + cursoSeleB + '&cicloLectivo=' + cicloLectivo,
          url:'modulosCarga/elementos/seccionCursosBasico.php',
          beforeSend: function() {
            $('#imagenProceso').show();
                              },
          success:function(r){
          
           $('#tablaInstitucional').load('modulosCarga/curso/curso_Basico.php');
           $('#imagenProceso').hide();
          }
        });

      }else{


        $('#tablaInstitucional').html('');
          $('#imagenProceso').hide();
      }

      });


    $("#cursoSeleB").change(function(){
      cursoSeleB= $('#cursoSeleB').val();
      cicloLectivo= $('#cicloLectivo').val();


      if (cursoSeleB!='Seleccione ciclo' && cicloLectivo!='Seleccione un año lectivo') {
     
           $.ajax({

              type:"post",
          data:'cursoSeleB=' + cursoSeleB + '&cicloLectivo=' + cicloLectivo,
          url:'modulosCarga/elementos/seccionCursosBasico.php',
          beforeSend: function() {
            $('#imagenProceso').show();
                              },
          success:function(r){
          
           $('#tablaInstitucional').load('modulosCarga/curso/curso_Basico.php');
           $('#imagenProceso').hide();
          }
        });

      }else{


        $('#tablaInstitucional').html('');
          $('#imagenProceso').hide();
      }

      });




    $("#btn_regresar").click(function(){
        $('#imagenProceso').show();
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').load('modulosCarga/curso/Selepcion_Curso.php');
        $('#imagenProceso').hide();
        
    });
  
  </script>

