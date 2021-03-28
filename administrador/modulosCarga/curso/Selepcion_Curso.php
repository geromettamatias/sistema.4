<div class="container">
    <div class="row">
        <div class="col-lg-12 p-2">
            <button id="btn_cursos_basico" type="button" class="btn btn-outline-success btn-block" data-toggle="modal">CURSOS DEL BÁSICO</button>
            <p><b>Aclaración:</b> Podras crear,editar y eliminar cursos con las asignaturas correspondiente a todos los planes de estudios...</p>
            
        </div>
        <div class="col-lg-12 p-2">
            <button id="btn_cursos_superior" type="button" class="btn btn-outline-info btn-block" data-toggle="modal">CURSOS DEL SUPERIOR</button>
            <p><b>Aclaración:</b> Podras crear,editar y eliminar cursos con las asignaturas correspondiente a un plan particular...</p>
        </div>
    </div>
</div>

    <script type="text/javascript">
      $('#imagenProceso').hide();
    	$(document).ready(function(){

		    $("#btn_cursos_basico").click(function(){
		        $('#imagenProceso').show();
		        $('#contenidoAyuda').html(''); 
		        $('#buscarTablaInstitucional').load('modulosCarga/curso/curso_Basico_Buscar.php');
             $('#tablaInstitucional').html('');

             $('#imagenProceso').hide(); 
		      });

		     $("#btn_cursos_superior").click(function(){
                $('#imagenProceso').show();
		            $('#contenidoAyuda').html(''); 
		            $('#buscarTablaInstitucional').load('modulosCarga/curso/curso_Superior_Buscar.php');

                 $('#tablaInstitucional').html(''); 
	               $('#imagenProceso').hide(); 
		      });
	      });


  
  </script>

