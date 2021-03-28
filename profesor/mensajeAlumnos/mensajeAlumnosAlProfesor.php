
<!--INICIO del cont principal-->
<div class="container">

 <?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();


$s_usuarioProfesor=$_SESSION["s_usuarioProfesor"];



$consulta = "SELECT `idDocente` FROM `datos_docentes` WHERE `dni`='$s_usuarioProfesor'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
foreach($data as $dat) { 

    $idDocente=$dat['idDocente'];
}


 
$consulta = "SELECT `id_mensaje`, `id_usuario`, `usuarioDocente`, `fecha`, `mensaje`, `datos` FROM `mensajesdocente` WHERE `usuarioDocente`='$idDocente'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


?>







    <input type="text" class="form-control" id="idDocenteFina" value="<?php echo $idDocente ?>" hidden="">
   
 
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaAlumnoMensaje" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>id</th> 
                 
                                <th>Alumno</th>
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
            
                                <td><?php 

                                $id_usuario=$dat['id_usuario'];


                                $consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor`, `idPlanEstudio` FROM `datosalumnos` WHERE `idAlumnos`='$id_usuario'";
                                $resultado = $conexion->prepare($consulta);
                                $resultado->execute();
                                $d1ata=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($d1ata as $d1at) { 

                                    $nombreAlumnos=$d1at['nombreAlumnos'];
                                    $dniAlumnos=$d1at['dniAlumnos'];
                                }

                                echo $nombreAlumnos.'--'.$dniAlumnos;

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
                <label for="mensaje" class="col-form-label">Mensajes:</label>
                
                <textarea class="form-control" rows="4" id="mensaje" readonly="readonly"></textarea>
                </div>
                <div class="form-group">
                <label for="datos" class="col-form-label">Respuesta:</label>
                
                <textarea class="form-control" rows="3" id="datos"></textarea>
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
        "defaultContent": "<button class='btn btn-primary btnEditar_mensajeAdmin'>Responder</button><button class='btn btn-danger btnBorrar_mensajeAdmin'>Borrar</button>",


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
$(document).on("click", ".btnEditar_mensajeAdmin", function(){
    fila = $(this).closest("tr");

 
    id_mensaje = parseInt(fila.find('td:eq(0)').text());

   
    fecha = fila.find('td:eq(2)').text();
    mensaje = fila.find('td:eq(3)').text();
    datos = fila.find('td:eq(4)').text();

    $("#fecha").val(fecha);
    $("#mensaje").val(mensaje);
    $("#datos").val(datos);

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
            url: "bd/crud_mensajeAdmin.php",
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
 
   
   
    datos = $.trim($("#datos").val());
           
    console.log({id_mensaje:id_mensaje, datos:datos, opcion:opcion});




    $.ajax({
        url: "bd/crud_mensajeAdmin.php",
        type: "POST",
        dataType: "json",
        data: {id_mensaje:id_mensaje, datos:datos, opcion:opcion},
        success: function(data){  
            console.log(data);

            id_mensaje = data[0].id_mensaje;            
            id_usuario = data[0].id_usuario;
            fecha = data[0].fecha;
            mensaje = data[0].mensaje;
            datos = data[0].datos;


                $.ajax({
                        url: "bd/crud_Alumno.php",
                        type: "POST",
                        dataType: "json",
                        data: {id_usuario:id_usuario},
                        success: function(data){  
                            console.log(data);
 
                            nombreAlumnos = data[0].nombreAlumnos;            
                            dniAlumnos = data[0].dniAlumnos;
                         
                            if(opcion == 1){tablaAlumnoMensaje.row.add([id_mensaje,nombreAlumnos+dniAlumnos,fecha,mensaje,datos]).draw();}
                            else{tablaAlumnoMensaje.row(fila).data([id_mensaje,nombreAlumnos+'--'+dniAlumnos,fecha,mensaje,datos]).draw();} 

                            
                        }        
                    });


            
        }        
    });
    $("#modalCRUD_mensaje_Admin").modal("hide");    
    
});    
    

    
});









</script>

