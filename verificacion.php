<?php
session_start();

if($_SESSION["idUsu"] === null){
    header("Location: index.php");


}else{


 $operacion=$_SESSION["operacion"];


if ($operacion=='CAMBIAR TOTAL') {


	header("Location:auxiliarRegenteEDITOR/index.php");

}else if ($operacion=='LEER'){

	header("Location:auxiliarRegenteLECTURA/index.php");

}else if ($operacion=='CAMBIAR'){

	header("Location:auxiliarRegenteEDITORPARCIAL/index.php");

}else if ($operacion=='AUXILIAR-TITULO'){

	header("Location:auxiliarRegenteTITULO/index.php");

}


}


?>