 <?php
        include_once '../../bd/conexion.php';
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();

        $consulta = "SELECT `idInstitucion`, `nombre`, `cue`, `domicilio`, `tel`, `email` FROM `institucion_datos`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="container">
        <div class="row">
            <div class="col-lg-12 p-2">            
            <h1>Carga de datos Institucional</h1>    
            </div>
            <div class="col-lg-12 p-2">            
            <button id="btnNuevo_Institucional" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
</div>    
      
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tabla_Institucional" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>CUE</th>
                                <th>Domicilio</th> 
                                <th>Tele</th> 
                                <th>Email</th>                                 

                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['idInstitucion'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['cue'] ?></td>
                                <td><?php echo $dat['domicilio'] ?></td>
                                <td><?php echo $dat['tel'] ?></td>
                                <td><?php echo $dat['email'] ?>
                                    
                                    
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
<div class="modal fade" id="modalCRUD_Institucion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas">    
            <div class="modal-body">
                <div class="form-group">
                <label for="nombreI" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombreI">
                </div>
                <div class="form-group">
                <label for="cue" class="col-form-label">CUE:</label>
                <input type="text" class="form-control" id="cue">
                </div>                
                <div class="form-group">
                <label for="domicilio" class="col-form-label">Domicilio:</label>
                <input type="text" class="form-control" id="domicilio">
                </div>
                <div class="form-group">
                <label for="tel" class="col-form-label">Telefono:</label>
                <input type="text" class="form-control" id="tel">
                </div>
                <div class="form-group">
                <label for="email" class="col-form-label">Email:</label>
                <input type="text" class="form-control" id="email">
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
    var tablaInstitucional = $('#tabla_Institucional').DataTable({ 

    "destroy":true,    
    "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar_Institucional'>Editar</button><button class='btn btn-danger btnBorrar_Institucional'>Borrar</button></div></div>"  
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












$("#btnNuevo_Institucional").click(function(){
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Carga de Datos Intitucional");            
    $("#modalCRUD_Institucion").modal("show");        
    idInstitucion=null;
    opcion = 1; //alta
}); 



var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar_Institucional", function(){
    fila = $(this).closest("tr");

    

    idInstitucion = parseInt(fila.find('td:eq(0)').text());
    nombreI = fila.find('td:eq(1)').text();
    cue = fila.find('td:eq(2)').text();
    domicilio = fila.find('td:eq(3)').text();
    tel = fila.find('td:eq(4)').text();
    email = fila.find('td:eq(5)').text();

  


    
    $("#nombreI").val(nombreI);
    $("#cue").val(cue);
    $("#domicilio").val(domicilio);
    $("#tel").val(tel);
    $("#email").val(email);


    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Datos de la Institución");            
    $("#modalCRUD_Institucion").modal("show");  
    
});

//botón BORRAR
//botón BORRAR
$(document).on("click", ".btnBorrar_Institucional", function(){    
    fila = $(this);
    idInstitucion = parseInt($(this).closest("tr").find('td:eq(0)').text());


    nombre = $(this).closest("tr").find('td:eq(1)').text();
    cue = $(this).closest("tr").find('td:eq(2)').text();

    opcion = 3 ;//borrar

    eliminarAntes(idInstitucion,nombre,cue,opcion);
  
});
    







function eliminarAntes(idInstitucion,nombre,cue,opcion) {

  

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

    eliminarDefinitivo(idInstitucion,nombre,cue,opcion);
  }
})



      
     
}


function  eliminarDefinitivo(idInstitucion,nombre,cue,opcion){
 
        $.ajax({
            url: "bd/crud_datos_Institucional.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, idInstitucion:idInstitucion},
            success: function(){
            
               
            }
        });

        tablaInstitucional.row(fila.parents('tr')).remove().draw();

    
}













$("#formPersonas").submit(function(e){
    e.preventDefault();    
    nombre = $.trim($("#nombreI").val());
    cue = $.trim($("#cue").val());
    domicilio = $.trim($("#domicilio").val());   
    tel = $.trim($("#tel").val());   
    email = $.trim($("#email").val());   

    $.ajax({
        url: "bd/crud_datos_Institucional.php",
        type: "POST",
        dataType: "json",
        data: {nombre:nombre, cue:cue, domicilio:domicilio, tel:tel, email:email, idInstitucion:idInstitucion, opcion:opcion},
        success: function(data){  
            console.log(data);
            idInstitucion = data[0].idInstitucion;            
            nombre = data[0].nombre;
            cue = data[0].cue;
            domicilio = data[0].domicilio;
            tel = data[0].tel;
            email = data[0].email;
            if(opcion == 1){tablaInstitucional.row.add([idInstitucion,nombre,cue,domicilio,tel,email]).draw();}
            else{tablaInstitucional.row(fila).data([idInstitucion,nombre,cue,domicilio,tel,email]).draw();}            
        }        
    });
    $("#modalCRUD_Institucion").modal("hide");    
    
});    
    
});

</script>