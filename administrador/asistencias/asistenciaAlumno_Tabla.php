
<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();



if (isset($_SESSION['id_Alumno_Asistencia'])){
$id_Alumno_Asistencia=$_SESSION['id_Alumno_Asistencia'];

$cicloLectivo=$_SESSION['cicloLectivo'];




 
$consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor` FROM `datosalumnos` WHERE `idAlumnos`='$id_Alumno_Asistencia'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

                                foreach($data as $dat) {
                                    $nombreAlumnos=$dat['nombreAlumnos'];
                                    $dniAlumnos=$dat['dniAlumnos'];
                                      }



        $consulta = "SELECT `id_Asistencia`, `idAlumno`, `fecha`, `cantidad`, `justificado`, `observacion`, `encabezado` FROM `asistenciaalumno_$cicloLectivo` WHERE `idAlumno`='$id_Alumno_Asistencia'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  



                           
                        



              
  
                            ?>  

<input type="text" hidden=""  id="id_alumno" value="<?php echo $id_Alumno_Asistencia; ?>">


<div class="container">
        <div class="row">
                <div class="col-lg-12">

                     <div class="container">
        <div class="row">
                <div class="col-lg-12">

                        <button type="button" class="btn btn-outline-warning btn-block" id="asistenciaAlumnoRegresar">PLANILLA DE INACISTENCIA <span class="badge badge-light"> Regresar </span></button>
                    <br><br>


                    <h2>INASISTENCIA DE LOS ALUMNOS- CICLO <?php echo $cicloLectivo; ?></h2><br>
                    <div id="datos"><h5>APELLIDO Y NOMBRE: <?php echo $nombreAlumnos; ?>; DNI:<?php echo $dniAlumnos; ?></h5></div>
                   
                    
                </div>
                <div class="col-lg-12 p-2">
                    <button id="btnNuevo_Asistencia_Alumno_imprimir" type="button" class="btn btn-outline-info btn-block" data-toggle="modal">IMPRIMIR</button>
                   
                    
                </div>

                <div class="col-lg-12 p-2">
                    <button id="btnNuevo_Asistencia_Alumno" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>
                   
                    
                </div>


                  

  
      
        </div>
</div>


                    <div class="table-responsive">        
                
                             <table id="asistenciaAlumnoFinalParte" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>ID</th>
                                <th>FECHA</th>
                                <th>CANTIDAD</th> 
                                <th>JUSTIFICO</th>
                                <th>OBSERV.</th>
                                <th>ENCABEZADO</th>
                                <th>BOTON</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            
                             foreach($data as $dat) {

                            $id_Asistencia=$dat['id_Asistencia'];
                            $idAlumno=$dat['idAlumno'];
                            $fecha=$dat['fecha'];
                            $cantidad=$dat['cantidad'];
                            $justificado=$dat['justificado'];
                            $observacion=$dat['observacion'];
                            $encabezado=$dat['encabezado'];
                                                                                
                            ?>
                            <tr>
                              
                                <td><?php echo $id_Asistencia ?></td>
                                <td><?php echo $fecha ?></td>
                                <td><?php echo $cantidad ?></td>
                                <td><?php echo $justificado ?></td>
                                <td><?php echo $observacion ?></td>
                                <td><?php echo $encabezado ?></td>  
                    
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
<div class="modal fade" id="modalCRUD_asistencia_Alumno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonasAsistenciaAlumno">    
                         
            <div class="modal-body">
                
            	 <input type="text" hidden="" class="form-control" id="id">
            	
                <div class="form-group">
                <label for="fecha_Alumno" class="col-form-label">FECHA:</label>
                <input type="date" class="form-control" id="fecha_Alumno">
                </div>
                <div class="form-group">
                <label for="cantidad_Alumno" class="col-form-label">CANTIDAD:</label>
             
                <select class="form-control" id="cantidad_Alumno">
                          <option>1</option>
                          <option>0,5</option>
                          <option>0,25</option>
                         
                </select>

                </div> 
                <div class="form-group">
                <label for="justifico_Alumno" class="col-form-label">JUSTIFICO:</label>
                
                <select class="form-control" id="justifico_Alumno">
                          <option>NO</option>
                          <option>SI</option>
                </select>
                </div>

                 <div class="form-group">
                      <label for="encabezado" class="col-form-label">CURSO Y ASIGNATURA:</label>
                      <select class="form-control" id="encabezado">
                          
                           <?php
                     
                          $consulta = "SELECT `idCabezera`, `nombre`, `descri`, `editarDocente`, `corresponde` FROM `cabezera_libreta_digital_$cicloLectivo` WHERE `corresponde`='FICHA/LIBRETA'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();

                          $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                          foreach($dat1a as $da1t) { 
                           
                            $nombreAsig=$da1t['nombre'];
                       

                            ?>
                            <option><?php echo $nombreAsig ?></option>
                            <?php } ?>

                            
                        </select>
                </div>
 

                 <div class="form-group">
                <label for="osb_Alumno" class="col-form-label">OSERBACIÓN:</label>
                
                <textarea id="osb_Alumno" class="form-control" rows="10" cols="40"></textarea>
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


datosF3=$("#id_alumno").val();

datos=$("#datos").html();




asistenciaAlumnoF(datos,datosF3);

    });

 $("#asistenciaAlumnoRegresar").click(function(){
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('asistencias/asistenciaAlumno.php');
        $('#buscarTablaInstitucional').show();
        
    });



$(document).on("click", "#btnNuevo_Asistencia_Alumno_imprimir", function(e){

e.preventDefault(); 
 
   window.open('asistencias/asistenciaAlumnoImprimir.php', '_blank'); 

    

});







$("#btnNuevo_Asistencia_Alumno").click(function(){

    $("#formPersonasAsistenciaAlumno").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva INASISTENCIA");            
    $("#modalCRUD_asistencia_Alumno").modal("show"); 

    id=null;

    opcion = 1; //alta
}); 



 var fila; //capturar la fila para editar o borrar el registro
    
//botón AISTENCIA    
$(document).on("click", ".btnEditar_Alumno_datos_Tabla", function(){
    fila = $(this).closest("tr");

 
    id = parseInt(fila.find('td:eq(0)').text());
  



        $.ajax({
        url: "bd/crud_Asistencia_Alumno_Editar.php",
        type: "POST",
        dataType: "json",
        data: {id:id},
        success: function(data){  
     
            idF = data[0].id_Asistencia;            
            idAlumno = data[0].idAlumno;
            fecha = data[0].fecha;
            cantidad = data[0].cantidad;
            justificado = data[0].justificado;
            observacion = data[0].observacion;
            encabezado= data[0].encabezado;
            $("#id").val(idF);
            $("#fecha_Alumno").val(fecha)
            $("#cantidad_Alumno").val(cantidad);
            $("#justifico_Alumno").val(justificado);
            $("#osb_Alumno").val(observacion);
            $("#encabezado").val(encabezado);


        }        
    });

  


    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Inacistencia");            
    $("#modalCRUD_asistencia_Alumno").modal("show");  

    
});


  
$(document).on("click", ".btnBorrar_Alumno_tabla", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());

    opcion = 3 ;//borrar

    eliminarAsistenciaAlumno(id,opcion,fila);
  
});





$("#formPersonasAsistenciaAlumno").submit(function(e){
    e.preventDefault();    
 

 	id = $("#id").val();
    id_alumnos = $("#id_alumno").val();
    fecha_Alumno = $.trim($("#fecha_Alumno").val());
    cantidad_Alumno = $.trim($("#cantidad_Alumno").val());
    justifico_Alumno = $.trim($("#justifico_Alumno").val());
    osb_Alumno = $.trim($("#osb_Alumno").val());
    encabezado = $.trim($("#encabezado").val());
    


   if (fecha_Alumno!='' && cantidad_Alumno!='' && justifico_Alumno!='' && osb_Alumno!='') {


    $.ajax({
        url: "bd/crud_Asistencia_Alumno.php",
        type: "POST",
        dataType: "json",
        data: {id:id, id_alumnos:id_alumnos, fecha_Alumno:fecha_Alumno, cantidad_Alumno:cantidad_Alumno,  justifico_Alumno:justifico_Alumno, osb_Alumno:osb_Alumno, opcion:opcion, encabezado:encabezado},
        success: function(data){  
          
            id_Asistencia = data[0].id_Asistencia;            
           
            fecha = data[0].fecha;
            cantidad = data[0].cantidad;
            justificado = data[0].justificado;
            observacion = data[0].observacion;
       		encabezado = data[0].encabezado;

            if(opcion == 1){asistenciaAlumnoFinalParte.row.add([id_Asistencia,fecha,cantidad,justificado,observacion,encabezado]).draw();}
            else{

           
            	asistenciaAlumnoFinalParte.row(fila).data([id_Asistencia,fecha,cantidad,justificado,observacion,encabezado]).draw();}             
        }        
    });
    $("#modalCRUD_asistencia_Alumno").modal("hide"); 

     }else{

        Swal.fire({
                  icon: 'error',
                  title: 'LOS CAMPOS ESTAN INCOMPLETOS O BASIOS',
                  text: 'Controle cada campo',
                  footer: '<a href>Why do I have this issue?</a>'
                })
    }     
    
});    
    






function eliminarAsistenciaAlumno(id,opcion,fila) {

  

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

    eliminarAsistenciaAlumnoFinal(id,opcion,fila);
  }
})



      
     
}


function   eliminarAsistenciaAlumnoFinal(id,opcion,fila){



    	$.ajax({
            url: "bd/crud_Asistencia_Alumno.php",
            type: "POST",
            dataType: "json",
            data: {id:id, opcion:opcion},
            success: function(){
            
               
            }
        });
        
 

        asistenciaAlumnoFinalParte.row(fila.parents('tr')).remove().draw();

  
}


function asistenciaAlumnoF(datos,datosF3) {
	 asistenciaAlumnoFinalParte=$('#asistenciaAlumnoFinalParte').DataTable({ 


     "destroy":true,
  
       


    "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent":  "<button class='btn btn-primary btnEditar_Alumno_datos_Tabla'>Editar</button><button class='btn btn-danger btnBorrar_Alumno_tabla'>Borrar</button>"  
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


