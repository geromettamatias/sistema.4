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
                <label for="planSeleC" class="col-form-label">Plan:</label>
                <select class="form-control" id="planSeleC">
                  <option value="1">Seleccione un Plan</option>
                  <?php
                      include_once '../../bd/conexion.php';
                      $objeto = new Conexion();
                      $conexion = $objeto->Conectar();

                      $consulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos`";
                      $resultado = $conexion->prepare($consulta);
                      $resultado->execute();
                      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                      foreach($data as $dat) {                                                        
                  ?>
                  <option value="<?php echo $dat['idPlan'] ?>"><?php echo $dat['nombre'] ?></option>
                <?php  } ?>  
              </select>
        </div>

        <div class="col-lg-12 p-2">
                <label for="cursoSele" class="col-form-label">Corresponde al:</label>
                <select class="form-control" id="cursoSele">
                <option>Seleccione ciclo</option>
                <option>3° AÑO (1° AÑO S.C.)</option>
                <option>4° AÑO (2° AÑO S.C.)</option>
                <option>5° AÑO (3° AÑO S.C.)</option>
                <option>6° AÑO (4° AÑO S.C.)</option>
                <option>7° AÑO (5° AÑO S.C.)</option>
                <option>BLA I</option>
                <option>BLA II</option>
                <option>BLA III</option>
                <option>BLA II y III</option>
                </select>
        </div>
        
    </div>
</div>


<script type="text/javascript">

  $("#cursoSele").change(function(){

      cursoSele= $('#cursoSele').val();
      planSeleC= $('#planSeleC').val();
      cicloLectivo= $('#cicloLectivo').val();


      if (cursoSele!='Seleccione ciclo' && planSeleC!='1' && cicloLectivo!='Seleccione un año lectivo') {
      
       $.ajax({
          type:"post",
          data:'cursoSele=' + cursoSele+'&planSeleC=' + planSeleC+'&cicloLectivo=' + cicloLectivo,
          url:'modulosCarga/elementos/seccionCursos.php',
          beforeSend: function() {
            $('#imagenProceso').show();
                              },
          success:function(r){
          
           $('#tablaInstitucional').load('modulosCarga/curso/curso_Superior.php');
           $('#imagenProceso').hide();
          }
        });

        }else{

          $('#tablaInstitucional').html('');
           $('#imagenProceso').hide();

        }

      });

    $("#planSeleC").change(function(){

      cursoSele= $('#cursoSele').val();
      planSeleC= $('#planSeleC').val();
      cicloLectivo= $('#cicloLectivo').val();


    if (cursoSele!='Seleccione ciclo' && planSeleC!='1' && cicloLectivo!='Seleccione un año lectivo') {
      
       $.ajax({
          type:"post",
          data:'cursoSele=' + cursoSele+'&planSeleC=' + planSeleC+'&cicloLectivo=' + cicloLectivo,
          url:'modulosCarga/elementos/seccionCursos.php',
          beforeSend: function() {
            $('#imagenProceso').show();
                              },
          success:function(r){
          
           $('#tablaInstitucional').load('modulosCarga/curso/curso_Superior.php');
           $('#imagenProceso').hide();
          }
        });

        }else{

          $('#tablaInstitucional').html('');
           $('#imagenProceso').hide();

        }

      });



      $("#cicloLectivo").change(function(){

      cursoSele= $('#cursoSele').val();
      planSeleC= $('#planSeleC').val();
      cicloLectivo= $('#cicloLectivo').val();


      if (cursoSele!='Seleccione ciclo' && planSeleC!='1' && cicloLectivo!='Seleccione un año lectivo') {
      
       $.ajax({
          type:"post",
          data:'cursoSele=' + cursoSele+'&planSeleC=' + planSeleC+'&cicloLectivo=' + cicloLectivo,
          url:'modulosCarga/elementos/seccionCursos.php',
          beforeSend: function() {
            $('#imagenProceso').show();
                              },
          success:function(r){
          
           $('#tablaInstitucional').load('modulosCarga/curso/curso_Superior.php');
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

