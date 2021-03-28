<?php 


$mesajeAd = (isset($_POST['mesajeAd'])) ? $_POST['mesajeAd'] : '';



$json_historia= json_encode($mesajeAd);

//crar Archivo json

$handler = fopen('../mensajeAdmin.json', 'w+');
fwrite($handler, $json_historia);
fclose($handler);

print json_encode($data, JSON_UNESCAPED_UNICODE);






 ?>