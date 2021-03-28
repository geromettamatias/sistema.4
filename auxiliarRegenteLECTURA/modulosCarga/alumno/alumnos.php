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
      

        

<script type="text/javascript">
$(document).ready(function(){

    $('#imagenProceso').hide();
    var tablaAlumno = $('#tablaAlumnoNuevo').DataTable({ 

          
                "destroy":true,  
                "columnDefs":[{
                   
                    "targets": -1,
                    "data":null,
                    "defaultContent": "<button class='btn btn-info btnEditar_Alumno_datos'>Datos</button>",
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

    
});



</script>

