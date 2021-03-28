<div class="container">
    <div class="row">
        <div class="col-lg-12 p-2">
            <button id="btn_asignatura_basico" type="button" class="btn btn-outline-success btn-block" data-toggle="modal">ASIGNATURA DEL BÁSICO</button>
            <p><b>Aclaración:</b> Podras crear,editar y eliminar asignatura  correspondiente a todos los planes de estudios...</p>
            
        </div>
        <div class="col-lg-12 p-2">
            <button id="btn_asignatura_superior" type="button" class="btn btn-outline-info btn-block" data-toggle="modal">ASIGNATURA DEL SUPERIOR</button>
            <p><b>Aclaración:</b> Podras crear,editar y eliminar asignatura  correspondiente a un plan particular...</p>
        </div>
    </div>
</div>

    <script type="text/javascript">
        $('#imagenProceso').hide();
    	$(document).ready(function(){
            
		    $("#btn_asignatura_basico").click(function(){
		        $('#imagenProceso').show();
            $('#buscarTablaInstitucional').html('');
            $('#contenidoAyuda').html(''); 
            $('#tablaInstitucional').load('modulosCarga/asignaturas/asignaturasBasico.php');
            $('#imagenProceso').hide(); 
		      });

		     $("#btn_asignatura_superior").click(function(){
		         $('#imagenProceso').show();
            $('#tablaInstitucional').html('');
            $('#contenidoAyuda').html(''); 
            $('#buscarTablaInstitucional').load('modulosCarga/asignaturas/buscarAsignaturasPlan.php');
            $('#imagenProceso').hide();
		      });
	      });

     
       
  </script>
