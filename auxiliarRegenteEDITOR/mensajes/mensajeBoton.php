<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

 $final='';
$consulta = "SELECT `id_mensaje`, `id_usuario`, `fecha`, `mensaje`, `datos` FROM `mensajes`";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

 $conta=0;                          
foreach($data as $dat) {
$conta=$conta+1;


}

if ($conta!=0) {
  
?>

<button class='btn btn-info' id="mensajesAdministrador">Mensajes de Alumnos</button>

<script type="text/javascript">
	$(document).ready(function(){


     $("#mensajesAdministrador").click(function(){ 

     
            $('#buscarTablaInstitucional').html(''); 
            $('#tablaInstitucional').load('mensajes/mensajeAlumnos.php');
            $('#contenidoAyuda').html(''); 
            $('#buscarTablaInstitucional').show();
      });


});


</script>



<?php            
}
?>   




