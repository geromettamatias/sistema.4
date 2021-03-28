<?php
        include_once '../../bd/conexion.php';
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();

        $consulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="container">
        <div class="row">
            <div class="col-lg-12 p-2">            
            <h1>Carga de Plan de Estudio</h1>   
            </div> 
            <div class="col-lg-12 p-2">            
            <button id="btnNuevo_Plan" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPlan" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>N°Plan</th>
                                <th>N°Inst</th>
                                <th>Orientación (Nombre)</th>
                                <th>N° Resolución</th>                            
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['idPlan'] ?></td>
                                <td><?php echo $dat['idInstitucion'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['numero'] ?></td>
                           
                                    
                                    
                                </td>
           
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
<div class="modal fade" id="modalCRUD_Plan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonasPlan">    
                         
                
                <div id="seleInstituto"></div> 

        
                               
            
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
    $('#imagenProceso').hide();

    $('#seleInstituto').load('modulosCarga/elementos/selecInstitucion.php');

    var tablaPlan = $('#tablaPlan').DataTable({ 

    "destroy":true,    
    "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<button class='btn btn-primary btnEditar_Plan'>Editar</button><button class='btn btn-danger btnBorrar_Plan'>Borrar</button>"  
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



$("#btnNuevo_Plan").click(function(){

    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo plan de estudio");            
    $("#modalCRUD_Plan").modal("show"); 

    idPlan=null;
    opcion = 1; //alta
}); 



var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar_Plan", function(){
    fila = $(this).closest("tr");

 
    idPlan = parseInt(fila.find('td:eq(0)').text());
    institucionPlan = fila.find('td:eq(1)').text();
    nombrePlan = fila.find('td:eq(2)').text();
    numeroPlan = fila.find('td:eq(3)').text();
    

    
    $("#institucionPlan").val(institucionPlan);
    $("#nombrePlan").val(nombrePlan);
    $("#numeroPlan").val(numeroPlan);


    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar plan de estudio");            
    $("#modalCRUD_Plan").modal("show");  
    
});

//botón BORRAR
//botón BORRAR
$(document).on("click", ".btnBorrar_Plan", function(){    
    fila = $(this);
    idPlan = parseInt($(this).closest("tr").find('td:eq(0)').text());


    nombrePlan = $(this).closest("tr").find('td:eq(1)').text();

    opcion = 3 ;//borrar

    eliminarAntesPlan(idPlan,nombrePlan,opcion);
  
});
    







function eliminarAntesPlan(idPlan,nombrePlan,opcion) {

  

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

    eliminarDefinitivoPlan(idPlan,nombrePlan,opcion);
  }
})



      
     
}


function  eliminarDefinitivoPlan(idPlan,nombrePlan,opcion){


    var respuesta = confirm("¿Está seguro de eliminar el Plan de estudio: "+nombrePlan+"?");
    if(respuesta){
        
        $.ajax({
            url: "bd/crud_datos_Plan.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, idPlan:idPlan},
            success: function(){
            
               
            }
        });

        tablaPlan.row(fila.parents('tr')).remove().draw();

    } 
}





$("#formPersonasPlan").submit(function(e){
    e.preventDefault();    
 
    institucionPlan = $.trim($("#institucionPlan").val());
    nombrePlan = $.trim($("#nombrePlan").val());
    numeroPlan = $.trim($("#numeroPlan").val());   
    console.log({institucionPlan:institucionPlan, nombrePlan:nombrePlan, numeroPlan:numeroPlan, opcion:opcion, idPlan:idPlan});
    $.ajax({
        url: "bd/crud_datos_Plan.php",
        type: "POST",
        dataType: "json",
        data: {institucionPlan:institucionPlan, nombrePlan:nombrePlan, numeroPlan:numeroPlan, opcion:opcion, idPlan:idPlan},
        success: function(data){  
            console.log(data);
            idPlan = data[0].idPlan;            
            institucionPlan = data[0].idInstitucion;
            nombrePlan = data[0].nombre;
            numeroPlan = data[0].numero;
            
            if(opcion == 1){tablaPlan.row.add([idPlan,institucionPlan,nombrePlan,numeroPlan]).draw();}
            else{tablaPlan.row(fila).data([idPlan,institucionPlan,nombrePlan,numeroPlan]).draw();}            
        }        
    });
    $("#modalCRUD_Plan").modal("hide");    
    
});    
    

    
});

</script>