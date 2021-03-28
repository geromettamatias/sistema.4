
<!--INICIO del cont principal-->
<div class="container">

 <?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();


$dniAlumnos=$_SESSION["s_usuarioEstudiante"];



$consulta = "SELECT `idAlumnos` FROM `datosalumnos` WHERE `dniAlumnos`='$dniAlumnos'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
foreach($data as $dat) { 

    $idAlumnos=$dat['idAlumnos'];
}



 
$consulta = "SELECT `id_mensaje`, `id_usuario`, `usuarioDocente`, `fecha`, `mensaje`, `datos` FROM `mensajesDocente` WHERE `id_usuario`='$idAlumnos'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);





?>







    <input type="text" class="form-control" id="idAlumnoCos" value="<?php echo $idAlumnos ?>" hidden="">
    <button id="btnNuevo_mensajeAdmin" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button><br><br> 

  
 
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaAlumnoMensaje" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>id</th> 
                                <th>id</th>
                                <th>Profesor</th>
                                <th>Fecha</th> 
                                <th>Mensaje</th> 
                                <th>Respuesta</th> 
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                             
                                <td><?php echo $dat['id_mensaje'] ?></td>
                                <td><?php echo $dat['id_usuario'] ?></td>

                                 <td><?php 


                                 $usuarioDocente=$dat['usuarioDocente'];


                                 $consulta = "SELECT `nombre` FROM `datos_docentes` WHERE `idDocente`='$usuarioDocente'";
                                    $resultado = $conexion->prepare($consulta);
                                    $resultado->execute();
                                    $d1ata=$resultado->fetchAll(PDO::FETCH_ASSOC);

                                     foreach($d1ata as $d1at) {   

                                        $nombre=$d1at['nombre'];

                                        }

                                        echo $nombre;


                                 ?></td>
                                <td><?php echo $dat['fecha'] ?></td>
                                <td><?php echo $dat['mensaje'] ?></td>
                                <td><?php echo $dat['datos'] ?></td>
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
<div class="modal fade" id="modalCRUD_mensaje_Admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonasMensajeAdmin">    
                         
            <div class="modal-body">
                
               
                <div class="form-group">
                <label for="fecha" class="col-form-label">Fecha:</label>
                <input type="text" class="form-control" id="fecha" readonly="readonly">
                </div>

                                
                <div class="form-group">


                <label for="planSeleC" class="col-form-label">Profesor:</label>
                                
                    <select class="form-control" id="usuarioDocente">

                    <option value="0">Seleccione al Profesor</option>

                     <?php
                    include_once '../bd/conexion.php';
                    $objeto = new Conexion();
                    $conexion = $objeto->Conectar();

                    $consulta = "SELECT `idDocente`, `dni`, `nombre` FROM `datos_docentes` ORDER BY `nombre` ASC";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();
                    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                            
                        foreach($data as $dat) { 


                          $idDocente=$dat['idDocente'];
                          $nombre=$dat['nombre'];
                    


                        ?>

                        <option value="<?php echo $idDocente ?>"><?php echo $nombre ?></option>

                        
                              
                         
                        <?php
                            }
                        ?>  


                    </select>






                </div>


                <div class="form-group">
                <label for="mensaje" class="col-form-label">Mensajes:</label>
                
                <textarea class="form-control" rows="4" id="mensaje"></textarea>
                </div>
                <div class="form-group">
                <label for="datos" class="col-form-label" readonly="readonly" hidden="">Respuesta:</label>
                
                <textarea class="form-control" rows="3" id="datos" readonly="readonly" hidden=""></textarea>
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
    var tablaAlumnoMensaje = $('#tablaAlumnoMensaje').DataTable({ 

          
      
    "columnDefs":[{
       
        "targets": -1,
        "data":null,
        "defaultContent": "<button class='btn btn-primary btnEditar_mensajeAdmin'>Editar</button><button class='btn btn-danger btnBorrar_mensajeAdmin'>Borrar</button>",


       },

      

       ],


       

      

        

        

 "destroy":true,
        
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


$("#btnNuevo_mensajeAdmin").click(function(){

    var f = new Date();



    $("#formPersonasMensajeAdmin").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Ingresar datos ");            
    $("#modalCRUD_mensaje_Admin").modal("show"); 
    $("#fecha").val(f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());
    id_mensaje=null;
   
    opcion = 1; //alta
}); 


var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar_mensajeAdmin", function(){
    fila = $(this).closest("tr");

 
    id_mensaje = parseInt(fila.find('td:eq(0)').text());
    ob=1;

     $.ajax({
        url: "bd/crud_datos_mensajeDocenteIDNombre.php",
        type: "POST",
        dataType: "json",
        data: {id_mensaje:id_mensaje, ob:ob},
        success: function(data){  
            console.log(data);

            id_mensaje = data[0].id_mensaje;            
            id_usuario = data[0].id_usuario;
            usuarioDocente = data[0].usuarioDocente;
            fecha = data[0].fecha;
            mensaje = data[0].mensaje;
            datos = data[0].datos;

             $("#usuarioDocente").val(usuarioDocente);
            $("#fecha").val(fecha);
            $("#mensaje").val(mensaje);
            $("#datos").val(datos);
            
        }        
    });

   

    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar datos");            
    $("#modalCRUD_mensaje_Admin").modal("show");  
    
});

//botón BORRAR
//botón BORRAR
$(document).on("click", ".btnBorrar_mensajeAdmin", function(){    
    fila = $(this);
    id_mensaje = parseInt($(this).closest("tr").find('td:eq(0)').text());
 

    opcion = 3 ;//borrar


    eliminarmensajeAdmin(id_mensaje,opcion);
  
});
    




function eliminarmensajeAdmin(id_mensaje,opcion) {

  

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

    eliminarmensajeAdminFina(id_mensaje,opcion);
  }
})



      
     
}


function  eliminarmensajeAdminFina(id_mensaje,opcion){


    var respuesta = confirm("¿Está seguro de eliminar este registro?");
    if(respuesta){
        
        $.ajax({
            url: "bd/crud_datos_mensajeDocente.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id_mensaje:id_mensaje},
            success: function(){
            
               
            }
        });

        tablaAlumnoMensaje.row(fila.parents('tr')).remove().draw();

        

    } 
}




$("#formPersonasMensajeAdmin").submit(function(e){
    e.preventDefault();    
    
    usuarioDocente = $.trim($("#usuarioDocente").val());
    fecha = $.trim($("#fecha").val());
    mensaje = $.trim($("#mensaje").val());
    datos = $.trim($("#datos").val());
    id_usuario=$("#idAlumnoCos").val();       
    console.log({id_mensaje:id_mensaje, id_usuario:id_usuario, fecha:fecha, mensaje:mensaje, datos:datos, opcion:opcion, usuarioDocente:usuarioDocente});




    $.ajax({
        url: "bd/crud_datos_mensajeDocente.php",
        type: "POST",
        dataType: "json",
        data: {id_mensaje:id_mensaje, id_usuario:id_usuario, fecha:fecha, mensaje:mensaje, datos:datos, opcion:opcion, usuarioDocente:usuarioDocente},
        success: function(data){  
            console.log(data);

            id_mensaje = data[0].id_mensaje;            
            id_usuario = data[0].id_usuario;
            usuarioDocente = data[0].usuarioDocente;
            fecha = data[0].fecha;
            mensaje = data[0].mensaje;
            datos = data[0].datos;



                    ob=2;

                     $.ajax({
                        url: "bd/crud_datos_mensajeDocenteIDNombre.php",
                        type: "POST",
                        dataType: "json",
                        data: {id_mensaje:id_mensaje, usuarioDocente:usuarioDocente, ob:ob},
                        success: function(data){  
                            console.log(data);

                            nombre = data[0].nombre;            
                           
                            if(opcion == 1){tablaAlumnoMensaje.row.add([id_mensaje,id_usuario,nombre,fecha,mensaje,datos]).draw();}
                            else{tablaAlumnoMensaje.row(fila).data([id_mensaje,id_usuario,nombre,fecha,mensaje,datos]).draw();} 
                                            
                            
                        }        
                    });









            

            
        }        
    });
    $("#modalCRUD_mensaje_Admin").modal("hide");    
    
});    
    

    
});





</script>

