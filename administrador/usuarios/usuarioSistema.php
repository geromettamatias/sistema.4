
<!--INICIO del cont principal-->
<div class="container">

 <?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();



 
$consulta = "SELECT `id`, `usuario`, `password` FROM `usuario_administrador`";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


?>





<h3>Gestión-Usuarios Adminstrador del sitio (solo Administrador)</h3>


    <button id="btnNuevo_Usuario" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button><br><br> 

  
 
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaUsuario" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>N°</th> 
                                <th>Usuario</th>
                                <th>Contraseña</th> 
                         

                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                             
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['usuario'] ?></td>
                                <td><?php echo base64_decode ($dat['password']); ?></td>
        

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
<div class="modal fade" id="modalCRUD_Usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonasUsuario">    
                         
            <div class="modal-body">
                

                <div class="form-group">
                <label for="usuario" class="col-form-label">Usuario:</label>
                <input type="text" class="form-control" id="usuario">
                </div>
                <div class="form-group">
                <label for="password" class="col-form-label">Contraseña:</label>
                <input type="text" class="form-control" id="password">
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
    $('#imagenProceso').hide();
    var tablaUsuario = $('#tablaUsuario').DataTable({ 

          
      
    "columnDefs":[{
       
        "targets": -1,
        "data":null,
        "defaultContent": "<button class='btn btn-primary btnEditar_Usuario'>Editar</button><button class='btn btn-danger btnBorrar_Usuario'>Borrar</button>",


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

// visualizar datos de la tabla extras


// 


$("#btnNuevo_Usuario").click(function(){

    $("#formPersonasUsuario").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Ingresar datos del Usuario");            
    $("#modalCRUD_Usuario").modal("show"); 

    id=null;
    opcion = 1; //alta
}); 



var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar_Usuario", function(){
    fila = $(this).closest("tr");

 
    id = parseInt(fila.find('td:eq(0)').text());
    usuario = fila.find('td:eq(1)').text();
    password = fila.find('td:eq(2)').text();

    $("#usuario").val(usuario);
    $("#password").val(password);
 


    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar datos del Usuario");            
    $("#modalCRUD_Usuario").modal("show");  
    
});

//botón BORRAR
//botón BORRAR
$(document).on("click", ".btnBorrar_Usuario", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
 

    opcion = 3 ;//borrar

    eliminarAntesPlanUsuario(id,opcion);
  
});
    




function eliminarAntesPlanUsuario(id,opcion) {

  

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

    eliminarAntesPlanUsuarioFinal(id,opcion);
  }
})



      
     
}


function  eliminarAntesPlanUsuarioFinal(id,opcion){


    var respuesta = confirm("¿Está seguro de eliminar este registro?");
    if(respuesta){
        
        $.ajax({
            url: "bd/crud_datos_Plan_Usuario.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
            
               
            }
        });

        tablaUsuario.row(fila.parents('tr')).remove().draw();

    } 
}




$("#formPersonasUsuario").submit(function(e){
    e.preventDefault();    
 
    usuario= $.trim($("#usuario").val());
    password= $.trim($("#password").val());
   
   

    console.log({usuario:usuario, password:password, opcion:opcion, id:id});

    $.ajax({
        url: "bd/crud_datos_Plan_Usuario.php",
        type: "POST",
        dataType: "json",
        data: {usuario:usuario, password:password, opcion:opcion, id:id},
        success: function(data){  
            console.log(data);

            id = data[0].id;            
            usuario = data[0].usuario;
            pass = data[0].password;

            password=atob(pass);
            
            if(opcion == 1){tablaUsuario.row.add([id,usuario,password]).draw();}
            else{tablaUsuario.row(fila).data([id,usuario,password]).draw();}            
        }        
    });
    $("#modalCRUD_Usuario").modal("hide");    
    
});    
    

    
});


</script>

