<div class="container">
        <div class="row">
                <div class="col-lg-12">

                     <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <h2>ASISTENCIA DE LOS ALUMNOS</h2><br>
                   
                    
                </div>
      
        </div>
</div>



                    <div class="table-responsive">        
                        <table id="asistenciaAlumnoFinal" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                
                                <th>ID</th>
                                <th>DNI</th>
                                <th>APELLIDO Y NOMBRE</th> 
                                <th>CURSO INSCRIP.</th>
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



     asistenciaAlumno();



 var fila; //capturar la fila para editar o borrar el registro
    
//botón AISTENCIA    
$(document).on("click", ".btnEditar_ASISTENCIA_alumno", function(){
    fila = $(this).closest("tr");

 
    id = parseInt(fila.find('td:eq(0)').text());



   $.ajax({
          url: "asistencias/secion/seccionCicloInasistenciaAlumno.php",
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
              
       

                  inasistenciaDocenteFinalAlu(cicloLectivoFina,id);
                                  
                }
        });




   }        
      });






    
});
  




}); 





function asistenciaAlumno() {
      asistenciaAlumnoFinal=$('#asistenciaAlumnoFinal').DataTable({ 


     "destroy":true,
  
        
     

    "ajax":{
         "url": "bd/datos_asistenciaAlumno.php",
         "type": "POST",
    },

    "columns":[
    {"data":"idAlumnos"},
    {"data":"nombreAlumnos"},
    {"data":"dniAlumnos"},
    {"data":"dniAlumnos"},
    {"targets": -1,
        "data":null,
        "defaultContent": "<button class='btn btn-primary btnEditar_ASISTENCIA_alumno ms-2'>ASISTENCIA </button>"},
  
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





function inasistenciaDocenteFinalAlu(cicloLectivoFina,id){

        

     $.ajax({
        url: "asistencias/secion/alumno.php",
        type: "POST",
        dataType: "json",
        data: {id:id, cicloLectivoFina:cicloLectivoFina},
        success: function(data){  
            
            $('#contenidoAyuda').html(''); 
            $('#buscarTablaInstitucional').html('');
            $('#tablaInstitucional').load('asistencias/asistenciaAlumno_Tabla.php');
            $('#buscarTablaInstitucional').show();
              
        }        
    });
}



</script>
