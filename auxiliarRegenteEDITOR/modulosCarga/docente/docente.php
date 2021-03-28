<?php
        include_once '../../bd/conexion.php';
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        session_start();


        $consulta = "SELECT `idDocente`, `dni`, `nombre` FROM `datos_docentes`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

?>



<div class="container">
    <div class="row">
        <div class="col-lg-12 p-2">
            <h1>Registro Docente</h1>
        </div>
        <div class="col-lg-12 p-2">
            <button id="btnNuevo_Docente" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button><br><br> 
        </div>
    </div>
</div>




    

  
 
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaDocente" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>N°</th> 
                                <th>DNI</th>
                                <th>Apellido y Nombre</th> 
                                <th>Asignación</th> 
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                   

                                $idDocente=$dat['idDocente'];                    
                            ?>
                            <tr>
                             
                                <td><?php echo $dat['idDocente'] ?></td>
                                <td><?php echo $dat['dni'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><button class="btn btn-outline-danger glyphicon glyphicon-pencil" onclick="asignacionDocente('<?php echo $idDocente ?>')">Asignación</button></td>

        

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
<div class="modal fade" id="modalCRUD_Docente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonasDocente">    
                         
            <div class="modal-body">
                

                <div class="form-group">
                <label for="nombreAlumnos2" class="col-form-label">Normbre y Apellido:</label>
                <input type="text" class="form-control" id="nombreD">
                </div>
                <div class="form-group">
                <label for="dniAlumnos2" class="col-form-label">DNI:</label>
                <input type="text" class="form-control" id="dniD">
                </div>
               
                <div class="form-group">
                <label for="domicilioAlumnos2" class="col-form-label">Domicilio:</label>
                <input type="text" class="form-control" id="domicilioD">
                </div>
                <div class="form-group">
                <label for="emailAlumnos2" class="col-form-label">Email:</label>
                <input type="text" class="form-control" id="emailD">
                </div>
                <div class="form-group">
                <label for="telefonoAlumnos2" class="col-form-label">Telefono:</label>
                <input type="text" class="form-control" id="telefonoD">
                </div>
                <div class="form-group">
                <label for="discapasidadAlumnos2" class="col-form-label">Titulo:</label>
                <input type="text" class="form-control" id="tituloD">
                </div>
          
                <div class="form-group">
                <label for="passwordDocente" class="col-form-label">Contraseña:</label>
                <input type="text" class="form-control" id="passwordDocente">
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
      
  



<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD_Docente_Asig" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        
            <div class="modal-body">
                
                    <div id="tableFi"></div>

         


            </div>   
                               
            
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                
            </div>
           
        </div>
    </div>
</div> 


 <script type="text/javascript">
$(document).ready(function(){
    $('#imagenProceso').hide();
    var tablaDocente = $('#tablaDocente').DataTable({ 

          
    "destroy":true,  
    "columnDefs":[{
       
        "targets": -1,
        "data":null,
        "defaultContent": "<button class='btn btn-info btnEditar_Docente_datos mr-2'>Datos</button><button class='btn btn-primary btnEditar_Docente mr-2'>Editar</button><button class='btn btn-danger btnBorrar_Docente mr-2'>Borrar</button>",


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

$(document).on("click", ".btnEditar_Docente_datos", function(){
    fila = $(this).closest("tr");

 
    idDocente = parseInt(fila.find('td:eq(0)').text());

    $.ajax({
        url: "bd/crud_DocenteDatosLetura.php",
        type: "POST",
        dataType: "json",
        data: {idDocente:idDocente},
        beforeSend: function() {
                    $('#imagenProceso').show();
                              },
        success: function(data){  
           
            idDocente = data[0].idDocente;            
            nombre = data[0].nombre;
            dni = data[0].dni;
            domicilio = data[0].domicilio;
            email = data[0].email;
            telefono = data[0].telefono;
            titulo = data[0].titulo;
            passwordDocente= data[0].passwordDocente;
            
            Swal.fire({
                title: 'Datos',
                html:'<div class="col-12">  <div class="input-group input-group-sm mb-3"><div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-sm">Apellido y Nombre: </span></div>'+nombre+'</div>  <div class="input-group input-group-sm mb-3"><div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-sm">DNI: </span></div>'+dni+'</div>  <div class="input-group input-group-sm mb-3"><div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-sm">Domicilio: </span></div>'+domicilio+'</div> <div class="input-group input-group-sm mb-3"><div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-sm">Email: </span></div>'+email+'</div><div class="input-group input-group-sm mb-3"><div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-sm">Telefono: </span></div>'+telefono+'</div><div class="input-group input-group-sm mb-3"><div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-sm">Titulo: </span></div>'+titulo+'</div><div class="input-group input-group-sm mb-3"><div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-sm">Contraseña: </span></div>'+passwordDocente+'</div></div>', 
                focusConfirm: false,
                showCancelButton: true,                         
                }).then((result) => {
              
          });


            $('#imagenProceso').hide();      
               
        }        
    });



    
});

// 


$("#btnNuevo_Docente").click(function(){

    $("#formPersonasDocente").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Ingresar datos del Profesor");            
    $("#modalCRUD_Docente").modal("show"); 

    idDocente=null;
    opcion = 1; //alta
}); 



var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar_Docente", function(){
    fila = $(this).closest("tr");

 
    idDocente = parseInt(fila.find('td:eq(0)').text());

    
    $.ajax({
        url: "bd/crud_DocenteDatosLetura.php",
        type: "POST",
        dataType: "json",
        data: {idDocente:idDocente},
        beforeSend: function() {
                    $('#imagenProceso').show();
                              },
        success: function(data){  
          

            idDocente = data[0].idDocente;            
            nombre = data[0].nombre;
            dni = data[0].dni;
            domicilio = data[0].domicilio;
            email = data[0].email;
            telefono = data[0].telefono;
            titulo = data[0].titulo;
            passwordDocente= data[0].passwordDocente;

            $("#nombreD").val(nombre);
            $("#dniD").val(dni);
           
            $("#domicilioD").val(domicilio);
            $("#emailD").val(email);
            $("#telefonoD").val(telefono);
            $("#tituloD").val(titulo);
            
            $("#passwordDocente").val(passwordDocente);
           
            $('#imagenProceso').hide();   
        }        
    });



    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar datos del Profesor");            
    $("#modalCRUD_Docente").modal("show");  
    
});

//botón BORRAR
//botón BORRAR
$(document).on("click", ".btnBorrar_Docente", function(){    
    fila = $(this);
    idDocente = parseInt($(this).closest("tr").find('td:eq(0)').text());
 

    opcion = 3 ;//borrar

    eliminarAntesPlanDocente(idDocente,opcion);
  
});
    




function eliminarAntesPlanDocente(idDocente,opcion) {

  

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

    eliminarAntesPlanDocenteFinal(idDocente,opcion);
  }
})



      
     
}


function  eliminarAntesPlanDocenteFinal(idDocente,opcion){


        
        $.ajax({
            url: "bd/crud_datos_Plan_Docente.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, idDocente:idDocente},
            beforeSend: function() {
                    $('#imagenProceso').show();
                              },
            success: function(){
            
               
            }
        });

        tablaDocente.row(fila.parents('tr')).remove().draw();
         $("#modalCRUD_Docente").modal("hide");

    
}




$("#formPersonasDocente").submit(function(e){
    e.preventDefault();    
 
    nombre= $.trim($("#nombreD").val());
    dni= $.trim($("#dniD").val());
    domicilio= $.trim($("#domicilioD").val());
    
    email = $.trim($("#emailD").val());
    telefono = $.trim($("#telefonoD").val());
    titulo = $.trim($("#tituloD").val());
   
    passwordDocente = $.trim($("#passwordDocente").val());
   

    $.ajax({
        url: "bd/crud_datos_Plan_Docente.php",
        type: "POST",
        dataType: "json",
        data: {nombre:nombre, dni:dni, domicilio:domicilio, email:email, telefono:telefono, titulo:titulo, passwordDocente:passwordDocente, opcion:opcion, idDocente:idDocente},
        beforeSend: function() {
                    $('#imagenProceso').show();
                              },
        success: function(data){  
            

            idDocente = data[0].idDocente;            
            nombre = data[0].nombre;
            dni = data[0].dni;
            boton="<button class='btn btn-outline-danger btn_Asignacion mr-2' onclick='asignacionDocente("+idDocente+")'>Asignación</button>";

       
      
            
            if(opcion == 1){tablaDocente.row.add([idDocente,dni,nombre,boton]).draw();}
            else{tablaDocente.row(fila).data([idDocente,dni,nombre,boton]).draw();}  
            $('#imagenProceso').hide();          
        }        
    });
    $("#modalCRUD_Docente").modal("hide");    
    
});    
    







    
});

function asignacionDocente(idDocente) {


     $.ajax({
          type:"post",
          data:'idDocente=' + idDocente,
          url:'modulosCarga/elementos/docenteSEL.php',
          beforeSend: function() {
            $('#imagenProceso').show();
                              },
          success:function(r){  
           
        $('#tableFi').load('modulosCarga/elementos/tablaasignDpce.php');
           $('#imagenProceso').hide();
          }
        });



    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#D3C607");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Asignación al Profesor");            
    $("#modalCRUD_Docente_Asig").modal("show"); 
    

}

</script>

