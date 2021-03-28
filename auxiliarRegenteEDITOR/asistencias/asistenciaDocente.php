<div class="container">
    <div class="row">
    
        <div class="col-lg-12 p-2">
            <h2>ASISTENCIA DE LOS DOCENTES</h2>
        </div>
    </div>
</div>



                    <div class="table-responsive">        
                        <table id="asistenciaDocenteFinal" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                
                                <th>ID</th>
                                <th>DNI</th>
                                <th>APELLIDO Y NOMBRE</th> 
                                <th>BOTON</th> 
                                                    
                              
                            </tr>
                        </thead>
                        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
      

 <script type="text/javascript">
$(document).ready(function(){
$('#imagenProceso').hide();




 asistenciaDocente();


  var fila; //capturar la fila para editar o borrar el registro
    
//botón AISTENCIA    
$(document).on("click", ".btnEditar_ASISTENCIA_Docente", function(){
    fila = $(this).closest("tr");

 
    id = parseInt(fila.find('td:eq(0)').text());

   $.ajax({
          url: "asistencias/secion/seccionCicloInasistenciaDocente.php",
          type: "POST",
          data: {id:id},
          success: function(r){  

                
       


    ret=`<select class="form-control" id="cicloLectivoFina">
               
                `+r+`
                </select></div>`;
     

      Swal.fire({
              title: 'AÑO LECTIVO',
              html:ret, 
              focusConfirm: false,
              showCancelButton: true,                         
              }).then((result) => {
                if (result.value) {                                             
                  cicloLectivoFina = document.getElementById('cicloLectivoFina').value;
              
       

                  inasistenciaDocenteFinal(cicloLectivoFina,id);
                                  
                }
        });




   }        
      });
    
});





}); 




function asistenciaDocente() {

        asistenciaDocenteFinal=$('#asistenciaDocenteFinal').DataTable({ 


    "destroy":true,


    "ajax":{
         "url": "bd/datos_asistenciaDocente.php",
         "type": "POST",
    },

    "columns":[
    {"data":"idDocente"},
    {"data":"nombre"},
    {"data":"dni"},
    {"targets": -1,
        "data":null,
        "defaultContent": "<button class='btn btn-primary btnEditar_ASISTENCIA_Docente ms-2'>ASISTENCIA</button>"},
  
    ],
  

 
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        },
      
    });

}


function inasistenciaDocenteFinal(cicloLectivoFina,id){

       $.ajax({
        url: "asistencias/secion/docente.php",
        type: "POST",
        dataType: "json",
        data: {id:id, cicloLectivoFina:cicloLectivoFina},
        success: function(data){  
            
            $('#contenidoAyuda').html(''); 
            $('#buscarTablaInstitucional').html('');
            $('#tablaInstitucional').load('asistencias/asistenciaDocente_Tabla.php');
            $('#buscarTablaInstitucional').show();
              
        }        
    });
}


</script>
