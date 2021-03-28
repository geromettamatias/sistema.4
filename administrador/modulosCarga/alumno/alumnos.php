<?php
        include_once '../../bd/conexion.php';
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        session_start();

            $consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor` FROM `datosalumnos`";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 p-2">
            <h1>Tabla de Registro de Alumno</h1>
            <p><b>Aclaración:</b>Al finalizar controlo todo los datos registrados...</p>
        </div>
        <div class="col-lg-12 p-2">
            <button id="btnNuevo_Alumno" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>
        </div>
    </div>
</div>



<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">        
                <table id="tablaAlumnoNuevo" class="table table-striped table-bordered table-condensed" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th>N°</th> 
                            <th>DNI</th>
                            <th>Apellido y Nombre</th> 
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php                            
                    foreach($data as $dat) {                                ?>
                        <tr>
                            <td><?php echo $dat['idAlumnos'] ?></td>
                            <td><?php echo $dat['dniAlumnos'] ?></td>
                            <td><?php echo $dat['nombreAlumnos'] ?></td>
                            <td></td>
                        </tr>
                    <?php   }  ?>                                
                    </tbody>        
                </table>                    
            </div>
        </div>
    </div>  
</div>    
      

        

<div class="modal fade" id="modalCRUD_Alumno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formPersonasAlumno">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombreAlumnos2" class="col-form-label">Normbre y Apellido:</label>
                        <input type="text" class="form-control" id="nombreAlumnos2">
                    </div>
                    <div class="form-group">
                        <label for="dniAlumnos2" class="col-form-label">DNI:</label>
                        <input type="text" class="form-control" id="dniAlumnos2">
                    </div>
                    <div class="form-group">
                        <label for="cuilAlumnos2" class="col-form-label">CUIL:</label>
                        <input type="text" class="form-control" id="cuilAlumnos2">
                    </div>
                    <div class="form-group">
                        <label for="domicilioAlumnos2" class="col-form-label">Domicilio:</label>
                        <input type="text" class="form-control" id="domicilioAlumnos2">
                    </div>
                    <div class="form-group">
                        <label for="emailAlumnos2" class="col-form-label">Email:</label>
                        <input type="text" class="form-control" id="emailAlumnos2">
                    </div>
                    <div class="form-group">
                        <label for="telefonoAlumnos2" class="col-form-label">Telefono:</label>
                        <input type="text" class="form-control" id="telefonoAlumnos2">
                    </div>
                    <div class="form-group">
                        <label for="discapasidadAlumnos2" class="col-form-label">Discapasidad:</label>
                        <input type="text" class="form-control" id="discapasidadAlumnos2">
                    </div>
                    <div class="form-group">
                        <label for="nombreTutor2" class="col-form-label">Normbre y Apellido del Tutor:</label>
                        <input type="text" class="form-control" id="nombreTutor2">
                    </div>
                    <div class="form-group">
                        <label for="dniTutor2" class="col-form-label">DNI del Tutor:</label>
                        <input type="text" class="form-control" id="dniTutor2">
                    </div>
                    <div class="form-group">
                        <label for="TelefonoTutor2" class="col-form-label">Telefono del Tutor:</label>
                        <input type="text" class="form-control" id="TelefonoTutor2">
                    </div>
                    <div class="form-group">
                        <label for="idPlanEstudio" class="col-form-label">Orientación al que se inscribe:</label>
                        <select class="form-control" id="idPlanEstudio">
                             <?php

                                $c1onsulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos`";
                                $r1esultado = $conexion->prepare($c1onsulta);
                                $r1esultado->execute();
                                $d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($d1ata as $d1at) {
                                ?>
                                <option value="<?php echo $d1at['idPlan'] ?>"><?php echo $d1at['nombre'] ?></option>
                                <?php } ?>
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
$('#imagenProceso').hide();
    var tablaAlumno = $('#tablaAlumnoNuevo').DataTable({ 

          
                "destroy":true,  
                "columnDefs":[{
                   
                    "targets": -1,
                    "data":null,
                    "defaultContent": "<button class='btn btn-info btnEditar_Alumno_datos'>Datos</button><button class='btn btn-primary btnEditar_Alumno'>Editar</button><button class='btn btn-danger btnBorrar_Alumno'>Borrar</button>",
                   },],

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


    $(document).on("click", ".btnEditar_Alumno_datos", function(){
            fila = $(this).closest("tr");

         
            idAlumnos = parseInt(fila.find('td:eq(0)').text());

            $.ajax({
                url: "bd/crud_AlumnosDatosLetura.php",
                type: "POST",
                dataType: "json",
                data: {idAlumnos:idAlumnos},
                beforeSend: function() {
                    $('#imagenProceso').show();
                              },
                success: function(data){  
                
                    idAlumnos = data[0].idAlumnos;            
                    nombreAlumnos = data[0].nombreAlumnos;
                    dniAlumnos = data[0].dniAlumnos;

                    cuilAlumnos = data[0].cuilAlumnos;
                    domicilioAlumnos = data[0].domicilioAlumnos;
                    emailAlumnos = data[0].emailAlumnos;
                    telefonoAlumnos = data[0].telefonoAlumnos;
                    discapasidadAlumnos = data[0].discapasidadAlumnos;
                    nombreTutor= data[0].nombreTutor;
                    dniTutor = data[0].dniTutor;
                    TelefonoTutor = data[0].TelefonoTutor;
               
                    nombre = data[0].nombre;


                        Swal.fire({
                                title: 'Datos',
                                html:'<div class="col-12">  <div class="input-group input-group-sm mb-3"><div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-sm">Apellido y Nombre del Alumno:</span></div>'+nombreAlumnos+'</div>  <div class="input-group input-group-sm mb-3"><div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-sm">DNI del Alumno:</span></div>'+dniAlumnos+'</div>  <div class="input-group input-group-sm mb-3"><div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-sm">Cuil:</span></div>'+cuilAlumnos+'</div>  <div class="input-group input-group-sm mb-3"><div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-sm">Domicilio:</span></div>'+domicilioAlumnos+'</div> <div class="input-group input-group-sm mb-3"><div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-sm">Email del Alumno:</span></div>'+emailAlumnos+'</div><div class="input-group input-group-sm mb-3"><div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-sm">Telefono del Alumno:</span></div>'+telefonoAlumnos+'</div><div class="input-group input-group-sm mb-3"><div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-sm">Discapasidad del Alumno:</span></div>'+discapasidadAlumnos+'</div><div class="input-group input-group-sm mb-3"><div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-sm">Apellido y Nombre del Tutor:</span></div>'+nombreTutor+'</div><div class="input-group input-group-sm mb-3"><div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-sm">DNI del Tutor:</span></div>'+dniTutor+'</div><div class="input-group input-group-sm mb-3"><div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-sm">Telefono del Tutor:</span></div>'+TelefonoTutor+'</div><div class="input-group input-group-sm mb-3"><div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-sm">ID Plan:</span></div>'+nombre+'</div></div>', 
                                focusConfirm: false,
                                showCancelButton: true,                         
                                }).then((result) => {
                              
                          }); 
                       
                   $('#imagenProceso').hide();          
                      
        }        
    });
  
});

// 


$("#btnNuevo_Alumno").click(function(){

    $("#formPersonasAlumno").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Ingresar datos del alumno y tutor");            
    $("#modalCRUD_Alumno").modal("show"); 

    idAlumnos=null;
    opcion = 1; //alta
}); 



var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar_Alumno", function(){
    fila = $(this).closest("tr");

 
    idAlumnos = parseInt(fila.find('td:eq(0)').text());

    $.ajax({
        url: "bd/crud_AlumnosDatosLetura.php",
        type: "POST",
        dataType: "json",
        data: {idAlumnos:idAlumnos},
        beforeSend: function() {
            $('#imagenProceso').show();
                              },
        success: function(data){  

            idAlumnos = data[0].idAlumnos;            
            nombreAlumnos = data[0].nombreAlumnos;
            dniAlumnos = data[0].dniAlumnos;

            cuilAlumnos = data[0].cuilAlumnos;
            domicilioAlumnos = data[0].domicilioAlumnos;
            emailAlumnos = data[0].emailAlumnos;
            telefonoAlumnos = data[0].telefonoAlumnos;
            discapasidadAlumnos = data[0].discapasidadAlumnos;
            nombreTutor= data[0].nombreTutor;
            dniTutor = data[0].dniTutor;
            TelefonoTutor = data[0].TelefonoTutor;
            idPlanEstudio = data[0].idPlanEstudio;

            $("#nombreAlumnos2").val(nombreAlumnos);
            $("#dniAlumnos2").val(dniAlumnos);
            $("#cuilAlumnos2").val(cuilAlumnos);
            $("#domicilioAlumnos2").val(domicilioAlumnos);
            $("#emailAlumnos2").val(emailAlumnos);
            $("#telefonoAlumnos2").val(telefonoAlumnos);
            $("#discapasidadAlumnos2").val(discapasidadAlumnos);
            
            $("#nombreTutor2").val(nombreTutor);
            $("#dniTutor2").val(dniTutor);
            $("#TelefonoTutor2").val(TelefonoTutor);

          
            $("#idPlanEstudio").val(idPlanEstudio);
            $('#imagenProceso').hide();  
        }        
    });



    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar datos del alumno y tutor");            
    $("#modalCRUD_Alumno").modal("show");  
    
});

//botón BORRAR
//botón BORRAR
$(document).on("click", ".btnBorrar_Alumno", function(){    
    fila = $(this);
    idAlumnos = parseInt($(this).closest("tr").find('td:eq(0)').text());
 

    opcion = 3 ;//borrar

    eliminarAntesPlanAlumno(idAlumnos,opcion);
  
});
    




function eliminarAntesPlanAlumno(idAlumnos,opcion) {

  

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

    eliminarAntesPlanAlumnoFinal(idAlumnos,opcion);
  }
})



      
     
}


function  eliminarAntesPlanAlumnoFinal(idAlumnos,opcion){

        $.ajax({
            url: "bd/crud_datos_Plan_Alumnos.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, idAlumnos:idAlumnos},
            beforeSend: function() {
            $('#imagenProceso').show();
                              },
            success: function(){
                
               
            }
        });

        tablaAlumno.row(fila.parents('tr')).remove().draw();

        idPlanEstudio='';
        $('#imagenProceso').hide();

     
}




$("#formPersonasAlumno").submit(function(e){
    e.preventDefault();    
 
    nombreAlumnos = $.trim($("#nombreAlumnos2").val());
    dniAlumnos = $.trim($("#dniAlumnos2").val());
    cuilAlumnos = $.trim($("#cuilAlumnos2").val());
    domicilioAlumnos = $.trim($("#domicilioAlumnos2").val());
    emailAlumnos = $.trim($("#emailAlumnos2").val());
    telefonoAlumnos = $.trim($("#telefonoAlumnos2").val());
    discapasidadAlumnos = $.trim($("#discapasidadAlumnos2").val());
   
    nombreTutor = $.trim($("#nombreTutor2").val());
    dniTutor = $.trim($("#dniTutor2").val());
    TelefonoTutor = $.trim($("#TelefonoTutor2").val());
    idPlanEstudio = $.trim($("#idPlanEstudio").val());

   

    $.ajax({
        
        url: "bd/crud_datos_Plan_Alumnos.php",
        type: "POST",
        dataType: "json",
        data: {nombreAlumnos:nombreAlumnos, dniAlumnos:dniAlumnos, cuilAlumnos:cuilAlumnos, domicilioAlumnos:domicilioAlumnos, emailAlumnos:emailAlumnos, telefonoAlumnos:telefonoAlumnos, discapasidadAlumnos:discapasidadAlumnos, nombreTutor:nombreTutor, dniTutor:dniTutor, TelefonoTutor:TelefonoTutor,  opcion:opcion, idAlumnos:idAlumnos, idPlanEstudio:idPlanEstudio},
        beforeSend: function() {
            $('#imagenProceso').show();
                              },
        success: function(data){  
          
            idAlumnos = data[0].idAlumnos;            
            nombreAlumnos = data[0].nombreAlumnos;
            dniAlumnos = data[0].dniAlumnos;
            idPlanEstudio = data[0].idPlanEstudio;
            if(opcion == 1){tablaAlumno.row.add([idAlumnos,dniAlumnos,nombreAlumnos]).draw();}
            else{tablaAlumno.row(fila).data([idAlumnos,dniAlumnos,nombreAlumnos]).draw();} 
             $('#imagenProceso').hide();
            
        }        
    });
    $("#modalCRUD_Alumno").modal("hide");    
    
});    
    

    
});



</script>

