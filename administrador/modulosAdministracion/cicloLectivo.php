
 <?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();




 
$consulta = "SELECT `idCiclo`, `ciclo` FROM `cliclo`";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 p-2">
            <h3>CICLO LECTIVO</h3>
            
        </div>
        <div class="col-lg-12 p-2">
            <button id="btn_ciclo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">        
                <table id="tablaCiclo" class="table table-striped table-bordered table-condensed" style="width:100%">
                    <thead class="text-center">
                            <tr>
                                <th>N°</th> 
                                <th>CICLO</th>
                            
                               
                                <th>BOTONES</th>
                            </tr>
                    </thead>
                    <tbody>
                    <?php  
                        $contador=0;                          
                        foreach($data as $dat) {
                           
                        ?>
                            <tr>
                                <td><?php echo $dat['idCiclo'] ?></td>
                                <td><?php echo $dat['ciclo'] ?></td>
                               
                                <td></td>
                            </tr>
                        <?php  } ?>                                
                    </tbody>        
                </table>                    
            </div>
        </div>
    </div>  
</div>    
      

        
<!--Modal para CRUD-->
<div class="modal fade" id="modalCicloFina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="form_ciclo">
            <div class="modal-body">
                <div id="cabezeraF">
                <div class="form-group">
                <label for="ciclo" class="col-form-label">CICLO:</label>
              
                <select class="form-control" id="cicloF">
              <option>Seleccione un año lectivo</option>
              <option>2019</option>
              <option>2020</option>
              <option>2021</option>
              <option>2022</option>
              <option>2023</option>
              <option>2024</option>
              <option>2025</option>
              <option>2026</option>
              <option>2027</option>
              <option>2028</option>
              <option>2029</option>
              <option>2030</option>
            </select>
                </div>
                </div>
            
              


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
      

<script type="text/javascript">
    $(document).ready(function(){
      $('#imagenProceso').hide();

            var tablaCiclo = $('#tablaCiclo').DataTable({
                
     "scrollY":        "700px",
        "scrollCollapse": true,
        "paging":         false, 
          
                "columnDefs":[{
           
                "targets": -1,
                "data":null,
                "defaultContent": "<button class='btn btn-danger btn_ciclo_Borrar'>Borrar</button>",


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

        $("#btn_ciclo").click(function(){

    

                $("#form_ciclo").trigger("reset");
                $(".modal-header").css("background-color", "#1cc88a");
                $(".modal-header").css("color", "white");
                $(".modal-title").text("Nuevo Ciclo");
          
                $("#modalCicloFina").modal("show");    
                    
                idCiclo=null;
                opcion = 1;
              
        });


        var fila;

     
 

   

        $(document).on("click", ".btn_ciclo_Borrar", function(){    
            fila = $(this);

            filaff = $(this).closest("tr");
            ciclo = filaff.find('td:eq(1)').text();
            

         
            idCiclo = parseInt($(this).closest("tr").find('td:eq(0)').text());
         
            opcion = 3 ;
            


                Swal.fire({
              title: 'Mensaje al Administrador',
              html:'<div class="col-12"><input type="text" class="form-control" id="pass"></div><br><p>Aclaración: Eliminar TODO UN CICLO TOTAL</p></div>', 
              focusConfirm: false,
              showCancelButton: true,                         
              }).then((result) => {
                if (result.value) {                                             
                  pass = document.getElementById('pass').value,
                        
                 
                 eliminarCiclo(idCiclo,opcion,ciclo,pass);

                                  
                }
        });





        });


        function eliminarCiclo(idCiclo,opcion,ciclo,pass) {
            Swal.fire({
                  title: 'Esta seguro de eliminar este registro?',
                  text: "Los datos eliminados no se podran recuperar!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'SI, eliminar este registro!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    Swal.fire(
                      'Deleted!',
                      'Operación éxitosa',
                      'success'
                    )

                    eliminarCicloFim(idCiclo,opcion,ciclo,pass);
                  }
                })
            }


            function  eliminarCicloFim(idCiclo,opcion,ciclo,pass){

                

                    $.ajax({
                        url: "bd/crud_Ciclo.php",
                        type: "POST",
                        dataType: "json",
                        data: {opcion:opcion, idCiclo:idCiclo, ciclo:ciclo, pass:pass},
                         beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btn_ciclo").disabled = true;
                              },
                        success: function(r){
                          
                            if (r==1) {

                        tablaCiclo.row(fila.parents('tr')).remove().draw();
                            }else{

                                Swal.fire({
                                  icon: 'error',
                                  title: 'ERROR',
                                  text: 'Contraseña incorrecta',
                                  footer: '<a href>Why do I have this issue?</a>'
                                })


                            }

                            $("#imagenProceso").hide();
                                document.getElementById("btn_ciclo").disabled = false;
                           
                        }
                    });

               
          
            }


            $("#form_ciclo").submit(function(e){
                e.preventDefault();    
             

                ciclo = $.trim($("#cicloF").val());

                    console.log({ciclo:ciclo, idCiclo:idCiclo, opcion:opcion})
                    $.ajax({
                        url: "bd/crud_Ciclo.php",
                        type: "POST",
                        dataType: "json",
                        data: {ciclo:ciclo, idCiclo:idCiclo, opcion:opcion},
                         beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btn_ciclo").disabled = true;
                              },
                        success: function(data){  
                            
                        if (data!=0) {
                            idCiclo = data[0].idCiclo;            
                            ciclo = data[0].ciclo;
                            
                          tablaCiclo.row.add([idCiclo,ciclo]).draw();
                      }else{

                   
                         Swal.fire({
                                  icon: 'error',
                                  title: 'ERROR',
                                  text: 'DATOS DUPLICADOS',
                                  footer: '<a href>Why do I have this issue?</a>'
                                })

                      }


                       $("#imagenProceso").hide();
                                document.getElementById("btn_ciclo").disabled = false;



                            
                        }        
                    });
                    $("#modalCicloFina").modal("hide"); 



                    
                });    
       
        });






</script>
