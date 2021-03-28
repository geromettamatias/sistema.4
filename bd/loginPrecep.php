<?php
session_start();

include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//recepción de datos enviados mediante POST desde ajax
$dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
$passwordPrecep = (isset($_POST['passwordPrecep'])) ? $_POST['passwordPrecep'] : '';

$pass = base64_encode($passwordPrecep); //encripto la clave enviada por el usuario para compararla con la clava encriptada y almacenada en la BD

$consulta = "SELECT `idUsu`, `nombre`, `dni`, `usuario`, `pass`, `cargo`, `nivelCurso`, `operacion` FROM `usuarios_auxilar_regente` WHERE dni='$dni' AND pass='$pass'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

if($resultado->rowCount() >= 1){
  
    $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
    foreach($data1 as $dat1) {  

        $_SESSION["idUsu"] = $dat1['idUsu'];
        $_SESSION["nombre"] = $dat1['nombre'];
        $_SESSION["cargo"] = $dat1['cargo'];
        $_SESSION["nivelCurso"] = $dat1['nivelCurso'];
        $_SESSION["operacion"] = $dat1['operacion'];
            
            }



}else{
    $_SESSION["idUsu"] = null;
    $_SESSION["nombre"] = null;
        $_SESSION["cargo"] = null;
        $_SESSION["nivelCurso"] = null;
        $_SESSION["operacion"] = null;
    $data1=null;
}

print json_encode($data1);
$conexion=null;





