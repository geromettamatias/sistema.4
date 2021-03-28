
 <?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();


 
$consulta = "SELECT `id_circular`, `numero`, `url`, `type` FROM `circular`";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


?>

    <h2><p style="color:#F4F6F6;"><mark>CIRCULARES</mark></p></h2> 



 <input type="text" id="servidor" value="<?php echo $_SERVER['HTTP_HOST']; ?>"  hidden="">



<div class="table-responsive">        
  <table id="circularTabla" class="table table-striped table-bordered" cellspacing="0" width="100%">

                        <thead>
                            <tr> 
                                                  
                                <th scope="col">N°</th>
                                <th scope="col">N° Disposición</th>
                                <th scope="col">BOTONES</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                           <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            
                                <tr>
                                    <td><?php echo $dat['id_circular'] ?></td>
                                    <td><?php echo $dat['numero'] ?></td>
                             
                                    <td></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
  </div>
 


 






      <div class="modal fade" id="modalPdf" aria-labelledby="modalPdf" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-titleVisor" id="exampleModalLabel">Ver archivo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <iframe id="iframePDF" frameborder="0" scrolling="no" width="100%" height="500px"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                    </div>
                </div>
            </div>
        </div>



  <script type="text/javascript">
   $(document).ready(function() {  

 $('#imagenProceso').hide();
    $("#cara2").hide();
             
    var circularTabla = $('#circularTabla').DataTable({ 

          
      
    "columnDefs":[{
       
        "targets": -1,
        "data":null,
        "defaultContent": " <button class='btn btn-info btnVisor_pdf'>Visor-PDF</button> <button class='btn btn-info btnReVisor_pdf'>Re-Visor-PDF</button>",


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


var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnVisor_pdf", function(){
    fila = $(this).closest("tr");

 
    id_circular = parseInt(fila.find('td:eq(0)').text());

          $.ajax({
                        url: "bd/circularesLeerVisor.php",
                        type: "POST",
                        dataType: "json",
                        data: {id_circular:id_circular},
                        success: function(data){  
                      
                            url = data[0].url;
                         

                                  servidor=$("#servidor").val();

                                  vari= 'http://'+servidor+'/sistema/administrador/anuncios/pdfCirculares/'+url;

                               

 
                    $(".modal-header").css("background-color", "#4e73df");
                    $(".modal-header").css("color", "white");  
                    $("#modalPdf").modal("show");
                    $('#iframePDF').attr('src',vari);

                            


                            
                        }        
                    });




 
    
});



$(document).on("click", ".btnReVisor_pdf", function(){
    fila = $(this).closest("tr");
    id_circular = parseInt(fila.find('td:eq(0)').text());

          $.ajax({
                        url: "bd/circularesLeerVisor.php",
                        type: "POST",
                        dataType: "json",
                        data: {id_circular:id_circular},
                        success: function(data){  
                      
                                  url = data[0].url;
                         

                                  servidor=$("#servidor").val();

                                  vari= 'http://'+servidor+'/sistema/administrador/anuncios/pdfCirculares/'+url;

                                  window.open(vari, '_blank');
                            


                            
                        }        
                    });




 
    
});








// fin del visor


// eliminar



});    


function openModelPDF(url) {

                                
  $('#iframePDF').attr('src',url);
 }



 </script>




