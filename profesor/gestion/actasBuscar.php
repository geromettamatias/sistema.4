<h3>Administración de Actas</h3>
<div class="container">
    <div class="row">
   


        <div class="col-lg-12 p-2">
                <label for="buscarTipo" class="col-form-label">Corresponde al:</label>
                <select class="form-control" id="buscarTipo">
                <option>Seleccione el ACTAS</option>
                <option>ACTAS- PARA REGULAR</option>
                <option>ACTAS- PARA LIBRE</option>
                <option>ACTAS- PARA EQUIVALENCIA</option>
                <option>ACTAS- PARA TERMINAL</option>
                
                </select>
        </div>
        
    </div>
</div>





<script type="text/javascript">

$('#imagenProceso').hide();

    $("#buscarTipo").change(function(){

      buscarTipo= $('#buscarTipo').val();
      

      if (buscarTipo!='Seleccione el ACTA DE EXAMEN') {
      
       $.ajax({
          type:"post",
          data:'buscarTipo=' + buscarTipo,
          url:'bd/seccionACTA.php',
          beforeSend: function() {
            $('#imagenProceso').show();
                              },
          success:function(r){

           
              $('#tablaInstitucional').html(''); 
               $('#tablaInstitucional').load('gestion/actaTabla.php');
              $('#contenidoAyuda').html(''); 
            

    
              $('#imagenProceso').hide();
          }
        });

      }else{


        $('#tablaInstitucional').html('');


      }

      });



  </script>

