<?php

$boton=$_POST['boton'];

if ($boton==="cerrar") {
session_start();
session_destroy();
}

	
				


?>