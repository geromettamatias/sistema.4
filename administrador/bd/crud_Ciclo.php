<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   



$idCiclo = (isset($_POST['idCiclo'])) ? $_POST['idCiclo'] : '';
$ciclo = (isset($_POST['ciclo'])) ? $_POST['ciclo'] : '';



$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$pass = (isset($_POST['pass'])) ? $_POST['pass'] : '';




$pregunta=0;

if ($opcion!=3) {

$c1onsulta = "SELECT `idCiclo`, `ciclo` FROM `cliclo` WHERE `ciclo`='$ciclo'";
$r1esultado = $conexion->prepare($c1onsulta);
$r1esultado->execute();
$d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);
foreach($d1ata as $d1at) {

    $pregunta =1;

}

}

if ($pregunta==0) {
  



switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `cliclo`(`idCiclo`, `ciclo`) VALUES (null,'$ciclo')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();






if ($ciclo!=2019) {

    $inscrip_curso_alumnoAnterior=$ciclo-1;
    
     $consulta = "CREATE TABLE `instituto`.`inscrip_curso_alumno_$ciclo` SELECT * FROM `inscrip_curso_alumno_$inscrip_curso_alumnoAnterior`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

    $consulta = "ALTER TABLE `inscrip_curso_alumno_$ciclo` CHANGE `idIns` `idIns` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`idIns`)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


}else{


   $consulta = "CREATE TABLE `instituto`.`inscrip_curso_alumno_$ciclo` ( `idIns` INT NULL AUTO_INCREMENT , `idCurso` TEXT NOT NULL , `idAlumno` TEXT NOT NULL , PRIMARY KEY (`idIns`))";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


}  


    



if ($ciclo!=2019) {

    $libretaAnterior=$ciclo-1;
    
     $consulta = "CREATE TABLE `instituto`.`libreta_digital_$ciclo` SELECT * FROM `libreta_digital_$libretaAnterior`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

    $consulta = "ALTER TABLE `libreta_digital_$ciclo` CHANGE `id_libreta` `id_libreta` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id_libreta`)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


}else{


   $consulta = "CREATE TABLE `instituto`.`libreta_digital_$ciclo` ( `id_libreta` INT NULL AUTO_INCREMENT , `idIns` TEXT NOT NULL , `idAsig` TEXT NOT NULL , PRIMARY KEY (`id_libreta`))";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


}  





   




if ($ciclo!=2019) {

    $cicloAnterior=$ciclo-1;
    
     $consulta = "CREATE TABLE `instituto`.`curso_$ciclo` SELECT * FROM `curso_$cicloAnterior`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

    $consulta = "ALTER TABLE `curso_$ciclo` CHANGE `idCurso` `idCurso` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`idCurso`)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


}else{


    $consulta = "CREATE TABLE `instituto`.`curso_$ciclo` ( `idCurso` INT NULL AUTO_INCREMENT , `idPlan` TEXT NOT NULL , `ciclo` TEXT NOT NULL , `nombre` TEXT NOT NULL , PRIMARY KEY (`idCurso`))";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


}        

       




if ($ciclo!=2019) {

    $cicloAnterior2=$ciclo-1;
    
     $consulta = "CREATE TABLE `instituto`.`cabezera_libreta_digital_$ciclo` SELECT * FROM `cabezera_libreta_digital_$cicloAnterior2`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

    $consulta = "ALTER TABLE `cabezera_libreta_digital_$ciclo` CHANGE `idCabezera` `idCabezera` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`idCabezera`)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


}else{


    $consulta = "CREATE TABLE `instituto`.`cabezera_libreta_digital_$ciclo` ( `idCabezera` INT NULL AUTO_INCREMENT , `nombre` TEXT NOT NULL , `descri` TEXT NOT NULL , `editarDocente` TEXT NOT NULL , `corresponde` TEXT NOT NULL , PRIMARY KEY (`idCabezera`))";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


}        



if ($ciclo!=2019) {

    $cicloAnterior3=$ciclo-1;
    
     $consulta = "CREATE TABLE `instituto`.`asignacion_asignatura_docente_$ciclo` SELECT * FROM `asignacion_asignatura_docente_$cicloAnterior3`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

    $consulta = "ALTER TABLE `asignacion_asignatura_docente_$ciclo` CHANGE `idAsig` `idAsig` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`idAsig`)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


}else{


    $consulta = "CREATE TABLE `instituto`.`asignacion_asignatura_docente_$ciclo` ( `idAsig` INT NULL AUTO_INCREMENT , `idDocente` TEXT NOT NULL , `idCurso` TEXT NOT NULL , `idAsignatura` TEXT NOT NULL , PRIMARY KEY (`idAsig`))";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


} 




        
if ($ciclo!=2019) {

    $cicloAnterior4=$ciclo-1;
    
     $consulta = "CREATE TABLE `instituto`.`datosficha_$ciclo` SELECT * FROM `datosficha_$cicloAnterior4`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

    $consulta = "ALTER TABLE `datosficha_$ciclo` CHANGE `idDatoExtraFicha` `idDatoExtraFicha` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`idDatoExtraFicha`)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


}else{


    $consulta = "CREATE TABLE `instituto`.`datosficha_$ciclo` ( `idDatoExtraFicha` INT NULL AUTO_INCREMENT , `idAlumno` TEXT NOT NULL , `Libro` TEXT NOT NULL , `Folio` TEXT NOT NULL , `nLegajo` TEXT NOT NULL , `nacionalidadAlumno` TEXT NOT NULL , `procedenciaAlumno` TEXT NOT NULL , `nacionalidadTutor` TEXT NOT NULL , `auxiliar` TEXT NOT NULL , `piePagina` TEXT NOT NULL , PRIMARY KEY (`idDatoExtraFicha`))";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


} 



     




        
if ($ciclo!=2019) {

    $cicloAnterior5=$ciclo-1;
    
     $consulta = "CREATE TABLE `instituto`.`asignaturas_pendientes_$ciclo` SELECT * FROM `asignaturas_pendientes_$cicloAnterior5`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

    $consulta = "ALTER TABLE `asignaturas_pendientes_$ciclo` CHANGE `idAsigPendiente` `idAsigPendiente` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`idAsigPendiente`)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


}else{


     $consulta = "CREATE TABLE `instituto`.`asignaturas_pendientes_$ciclo` ( `idAsigPendiente` INT NULL AUTO_INCREMENT , `idAlumno` TEXT NOT NULL , `asignaturas` TEXT NOT NULL , `calFinal_1` TEXT NOT NULL , `fecha_1` TEXT NOT NULL , `libro_1` TEXT NOT NULL , `folio_1` TEXT NOT NULL, `calFinal_2` TEXT NOT NULL , `fecha_2` TEXT NOT NULL , `libro_2` TEXT NOT NULL , `folio_2` TEXT NOT NULL, `calFinal_3` TEXT NOT NULL , `fecha_3` TEXT NOT NULL , `libro_3` TEXT NOT NULL , `folio_3` TEXT NOT NULL, `calFinal_4` TEXT NOT NULL , `fecha_4` TEXT NOT NULL , `libro_4` TEXT NOT NULL , `folio_4` TEXT NOT NULL, `calFinal_5` TEXT NOT NULL , `fecha_5` TEXT NOT NULL , `libro_5` TEXT NOT NULL , `folio_5` TEXT NOT NULL, `situacion` TEXT NOT NULL, `bloque1` TEXT NOT NULL, `bloque2` TEXT NOT NULL, `bloque3` TEXT NOT NULL, `bloque4` TEXT NOT NULL, `bloque5` TEXT NOT NULL , PRIMARY KEY (`idAsigPendiente`))";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


}         



$consulta = "CREATE TABLE `instituto`.`asistenciadocente_$ciclo` ( `id_Asistencia` INT NULL AUTO_INCREMENT , `idDocente` TEXT NOT NULL , `idCurso` TEXT NOT NULL , `idAsignatura` TEXT NOT NULL , `fecha` TEXT NOT NULL , `cantidad` TEXT NOT NULL , `justificado` TEXT NOT NULL , PRIMARY KEY (`id_Asistencia`))";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
       
      
$consulta = "CREATE TABLE `instituto`.`asistenciaalumno_$ciclo` ( `id_Asistencia` INT NULL AUTO_INCREMENT , `idAlumno` TEXT NOT NULL , `fecha` TEXT NOT NULL , `cantidad` TEXT NOT NULL , `justificado` TEXT NOT NULL , `observacion` TEXT NOT NULL , `encabezado` TEXT NOT NULL  , PRIMARY KEY (`id_Asistencia`))";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


$consulta = "CREATE TABLE `instituto`.`datoslibreta_$ciclo` ( `idDatosFicha` INT NULL AUTO_INCREMENT , `idAlumno` TEXT NOT NULL , `promovido` TEXT NOT NULL , `ob` TEXT NOT NULL , `lugarFecha` TEXT NOT NULL , PRIMARY KEY (`idDatosFicha`))";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();










        $consulta = "SELECT `idCiclo`, `ciclo` FROM `cliclo` ORDER BY `idCiclo` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

       
    case 3://baja

        if ($pass=='32729125') {



        $consulta = "DELETE FROM `cliclo` WHERE `idCiclo`='$idCiclo'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "DROP TABLE `inscrip_curso_alumno_$ciclo`, `libreta_digital_$ciclo`,`cabezera_libreta_digital_$ciclo`,`curso_$ciclo`,`asignacion_asignatura_docente_$ciclo`,`datosficha_$ciclo`,`asignaturas_pendientes_$ciclo`,`asistenciadocente_$ciclo`,`asistenciaalumno_$ciclo`";      
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $data= 1;


    }else{
        $data= 0;
    }

        break;        
}


 print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS



}else{

    echo 0;
}
$conexion = NULL;





