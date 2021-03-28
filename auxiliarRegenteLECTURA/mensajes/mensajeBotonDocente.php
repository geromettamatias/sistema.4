<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

 $final='';
$consulta = "SELECT `id_mensaje`, `id_usuario`, `fecha`, `mensaje`, `datos` FROM `mensajes_admin`";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

 $conta=0;                          
foreach($data as $dat) {
$conta=$conta+1;


}

if ($conta!=0) {
  
?>

<button class='btn btn-info' id="mensajesAdministradorDocente">Mensajes de Profesor</button>

<script type="text/javascript">
	$(document).ready(function(){


     $("#mensajesAdministradorDocente").click(function(){ 

     
            $('#buscarTablaInstitucional').html(''); 
            $('#tablaInstitucional').load('mensajes/mensajeProfesor.php');
            $('#contenidoAyuda').html(''); 
            $('#buscarTablaInstitucional').show();
      });


});


</script>



<?php            
}
?>   
