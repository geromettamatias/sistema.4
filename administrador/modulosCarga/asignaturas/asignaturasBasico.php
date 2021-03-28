
 <?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();



 
$consulta = "SELECT `idAsig`, `idPlan`, `nombre`, `ciclo` FROM `plan_datos_asignaturas` WHERE `idPlan`='básico'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="container">
        <div class="row">
                <div class="col-lg-12 p-2">
                    <button id="btn_regresar_asignatura" type="button" class="btn btn-success" data-toggle="modal">Regresar</button>
                </div>
                <div class="col-lg-12 p-2">
                     <h1>Tabla de Asignatura del Básico</h1>
                     <p><b>Aclaración:</b>Las asignatura del correspondiente a 1ro y 2do corresponde a todos los Planes de estudios registrados...</p>
                </div>
                <div class="col-lg-12 p-2">
                    <button id="btnNuevo_Asignatura" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>
                </div>
        </div>
</div>



 
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaAsignnatura" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>N°Asi</th> 
                                <th>N°Plan</th>
                                <th>Ciclo</th> 
                                <th>Nombre</th>                         
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {
                            ?>
                            <tr>
                                
                                <td><?php echo $dat['idAsig']; ?></td>
                                <td><?php echo $dat['idPlan']; ?></td>
                                <td><?php echo $dat['ciclo']; ?></td>
                                <td><?php echo $dat['nombre']; ?></td> 
                    
           
                                <td></td>
                            </tr>
                            <?php
                                
                            }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
      

        
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD_Asignatura" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonasPlanAsignatura">    
                         
            <div class="modal-body">
               

                <div class="form-group">
                <label for="ciclosss" class="col-form-label">Corresponde al:</label>
                <select class="form-control" id="ciclosss">
                <option>1° AÑO (1° AÑO P.C.)</option>
                <option>2° AÑO (2° AÑO P.C.)</option>
               
                </select>
                </div> 


                <div class="form-group">
                <label for="cue" class="col-form-label">Asignatura:</label>
                <input type="text" class="form-control" id="asigantura">
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
      
  
</div>


 <script type="text/javascript">
$(document).ready(function(){


    var tablaAsignnatura = $('#tablaAsignnatura').DataTable({ 

    "destroy":true,
    "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<button class='btn btn-primary btnEditar_Asignnatura'>Editar</button><button class='btn btn-danger btnBorrar_Asignnatura'>Borrar</button>"  
       }],
        
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



 $("#btn_regresar_asignatura").click(function(){
        $('#imagenProceso').show();
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').load('modulosCarga/asignaturas/asignaturas_Selec.php');
        $('#imagenProceso').hide(); 
});


$("#btnNuevo_Asignatura").click(function(){

    $("#formPersonasPlanAsignatura").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Asignatura");            
    $("#modalCRUD_Asignatura").modal("show"); 

  
    idAsig=null;
    opcion = 1; //alta
}); 



var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar_Asignnatura", function(){
    fila = $(this).closest("tr");

 
    idAsig = parseInt(fila.find('td:eq(0)').text());
    idPlan = fila.find('td:eq(1)').text();
    ciclo = fila.find('td:eq(2)').text();
    nombre = fila.find('td:eq(3)').text();

    $("#idPlanAsignatura").val(idPlan);
    $("#ciclosss").val(ciclo);
    $("#asigantura").val(nombre);



    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar nombre de la Asignatura");            
    $("#modalCRUD_Asignatura").modal("show");  
    
});

//botón BORRAR
//botón BORRAR
$(document).on("click", ".btnBorrar_Asignnatura", function(){    
    fila = $(this);
    idAsig = parseInt($(this).closest("tr").find('td:eq(0)').text());


    nombre = $(this).closest("tr").find('td:eq(3)').text();

    opcion = 3 ;//borrar

    eliminarAntesPlanAsignatura(idAsig,nombre,opcion);
  
});
    




function eliminarAntesPlanAsignatura(idAsig,nombre,opcion) {

  

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

    eliminarAntesPlanAsignaturaFinal(idAsig,nombre,opcion);
  }
})



      
     
}


function  eliminarAntesPlanAsignaturaFinal(idAsig,nombre,opcion){


    var respuesta = confirm("¿Está seguro de eliminar la asignatura: "+nombre+"?");
    if(respuesta){
        
        $.ajax({
            url: "bd/crud_datos_Plan_Asignaturas.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, idAsig:idAsig},
            success: function(){
            
               
            }
        });

        tablaAsignnatura.row(fila.parents('tr')).remove().draw();

    } 
}




$("#formPersonasPlanAsignatura").submit(function(e){
    e.preventDefault();    
 
    idPlan = 'básico';
    nombre = $.trim($("#asigantura").val());
    ciclo = $.trim($("#ciclosss").val());
    

    console.log({idPlan:idPlan, nombre:nombre,  opcion:opcion, idAsig:idAsig, ciclo:ciclo});
    $.ajax({
        url: "bd/crud_datos_Plan_Asignaturas.php",
        type: "POST",
        dataType: "json",
        data: {idPlan:idPlan, nombre:nombre,  opcion:opcion, idAsig:idAsig, ciclo:ciclo},
        success: function(data){  
            console.log(data);
            idAsig = data[0].idAsig;            
            idPlan = data[0].idPlan;
            nombre = data[0].nombre;
            ciclo = data[0].ciclo;
       
            
            if(opcion == 1){tablaAsignnatura.row.add([idAsig,idPlan,ciclo,nombre]).draw();}
            else{tablaAsignnatura.row(fila).data([idAsig,idPlan,ciclo,nombre]).draw();}            
        }        
    });
    $("#modalCRUD_Asignatura").modal("hide");    
    
});    
    

    
});

</script>


