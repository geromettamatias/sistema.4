
              <label for="cursoSe" class="col-form-label">Curso:</label>
              <select class="form-control" id="cursoSe">
                  <option value="0">Seleccione un Curso</option>
                   <?php
                  include_once '../bd/conexion.php';
                  $objeto = new Conexion();
                  $conexion = $objeto->Conectar();
                     session_start();

                     $cicloLectivo=$_SESSION['cicloLectivo'];

                  $consulta = "SELECT `idCurso`, `idPlan`, `ciclo`, `nombre` FROM `curso_$cicloLectivo` WHERE `idPlan`='básico'";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a as $da1t) { 
                    $idPlan=$da1t['idPlan'];
                    $idCurso=$da1t['idCurso'];
                    $nombre=$da1t['nombre'];

                    ?>
                    <option value="<?php echo $idCurso ?>"><?php echo $nombre.'--'.$idPlan  ?></option>
                    <?php } ?>

                     <?php
           
                  $consulta = "SELECT `curso_$cicloLectivo`.`idCurso`, `plan_datos`.`nombre`, `curso_$cicloLectivo`.`nombre` AS 'nombreCurso' FROM `curso_$cicloLectivo` INNER JOIN `plan_datos` ON `plan_datos`.`idPlan`= `curso_$cicloLectivo`.`idPlan`";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($data as $dat) { 
                
                    $idCurso=$dat['idCurso'];
                    $nombreCurso=$dat['nombreCurso'];
                    $nombre=$dat['nombre'];

                    ?>
                    <option value="<?php echo $idCurso ?>"><?php echo $nombreCurso.'--'.$nombre ?></option>
                    <?php } ?>
                </select>
    
<script type="text/javascript">
  $("#cursoSe").change(function(){
    cursoSe= $('#cursoSe').val();
     $.ajax({
          type:"post",
          data:'cursoSe=' + cursoSe,
          url:'modulosAdministracion/elementos/seccionCursosFINAL.php',
          success:function(r){
            $('#tablaInstitucional').load('modulosAdministracion/Inscrip_TablaInscrp.php');
          }
        });
   });



</script>