
 <?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();


if (isset($_SESSION['cicloLectivo'])){
$cicloLectivo=$_SESSION['cicloLectivo'];


 
$consulta = "SELECT `idCabezera`, `nombre`, `descri`, `editarDocente`, `corresponde` FROM `cabezera_libreta_digital_$cicloLectivo`";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 p-2">
            <h3>CABECERA DE LA LIBRETA DIGITAL</h3>
            
        </div>
        <div class="col-lg-12 p-2">
            <button id="btnNuevo_Cabezera" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">        
                <table id="tablaCabezera" class="table table-striped table-bordered table-condensed" style="width:100%">
                    <thead class="text-center">
                            <tr>
                                <th>N°</th> 
                                <th>CABECERA</th>
                                <th>DESCRIP</th>
                        
                                <th>EDITAR POR DOCENTE</th>
                                <th>LIBRETA/FICHA</th>
                                <th>BOTONES</th>
                            </tr>
                    </thead>
                    <tbody>
                    <?php  
                        $contador=0;                          
                        foreach($data as $dat) {
                           
                        ?>
                            <tr>
                                <td><?php echo $dat['idCabezera'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['descri'] ?></td>
                               
                                <td><?php echo $dat['editarDocente'] ?></td>
                                <td><?php echo $dat['corresponde'] ?></td>
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
<div class="modal fade" id="modalCRUD_CABEZERA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formCABEZERA">
            <div class="modal-body">
                <div id="cabezeraF">
                <div class="form-group">
                <label for="cabezera" class="col-form-label">NOMBRE:</label>
                <input type="text" class="form-control" id="cabezera">
                </div>
                </div>
                <div id="descripF">
                <div class="form-group">
                <label for="descrip" class="col-form-label">DESCRIP:</label>
                   <select class="form-control" id="descrip">
                      <option>NUMERICO</option>
                      <option>TEXTO</option>
                
                    </select>
                </div>
                <div class="form-group">
                <label for="corresponde" class="col-form-label">FICHA/LIBRETA:</label>
                <select id="corresponde" class="form-control form-select form-select-lg mb-3" aria-label=".form-select-lg">
                  <option value="FICHA/LIBRETA">FICHA/LIBRETA</option>
                  <option value="FICHA">FICHA</option>      
                </select>
                </div>
                </div>
                <div id="ediDocenteF">
                <div class="form-group">
                <label for="ediDocente" class="col-form-label">EL PROFESOR CARGAR LA NOTA:</label>
                <select id="ediDocente" class="form-control form-select form-select-lg mb-3" aria-label=".form-select-lg">
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>      
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

            var tablaCabezera = $('#tablaCabezera').DataTable({
                
     "scrollY":        "700px",
        "scrollCollapse": true,
        "paging":         false, 
          
                "columnDefs":[{
           
                "targets": -1,
                "data":null,
                "defaultContent": "<button class='btn btn-success btnEditar_Docente_final mr-2'>Editar Profesor</button><button class='btn btn-primary btnEditar_CABEZERA_final mr-2'>Editar</button><button class='btn btn-danger btnBorrar_CABEZERA_final'>Borrar</button>",


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

        $("#btnNuevo_Cabezera").click(function(){

    

                $("#formCABEZERA").trigger("reset");
                $(".modal-header").css("background-color", "#1cc88a");
                $(".modal-header").css("color", "white");
                $(".modal-title").text("Ingresar nueva cabezera");
                
                $("#cabezeraF").show();
                $("#descripF").show();
                $("#ediDocenteF").show();

                $("#modalCRUD_CABEZERA").modal("show");
                idCabezera=null;
                opcion = 1;
                cabezeraViejo=null;
            
        });


        var fila;

     
        $(document).on("click", ".btnEditar_Docente_final", function(){
            fila = $(this).closest("tr");
            idCabezera = parseInt(fila.find('td:eq(0)').text());
            cabezera = fila.find('td:eq(1)').text();
            descrip = fila.find('td:eq(2)').text();
            ediDocente = fila.find('td:eq(3)').text();
            corresponde = fila.find('td:eq(4)').text();

        

            $("#cabezera").val(cabezera);
            cabezeraViejo=cabezera;
            $("#descrip").val(descrip);
            $("#ediDocente").val(ediDocente);
            $("#corresponde").val(corresponde);
            $("#cabezeraF").hide();
            $("#descripF").hide();
            $("#ediDocenteF").show();


            opcion = 2;
            $(".modal-header").css("background-color", "#0BB434");
            $(".modal-header").css("color", "white");
            $(".modal-title").text("Editar el numbre de la cabezera");
            $("#modalCRUD_CABEZERA").modal("show");
        });


        $(document).on("click", ".btnEditar_CABEZERA_final", function(){
            fila = $(this).closest("tr");
            idCabezera = parseInt(fila.find('td:eq(0)').text());
            cabezera = fila.find('td:eq(1)').text();
            descrip = fila.find('td:eq(2)').text();
            ediDocente = fila.find('td:eq(3)').text();
            corresponde = fila.find('td:eq(4)').text();
            $("#cabezera").val(cabezera);
            cabezeraViejo=cabezera;
            $("#descrip").val(descrip);
            $("#ediDocente").val(ediDocente);
             $("#corresponde").val(corresponde);
            $("#cabezeraF").show();
            $("#descripF").show();
            $("#ediDocenteF").hide();


            opcion = 2;
            $(".modal-header").css("background-color", "#4e73df");
            $(".modal-header").css("color", "white");
            $(".modal-title").text("Editar el numbre de la cabezera");
            $("#modalCRUD_CABEZERA").modal("show");
        });

        $(document).on("click", ".btnBorrar_CABEZERA_final", function(){    
            fila = $(this);
            filaCabe = $(this).closest("tr");
            idCabezera = parseInt($(this).closest("tr").find('td:eq(0)').text());
            cabezeraViejo = filaCabe.find('td:eq(1)').text();
            opcion = 3 ;
            eliminarAntesCABEZERA(idCabezera,opcion,cabezeraViejo);
        });


        function eliminarAntesCABEZERA(idCabezera,opcion,cabezeraViejo) {
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

                    eliminarAntesCABEZERAFINAL(idCabezera,opcion,cabezeraViejo);
                  }
                })
            }


            function  eliminarAntesCABEZERAFINAL(idCabezera,opcion,cabezeraViejo){

                    $.ajax({
                        url: "bd/crud_CABEZERA.php",
                        type: "POST",
                        dataType: "json",
                        data: {opcion:opcion, idCabezera:idCabezera, cabezeraViejo:cabezeraViejo},
                        success: function(){
                    
                           
                        }
                    });

                tablaCabezera.row(fila.parents('tr')).remove().draw();
             
          
            }


            $("#formCABEZERA").submit(function(e){
                e.preventDefault();    
             

                cabezera = $.trim($("#cabezera").val());
                descrip = $.trim($("#descrip").val());
                ediDocente = $.trim($("#ediDocente").val());

                corresponde = $.trim($("#corresponde").val());
                    console.log({cabezera:cabezera, descrip:descrip, ediDocente:ediDocente, idCabezera:idCabezera, opcion:opcion, cabezeraViejo:cabezeraViejo, corresponde:corresponde});
                    
                    $.ajax({
                        url: "bd/crud_CABEZERA.php",
                        type: "POST",
                        dataType: "json",
                        data: {cabezera:cabezera, descrip:descrip, ediDocente:ediDocente, idCabezera:idCabezera, opcion:opcion, cabezeraViejo:cabezeraViejo, corresponde:corresponde},
                        success: function(data){  
                            

                            idCabezera = data[0].idCabezera;            
                            nombre = data[0].nombre;
                            descri = data[0].descri;
                            editarDocente = data[0].editarDocente;
                            corresponde = data[0].corresponde;
                    
                            if(opcion == 1){tablaCabezera.row.add([idCabezera,nombre,descri,editarDocente,corresponde]).draw();

                                    

                            }
                            else{tablaCabezera.row(fila).data([idCabezera,nombre,descri,editarDocente,corresponde]).draw();} 




                            
                        }        
                    });
                    $("#modalCRUD_CABEZERA").modal("hide");    
                    
                });    
       
        });






</script>

<?php  } ?> 