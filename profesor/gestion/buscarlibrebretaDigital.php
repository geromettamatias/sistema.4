
<label for="planSeleC" class="col-form-label">Curso:</label>
<select class="form-control" id="cursoSeProfesor">
<option value="0">Seleccione Curso-Asignatura</option>
<?php
       include_once '../bd/conexion.php';
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        session_start();
        if (isset($_SESSION['s_usuarioProfesor'])){
        $s_usuarioProfesor=$_SESSION['s_usuarioProfesor'];
        $cicloLectivoFina=$_SESSION['cicloLectivoFina'];




         $c3onsulta = "SELECT `idDocente` FROM `datos_docentes` WHERE `dni`='$s_usuarioProfesor'";
          $r3esultado = $conexion->prepare($c3onsulta);
          $r3esultado->execute();
          $data=$r3esultado->fetchAll(PDO::FETCH_ASSOC);

          foreach($data as $dat) {
              $idDocente=$dat['idDocente'];
                }
           
       
          $consulta = "SELECT `curso_$cicloLectivoFina`.`nombre` AS 'nombreCurso', `plan_datos_asignaturas`.`nombre`, `asignacion_asignatura_docente_$cicloLectivoFina`.`idAsig` FROM `asignacion_asignatura_docente_$cicloLectivoFina` INNER JOIN `curso_$cicloLectivoFina` ON `curso_$cicloLectivoFina`.`idCurso` = `asignacion_asignatura_docente_$cicloLectivoFina`.`idCurso` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `asignacion_asignatura_docente_$cicloLectivoFina`.`idAsignatura` WHERE `asignacion_asignatura_docente_$cicloLectivoFina`.`idDocente` = '$idDocente'";
          $resultado = $conexion->prepare($consulta);
          $resultado->execute();
          $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
          foreach($dat1a as $da1t) { 
            $nombreCurso=$da1t['nombreCurso'];
            $nombreAsig=$da1t['nombre'];
            $idAsig=$da1t['idAsig'];

            ?>
            <option value="<?php echo $idAsig ?>"><?php echo $nombreCurso.'--'.$nombreAsig ?></option>
            <?php }} ?>

            
        </select>











    <script type="text/javascript">
      $('#imagenProceso').hide();
    $("#cursoSeProfesor").change(function(){
      $('#imagenProceso').show();

      cursoSeProfesor= $('#cursoSeProfesor').val();

      if (cursoSeProfesor=='0') {
        $('#tablaInstitucional').html('');
        $('#imagenProceso').hide();
      }else{
      
      
       $.ajax({
          type:"post",
          data:'cursoSeProfesor=' + cursoSeProfesor,
          url:'gestion/seccionAsignatura.php',
          success:function(r){
          
            $('#tablaInstitucional').load('gestion/librebretaDigital.php');
          }
        });

      }

      });

 
  </script>







