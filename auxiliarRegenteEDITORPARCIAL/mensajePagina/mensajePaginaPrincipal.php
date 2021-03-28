

 
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="mensajePagina" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>N°</th>
                                <th>Mensaje</th> 
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaCPag">
                         
                       
                                                        
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
      




 <script type="text/javascript">
$(document).ready(function(){
$('#imagenProceso').hide();
mensajePajina_Usuarios();





function mensajePajina_Usuarios() {

   
  
        $.ajax({
        url: "bd/mesajeAdminDocenteAlumno.php",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data){  
            console.log(data);

            mesajeAd="";
            contador=1;

               for (dat in data){
                        if (data[dat]!="Administrador") {
                        
                        mesajeAd+='<tr id="'+contador+'"><td>'+contador+'</td><td>'+data[dat]+'</td><td></td></tr>';
                        contador++;
                        }
                    }
    
                    $("#tablaCPag").html(mesajeAd);


                        var mensajePagina = $('#mensajePagina').DataTable({ 

          
                                  
                                "columnDefs":[{
                                   
                                    "targets": -1,
                                    "data":null,
                                    "defaultContent": "<button class='btn btn-danger btnBorrar_mensajeUsuariosPaginas'>Borrar</button>",


                                   },

                                  

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
                                    //para usar los botones   
                                    responsive: "true",
                                    dom: 'Bfrtilp',       
                                    buttons:[ 
                                  {
                                    extend:    'excelHtml5',
                                    text:      '<i class="fas fa-file-excel"></i> ',
                                    titleAttr: 'Exportar a Excel',
                                    className: 'btn btn-success'
                                  },
                                  {
                                    extend:    'pdfHtml5',
                                    text:      '<i class="fas fa-file-pdf"></i> ',
                                    titleAttr: 'Exportar a PDF',
                                    className: 'btn btn-danger'
                                  },
                                  {
                                    extend:    'print',
                                    text:      '<i class="fa fa-print"></i> ',
                                    titleAttr: 'Imprimir',
                                    className: 'btn btn-info'
                                  },
                                ]         
                                });

         
                  
        }        
    });
}



var fila; //capturar la fila para editar o borrar el registro


$(document).on("click", ".btnBorrar_mensajeUsuariosPaginas", function(){

    fila = $(this).closest("tr");

 
    numero = fila.find('td:eq(0)').text();
    mensaje = fila.find('td:eq(1)').text();



 
                var mesajeAd = [];
                    
                       $.ajax({
                        url: "bd/mesajeAdminDocenteAlumno.php",
                        type: "POST",
                        dataType: "json",
                        data: {},
                        success: function(data){ 

                  
                    
                                    for (dat in data){
                                        if (mensaje!=data[dat]) {
                                            mesajeAd.push(data[dat]);

                                        }else{

                                             $('#'+numero).remove();
                                        }


                                        
                                    }
                    



                    
                                    console.log(mesajeAd);

                                   

                                    $.ajax({
                                            url: "bd/mesajeAdminDocenteAlumnoEditar.php",
                                            type: "POST",
                                            dataType: "json",
                                            data: {mesajeAd:mesajeAd},
                                            success: function(data){  
                                               

                                                      
                                            }        
                                        });







                                  
                        }        
                    });





    
    
});









});

</script>


