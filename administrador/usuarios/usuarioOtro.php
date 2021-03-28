
<!--INICIO del cont principal-->
<div class="container">

 <?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();



 
$consulta = "SELECT `idUsu`, `nombre`, `dni`, `usuario`, `pass`, `cargo`, `nivelCurso`, `operacion` FROM `usuarios_auxilar_regente`";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


?>




<h3>Gestión-Usuarios (Auxiliar, Regente, otros)</h3>




    <button id="btnNuevo_Usuario" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button><br><br> 

  
 
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaUsuarioAUXI" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>N°</th> 
                                <th>NOMBRE</th>
                                <th>DNI</th>
                                <th>USUARIO</th>
                                <th>CONTRASEÑA</th> 
                                <th>CARGO</th> 
                                <th>CURSO</th>
                                <th>OPERACIÓN</th>
                                <th>BOTON</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>

                       
                                <td><?php echo $dat['idUsu'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['dni'] ?></td>
                                <td><?php echo $dat['usuario'] ?></td>
                                <td><?php echo base64_decode ($dat['pass']); ?></td>
                                <td><?php echo $dat['cargo'] ?></td>
                                <td><?php echo $dat['nivelCurso'] ?></td>
                                <td><?php echo $dat['operacion'] ?></td>
        

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
<div class="modal fade" id="modalCRUD_UsuarioAUXREG"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonasUsuarioAUXPR">    
                         
            <div class="modal-body">
                
     
                <div class="form-group">
                <label for="nombre" class="col-form-label">APELLIDO Y NOMBRE:</label>
                <input type="text" class="form-control" id="nombre">
                </div>
                <div class="form-group">
                <label for="dni" class="col-form-label">DNI:</label>
                <input type="number" class="form-control" id="dni">
                </div>
                <div class="form-group">
                <label for="usuario" class="col-form-label">Usuario:</label>
                <input type="text" class="form-control" id="usuario">
                </div>
                <div class="form-group">
                <label for="pass" class="col-form-label">Contraseña:</label>
                <input type="text" class="form-control" id="pass">
                </div>
           
        

                <div class="form-group">
                <label for="cargo" class="col-form-label">TIPO DE USUARIO:</label>
                <select class="form-control" id="cargo">
                <option>AUXILIAR</option>
                <option>REGENTE</option>
                </select> 
                </div>
                <div id="cursoSEl"></div><div id="datosCur"></div>
                 <div class="form-group">
                    

                <label for="nivelCurso" class="col-form-label">CURSO QUE TENDRA ACCESO</label><br>
               

                <select id="nivelCurso" class="form-control" multiple data-live-search="true">
                  <option>1°1°PC</option>
                  <option>1°2°PC</option>
                  <option>1°3°PC</option>
                  <option>1°4°PC</option>
                  <option>1°5°PC</option>

                  <option>2°1°PC</option>
                  <option>2°2°PC</option>
                  <option>2°3°PC</option>
                  <option>2°4°PC</option>

                  <option>1°1°SC</option>
                  <option>1°2°SC</option>
                  <option>1°3°SC</option>

                  <option>2°1°SC</option>
                  <option>2°2°SC</option>

                  <option>3°1°SC</option>
                  <option>3°2°SC</option>

                  <option>4°1°SC</option>
                  <option>TODOS</option>

                </select>
                </div>


                 <div class="form-group">
                <label for="operacion" class="col-form-label">PRIVILEGIOS:</label>
                <select class="form-control" id="operacion">

                <option>LEER</option>
                <option>CAMBIAR</option>
                <option>CAMBIAR TOTAL</option>
                <option>AUXILIAR-TITULO</option>
                </select> 
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
    var tablaUsuarioAUXI = $('#tablaUsuarioAUXI').DataTable({ 

          
      
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
    $("#modalCRUD_UsuarioAUXREG").modal("show"); 

    $("#cursoSEl").html('');
    $("#datosCur").html('');

     $('select').select2({
width: '100%',
  createTag: function (params) {
    var term = $.trim(params.term);

    if (term === '') {
      return null;
    }

    return {
      id: term,
      text: term,
      newTag: true // add additional parameters
    }
  }
});

    idUsu=null;
    opcion = 1; //alta
}); 



var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar_Usuario", function(){
    fila = $(this).closest("tr");


    idUsu = parseInt(fila.find('td:eq(0)').text());
    nombre = fila.find('td:eq(1)').text();
    dni = fila.find('td:eq(2)').text();
    usuario = fila.find('td:eq(3)').text();
    pass = fila.find('td:eq(4)').text();
    cargo = fila.find('td:eq(5)').text();
    nivelCurso = fila.find('td:eq(6)').text();
    operacion = fila.find('td:eq(7)').text();


   
         $('select').select2({
width: '100%',
  createTag: function (params) {
    var term = $.trim(params.term);

    if (term === '') {
      return null;
    }

    return {
      id: term,
      text: term,
      newTag: true // add additional parameters
    }
  }
});

      idUsu = parseInt(fila.find('td:eq(0)').text());
    nombre = fila.find('td:eq(1)').text();
    dni = fila.find('td:eq(2)').text();
    usuario = fila.find('td:eq(3)').text();
    pass = fila.find('td:eq(4)').text();
    cargo = fila.find('td:eq(5)').text();
    nivelCurso = fila.find('td:eq(6)').text();
    operacion = fila.find('td:eq(7)').text();



    
    $("#datosCur").html('<b>(Si carga nuevo curso debes cargar los anteriores, EN CASO DE NO EDITAR LOS CURSOS, DEBAR EN BLANCO!!)</b>');
    $("#cursoSEl").html(nivelCurso);
  
    $("#nivelCurso").val(nivelCurso);
    $("#nombre").val(nombre);
    $("#dni").val(dni);
    $("#usuario").val(usuario);
    $("#pass").val(pass);
    $("#cargo").val(cargo);
  
    $("#operacion").val(operacion);

    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar datos del Usuario");            
    $("#modalCRUD_UsuarioAUXREG").modal("show");  
    
});

//botón BORRAR
//botón BORRAR
$(document).on("click", ".btnBorrar_Usuario", function(){    
    fila = $(this);
    idUsu = parseInt($(this).closest("tr").find('td:eq(0)').text());

 
    opcion = 3 ;//borrar

    eliminarAntesPlanUsuario1(idUsu,opcion);
  
});
    

 

function eliminarAntesPlanUsuario1(idUsu,opcion) {

  

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

    eliminarAntesPlanUsuario12(idUsu,opcion);
  }
})



      
     
}


function  eliminarAntesPlanUsuario12(idUsu,opcion){


    var respuesta = confirm("¿Está seguro de eliminar este registro?");
    if(respuesta){
        
        $.ajax({
            url: "bd/crud_datos_Plan_UsuarioaUXI.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, idUsu:idUsu},
            success: function(){
            



               
            }
        });

        tablaUsuarioAUXI.row(fila.parents('tr')).remove().draw();

    } 
}




$("#formPersonasUsuarioAUXPR").submit(function(e){
    e.preventDefault();    
 
    nombre= $.trim($("#nombre").val());
    dni= $.trim($("#dni").val());
    usuario= $.trim($("#usuario").val());
    pass= $.trim($("#pass").val());
    cargo= $.trim($("#cargo").val());
    nivelCurso= $.trim($("#nivelCurso").val());
    operacion= $.trim($("#operacion").val());
   
    cursoSEl= $.trim($("#cursoSEl").html());
   

    if (nivelCurso=='') {

        nivelCurso=cursoSEl;

    }



       $.ajax({
        url: "bd/crud_datos_Plan_UsuarioaUXI.php",
        type: "POST",
        dataType: "json",
        data: {operacion:operacion, cargo:cargo, nivelCurso:nivelCurso, nombre:nombre, dni:dni, usuario:usuario, pass:pass, opcion:opcion, idUsu:idUsu},
        success: function(data){  
            console.log(data);

            idUsu = data[0].idUsu;            
            nombre = data[0].nombre;
            dni = data[0].dni;
            usuario = data[0].usuario;
            pass = data[0].pass;
            cargo = data[0].cargo;
            nivelCurso = data[0].nivelCurso;
            operacion = data[0].operacion;


            password=atob(pass);
            
            if(opcion == 1){tablaUsuarioAUXI.row.add([idUsu,nombre,dni,usuario,password,cargo,nivelCurso,operacion]).draw();}
            else{tablaUsuarioAUXI.row(fila).data([idUsu,nombre,dni,usuario,password,cargo,nivelCurso,operacion]).draw();}            
        }        
    });
    $("#modalCRUD_UsuarioAUXREG").modal("hide");    
    
});
    




    
});


</script>
