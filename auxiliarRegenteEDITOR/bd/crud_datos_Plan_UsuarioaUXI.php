<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$operacion = (isset($_POST['operacion'])) ? $_POST['operacion'] : '';
$cargo = (isset($_POST['cargo'])) ? $_POST['cargo'] : '';
$nivelCurso = (isset($_POST['nivelCurso'])) ? $_POST['nivelCurso'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';


$password = (isset($_POST['pass'])) ? $_POST['pass'] : '';

$pass= base64_encode($password);


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$idUsu = (isset($_POST['idUsu'])) ? $_POST['idUsu'] : '';





switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `usuarios_auxilar_regente`(`idUsu`, `nombre`, `dni`, `usuario`, `pass`, `cargo`, `nivelCurso`, `operacion`) VALUES (null,'$nombre','$dni','$usuario','$pass','$cargo','$nivelCurso','$operacion')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT `idUsu`, `nombre`, `dni`, `usuario`, `pass`, `cargo`, `nivelCurso`, `operacion` FROM `usuarios_auxilar_regente` ORDER BY `idUsu` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE `usuarios_auxilar_regente` SET `nombre`='$nombre',`dni`='$dni',`usuario`='$usuario',`pass`='$pass',`cargo`='$cargo',`nivelCurso`='$nivelCurso',`operacion`='$operacion' WHERE `idUsu`='$idUsu'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT `idUsu`, `nombre`, `dni`, `usuario`, `pass`, `cargo`, `nivelCurso`, `operacion` FROM `usuarios_auxilar_regente`  WHERE `idUsu`='$idUsu'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM `usuarios_auxilar_regente` WHERE `idUsu`='$idUsu'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
                                
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;