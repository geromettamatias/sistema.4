
<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();


if (isset($_SESSION['id_docente_Asistencia'])){
$id_docente_Asistencia=$_SESSION['id_docente_Asistencia'];

$cicloLectivo=$_SESSION['cicloLectivo'];

 
$consulta = "SELECT `dni`, `nombre` FROM `datos_docentes` WHERE `idDocente`='$id_docente_Asistencia'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

                                foreach($data as $dat) {
                                   
                                    $nombre=$dat['nombre'];
                                    $dni=$dat['dni'];
                                      }



                             
                        



              
  
                            ?>  

<input type="text" hidden=""  id="id_Docente" value="<?php echo $id_docente_Asistencia; ?>">


<div class="container">
    <div class="row">
        <div class="col-lg-12 p-2">
            <button type="button" class="btn btn-outline-warning btn-block" id="asistenciaDocenteRegresar">PLANILLA DE INACISTENCIA <span class="badge badge-light"> Regresar </span></button>
        </div>
        <div class="col-lg-12 p-2">
            <h2>INASISTENCIA DE LOS DOCENTES  -  CICLO <?php echo $cicloLectivo; ?></h2>
        </div>
        <div class="col-lg-12 p-2">
            <div id="datos"><h5>APELLIDO Y NOMBRE: <?php echo $nombre; ?>; DNI:<?php echo $dni; ?></h5></div>
        </div>

        <div class="col-lg-12 p-2">
                    <button id="btnNuevo_Asistencia_docente_imprimir" type="button" class="btn btn-outline-info btn-block" data-toggle="modal">IMPRIMIR</button>
                   
                    
                </div>

        <div class="col-lg-12 p-2">
            <button id="btnNuevo_Asistencia_Docente" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>
        </div>

    </div>
</div>


                  
<div class="container">
    <div class="row">
        <div class="col-lg-12 p-2">
            <div class="table-responsive">
                <table id="asistenciaDocenteFinalParte" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>CURSO</th>
                                <th>ASIGNATURA</th>
                                <th>FECHA</th>
                                <th>CANTIDAD</th> 
                                <th>JUSTIFICO</th>
                                <th>BOTON</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            
                        

                            $consulta = "SELECT `asistenciadocente_$cicloLectivo`.`id_Asistencia`, `curso_$cicloLectivo`.`nombre` AS 'nombreCurso', `plan_datos_asignaturas`.`nombre`, `asistenciadocente_$cicloLectivo`.`fecha`, `asistenciadocente_$cicloLectivo`.`cantidad`, `asistenciadocente_$cicloLectivo`.`justificado` FROM `asistenciadocente_$cicloLectivo` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `asistenciadocente_$cicloLectivo`.`idCurso` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `asistenciadocente_$cicloLectivo`.`idAsignatura` WHERE `asistenciadocente_$cicloLectivo`.`idDocente` = '$id_docente_Asistencia'";       
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                            foreach($data as $dat) { 

                            $id_Asistencia=$dat['id_Asistencia'];
                            $nombreCurso=$dat['nombreCurso'];
                            $nombreAsign=$dat['nombre'];
                           
                            $fecha=$dat['fecha'];
                            $cantidad=$dat['cantidad'];
                            $justificado=$dat['justificado'];
                                                                                  
                            ?>
                            <tr>
                              
                                <td><?php echo $id_Asistencia ?></td>
                                <td><?php echo $nombreCurso ?></td>
                                <td><?php echo $nombreAsign ?></td>
                                <td><?php echo $fecha ?></td>
                                <td><?php echo $cantidad ?></td>
                                <td><?php echo $justificado ?></td>
                                 
                    
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
<div class="modal fade" id="modalCRUD_asistencia_Docente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonasAsistenciaDocente">    
                         
            <div class="modal-body">
                
            	 <input type="text" hidden="" class="form-control" id="id">

     
                <div class="form-group">
                      <label for="cursoAsignatura" class="col-form-label">CURSO Y ASIGNATURA:</label>
                      <select class="form-control" id="cursoAsignatura">
                          <option value="0">Seleccione Curso-Asignatura</option>
                           <?php
                     
                          $consulta = "SELECT `curso_$cicloLectivo`.`nombre` AS 'nombreCurso', `plan_datos_asignaturas`.`nombre`, `asignacion_asignatura_docente_$cicloLectivo`.`idAsig` FROM `asignacion_asignatura_docente_$cicloLectivo` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `asignacion_asignatura_docente_$cicloLectivo`.`idCurso` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `asignacion_asignatura_docente_$cicloLectivo`.`idAsignatura` WHERE `asignacion_asignatura_docente_$cicloLectivo`.`idDocente` = '$id_docente_Asistencia'";
                          $resultado = $conexion->prepare($consulta);
                          $resultado->execute();
                          $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                          foreach($dat1a as $da1t) { 
                            $nombreCurso=$da1t['nombreCurso'];
                            $nombreAsig=$da1t['nombre'];
                            $idAsig=$da1t['idAsig'];

                            ?>
                            <option value="<?php echo $idAsig ?>"><?php echo $nombreCurso.'--'.$nombreAsig ?></option>
                            <?php } ?>

                            
                        </select>
                </div>
 

            	
                <div class="form-group">
                <label for="fecha_Docente" class="col-form-label">FECHA:</label>
                <input type="date" class="form-control" id="fecha_Docente">
                </div>
                <div class="form-group">
                <label for="cantidad_Docente" class="col-form-label">CANTIDAD:</label>
                
                <select class="form-control" id="cantidad_Docente">
                          <option>1-HC</option>
                          <option>2-HC</option>
                          <option>3-HC</option>
                          <option>4-HC</option>
                          <option>5-HC</option>
                          <option>6-HC</option>
                          <option>CARGO</option>
                </select>
                </div> 
                <div class="form-group">
                <label for="justifico_Docente" class="col-form-label">JUSTIFICO:</label>
                <select class="form-control" id="justifico_Docente">
                          <option>NO</option>
                          <option>SI</option>
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


 <script type="text/javascript">
$(document).ready(function(){


datosF3=$("#id_Docente").val();

datos=$("#datos").html();




asistenciaDocenteF(datos,datosF3);
    });




      $("#asistenciaDocenteRegresar").click(function(){
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('asistencias/asistenciaDocente.php');
        $('#buscarTablaInstitucional').show();
        
    });





$(document).on("click", "#btnNuevo_Asistencia_docente_imprimir", function(e){

e.preventDefault(); 
 
   window.open('asistencias/asistenciaDocenteImprimir.php', '_blank'); 

    

});








$("#btnNuevo_Asistencia_Docente").click(function(){

    $("#formPersonasAsistenciaDocente").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva INASISTENCIA");            
    $("#modalCRUD_asistencia_Docente").modal("show"); 

    id=null;

    opcion = 1; //alta
}); 



 var fila; //capturar la fila para editar o borrar el registro
    
//botón AISTENCIA    
$(document).on("click", ".btnEditar_Docente_datos_Tabla", function(){
    fila = $(this).closest("tr");

 
    id = parseInt(fila.find('td:eq(0)').text());

        $.ajax({
          type:"post",
          data:'id=' + id,
          url:'bd/crud_Asistencia_Docente_Editar.php',
          success:function(r){
            console.log(r)
            data=r.split('||');


            idF = data[0];            
            idAsig = data[1];
            fecha = data[2];
            cantidad = data[3];
            justificado = data[4];
            
       

            $("#id").val(idF);
            $("#cursoAsignatura").val(idAsig);
            $("#fecha_Docente").val(fecha);
            $("#cantidad_Docente").val(cantidad);
            $("#justifico_Docente").val(justificado);
          


          
          }
        });
  
    
    

  


    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Inacistencia");            
    $("#modalCRUD_asistencia_Docente").modal("show");  

    
});


  
$(document).on("click", ".btnBorrar_Docente_tabla", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());

    opcion = 3 ;//borrar

    eliminarAsistenciaDocente(id,opcion,fila);
  
});





$("#formPersonasAsistenciaDocente").submit(function(e){
    e.preventDefault();    
 

 	id = $("#id").val();
    id_Docente = $("#id_Docente").val();
    fecha_Docente = $.trim($("#fecha_Docente").val());
    cantidad_Docente = $.trim($("#cantidad_Docente").val());
    justifico_Docente = $.trim($("#justifico_Docente").val());
    cursoAsignatura = $.trim($("#cursoAsignatura").val());
    
   if (fecha_Docente!='' && cantidad_Docente!='' && justifico_Docente!='' && cursoAsignatura!='0') {



    $.ajax({
        url: "bd/crud_Asistencia_Docente.php",
        type: "POST",
        dataType: "json",
        data: {id:id, id_Docente:id_Docente, fecha_Docente:fecha_Docente, cantidad_Docente:cantidad_Docente,  justifico_Docente:justifico_Docente, cursoAsignatura:cursoAsignatura, opcion:opcion},
        success: function(data){  
         
            id_Asistencia = data[0].id_Asistencia;            
            nombreCurso = data[0].nombreCurso;
            nombreAsignatura = data[0].nombreAsignatura;
            fecha = data[0].fecha;
            cantidad = data[0].cantidad;
            justificado = data[0].justificado;
            observacion = data[0].observacion;
       		

            if(opcion == 1){asistenciaDocenteFinalParte.row.add([id_Asistencia,nombreCurso,nombreAsignatura,fecha,cantidad,justificado]).draw();}
            else{

           
            	asistenciaDocenteFinalParte.row(fila).data([id_Asistencia,nombreCurso,nombreAsignatura,fecha,cantidad,justificado]).draw();}             
        }        
    });
    $("#modalCRUD_asistencia_Docente").modal("hide");

    }else{

        Swal.fire({
                  icon: 'error',
                  title: 'LOS CAMPOS ESTAN INCOMPLETOS O BASIOS',
                  text: 'Controle cada campo',
                  footer: '<a href>Why do I have this issue?</a>'
                })
    }    
    
});    
    






function eliminarAsistenciaDocente(id,opcion,fila) {

  

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

    eliminarAsistenciaDocenteFinal(id,opcion,fila);
  }
})



      
     
}


function   eliminarAsistenciaDocenteFinal(id,opcion,fila){


    	$.ajax({
            url: "bd/crud_Asistencia_Docente.php",
            type: "POST",
            dataType: "json",
            data: {id:id, opcion:opcion},
            success: function(){
            
               
            }
        });
        
 

        asistenciaDocenteFinalParte.row(fila.parents('tr')).remove().draw();

}


function asistenciaDocenteF(datos,datosF3) {
	 asistenciaDocenteFinalParte=$('#asistenciaDocenteFinalParte').DataTable({ 


     "destroy":true,
  
       


    "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent":  "<button class='btn btn-primary btnEditar_Docente_datos_Tabla'>Editar</button><button class='btn btn-danger btnBorrar_Docente_tabla'>Borrar</button>"  
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
        messageTop:'PLANILLA DE INASISTENCIA DE  DE '+datos, //Coloca el título dentro del excel
        className: 'btn btn-success'
      },
      {
        extend:    'pdfHtml5',
        text:      '<i class="fas fa-file-pdf"></i> ',
        titleAttr: 'Exportar a PDF',
        messageTop:'PLANILLA DE INASISTENCIA DE  DE '+datos, //Coloca el título dentro del pdf
        className: 'btn btn-danger'
      },
      {
        extend:    'print',
        text:      '<i class="fa fa-print"></i> ',
        titleAttr: 'Imprimir',
        messageTop: '<h2>PLANILLA DE INASISTENCIA DE </h2>'+datos+'', //Coloca el título dentro del imprimir
        className: 'btn btn-info'
      },
    ] 

}); 


}



</script>

<?php  } ?>



