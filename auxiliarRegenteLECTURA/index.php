<?php require_once "vistas/parte_superior.php"?>

<div class="p-2">
<!--INICIO del cont principal-->
<div id="buscarTablaInstitucional" >
   
</div>

<div id="tablaInstitucional">
	
	<div class="container p-4">

        <div class="row" >
                <div class="col align-self-center"><h4>



    			<?php  echo '<b>APELLIDO Y NOMBRE: </b>'.$_SESSION["nombre"].'<br><b>CARGO: </b>'.$_SESSION["cargo"]. '<br><b>NIVEL DE OPERACIÓN: </b>'.$_SESSION["operacion"].'<br><b>CURSOS ASIGNADOS: </b>'.$_SESSION['nivelCurso'];?>
    			</h4></div>

    	</div>
    </div>

</div>

<div id="contenidoAyuda"></div>
<!--FIN del cont principal-->

</div>
<?php require_once "vistas/parte_inferior.php"?>




