
<!--INICIO del cont principal-->
<div class="container">

 <?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();


if ((isset($_SESSION['cursoSele'])) && (isset($_SESSION['planSeleC']))){
$cursoSele=$_SESSION['cursoSele'];
$planSeleC=$_SESSION['planSeleC'];
$cicloLectivo=$_SESSION['cicloLectivo'];



 
$consulta = "SELECT `idCurso`, `idPlan`, `ciclo`, `nombre` FROM `curso_$cicloLectivo` WHERE `ciclo`='$cursoSele' AND `idPlan`='$planSeleC'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


?>




<div class="container">
    <div class="row">
        <div class="col-lg-12 p-2">
                     <h1>Tabla de Cursos del Plan de Estudio</h1>
                     <p><b>Aclaración:</b>Los cursos corresponden al 3ro,  4to, 5to (y más) corresponde al Planes de estudios seleccionado...</p>
                </div>
        <div class="col-lg-12 p-2">
            <button id="btnNuevo_Cursos" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>
        </div>
    </div>
</div>



 
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaCursos" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>N°Curso</th> 
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
                              
                                <td><?php echo $dat['idCurso'] ?></td>
                                <td><?php echo $dat['idPlan'] ?></td>
                                <td><?php echo $dat['ciclo'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td> 
                    
           
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
<div class="modal fade" id="modalCRUD_Cursos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonasCursos">    
                         
            <div class="modal-body">
                

                <div class="form-group">
                <label for="cursosNombre" class="col-form-label">Normbre Curso:</label>
                <input type="text" class="form-control" id="cursosNombre">
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


    var tablaCursos = $('#tablaCursos').DataTable({ 

    "destroy":true,
    "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<button class='btn btn-primary btnEditar_Cursos'>Editar</button><button class='btn btn-danger btnBorrar_Asignnatura'>Borrar</button>"  
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




$("#btnNuevo_Cursos").click(function(){

    $("#formPersonasCursos").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Curso");            
    $("#modalCRUD_Cursos").modal("show"); 

    idCurso=null;
    opcion = 1; //alta
}); 



var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar_Cursos", function(){
    fila = $(this).closest("tr");

 
    idCurso = parseInt(fila.find('td:eq(0)').text());
    idPlan = fila.find('td:eq(1)').text();
    ciclo = fila.find('td:eq(2)').text();
    nombre = fila.find('td:eq(3)').text();

    
    $("#cursosNombre").val(nombre);



    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar nombre del Curso");            
    $("#modalCRUD_Cursos").modal("show");  
    
});

//botón BORRAR
//botón BORRAR
$(document).on("click", ".btnBorrar_Asignnatura", function(){    
    fila = $(this);
    idCurso = parseInt($(this).closest("tr").find('td:eq(0)').text());

    console.log(fila);
    nombre = $(this).closest("tr").find('td:eq(3)').text();

    opcion = 3 ;//borrar

    eliminarAntesPlanCurso(idCurso,nombre,opcion);
  
});
    




function eliminarAntesPlanCurso(idCurso,nombre,opcion) {

  

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

    eliminarAntesPlanCursoFinal(idCurso,nombre,opcion);
  }
})



      
     
}


function  eliminarAntesPlanCursoFinal(idCurso,nombre,opcion){


    var respuesta = confirm("¿Está seguro de eliminar la asignatura: "+nombre+"?");
    if(respuesta){
        
        $.ajax({
            url: "bd/crud_datos_Plan_Cursos.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, idCurso:idCurso},
            success: function(){
            
               
            }
        });

        tablaCursos.row(fila.parents('tr')).remove().draw();

    } 
}




$("#formPersonasCursos").submit(function(e){
    e.preventDefault();    
 
    idPlan = $.trim($("#planSeleC").val());
    nombre = $.trim($("#cursosNombre").val());
    ciclo = $.trim($("#cursoSele").val());
    

    console.log({idPlan:idPlan, nombre:nombre,  opcion:opcion, idCurso:idCurso, ciclo:ciclo});
    $.ajax({
        url: "bd/crud_datos_Plan_Cursos.php",
        type: "POST",
        dataType: "json",
        data: {idPlan:idPlan, nombre:nombre,  opcion:opcion, idCurso:idCurso, ciclo:ciclo},
        success: function(data){  
            console.log(data);
            idCurso = data[0].idCurso;            
            idPlan = data[0].idPlan;
            nombre = data[0].nombre;
            ciclo = data[0].ciclo;
       
            
            if(opcion == 1){tablaCursos.row.add([idCurso,idPlan,ciclo,nombre]).draw();}
            else{tablaCursos.row(fila).data([idCurso,idPlan,ciclo,nombre]).draw();}            
        }        
    });
    $("#modalCRUD_Cursos").modal("hide");    
    
});    
    

    
});

</script>




<?php  } ?>



