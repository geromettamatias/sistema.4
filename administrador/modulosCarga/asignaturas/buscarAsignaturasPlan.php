<div class="container">
    <div class="row">
        <div class="col-lg-12 p-2">
            <button id="btn_regresar_asignatura" type="button" class="btn btn-success" data-toggle="modal">Regresar</button>

        </div>
        <div class="col-lg-12 p-2">
              <label for="planSele" class="col-form-label">Plan:</label>
              <select class="form-control" id="planSele">
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
                <?php } ?> 
              </select>
        </div> 
    </div> 
</div> 


<script type="text/javascript">
  $(document).ready(function(){
    $("#planSele").change(function(){
      planSele= $('#planSele').val();
      $.ajax({
          type:"post",
          data:'planSele=' + planSele,
          url:'modulosCarga/elementos/seccionBuscarPlan.php',
          beforeSend: function() {
            $('#imagenProceso').show();
                              },
          success:function(r){    	
           $('#tablaInstitucional').load('modulosCarga/asignaturas/asignaturasPlan.php');
           $('#imagenProceso').hide();
          }
        });
    });


    $("#btn_regresar_asignatura").click(function(){
        $('#imagenProceso').show();
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').load('modulosCarga/asignaturas/asignaturas_Selec.php');
        $('#imagenProceso').hide(); 
      });

  });
</script>

