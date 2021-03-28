 <form id="fromasignacion"> 

               
                
                    <div class="form-group">
                    <button type="submit" id="btnAgregar" class="btn btn-dark">AGREGAR</button>
                    </div>
</form>
 <div class="form-group">
                    <div class="table-responsive">        
                        <table id="tablaDocente_Asig" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>N°</th> 
                                <th>ASIGNATURA</th>
                                <th>CURSOS</th> 
                              

                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                             include_once '../../bd/conexion.php';
                              $objeto = new Conexion();
                              $conexion = $objeto->Conectar();

                              session_start();

                            if ((isset($_SESSION['docenteSEL']))){
                            $idDocente=$_SESSION['docenteSEL'];

                  
                            $cicloLectivoFINAL=$_SESSION['cicloLectivoFINAL'];

                            
                            $consulta = "SELECT `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idAsig`, `plan_datos_asignaturas`.`nombre`, `curso_$cicloLectivoFINAL`.`nombre` AS 'nombreCurso' FROM `asignacion_asignatura_docente_$cicloLectivoFINAL` INNER JOIN `plan_datos_asignaturas` ON `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idAsignatura` = `plan_datos_asignaturas`.`idAsig` INNER JOIN `curso_$cicloLectivoFINAL` ON `curso_$cicloLectivoFINAL`.`idCurso` = `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idCurso`WHERE `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idDocente`='$idDocente'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

                                                
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                             
                                <td><?php echo $dat['idAsig'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['nombreCurso'] ?></td>
                                
     

                                <td></td>
                            </tr>
                            <?php
                                }}
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
 <script type="text/javascript">
$(document).ready(function(){



 var tablaDocente_Asig = $('#tablaDocente_Asig').DataTable({ 

          
    "destroy":true,  
    "columnDefs":[{
       
        "targets": -1,
        "data":null,
        "defaultContent": "<button class='btn btn-danger btnBorrar_Docente_asignacion'>Borrar</button>",


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

$("#fromasignacion").submit(function(e){
    e.preventDefault();    
 
    idcursoAsig= $.trim($("#curso").val());
    idAsignaturaAsig= $.trim($("#asicCURS").val());
    cicloLectivo= $.trim($("#cicloLectivo").val());






    if (idcursoAsig==0 || idAsignaturaAsig==0) {

      Swal.fire({
                  icon: 'error',
                  title: 'LOS CAMPOS NO ESTAN SELECCIONADOS',
                  text: 'Compruebe los campos',
                  footer: '<a href>Why do I have this issue?</a>'
                })




    }else{

      opcion=1;
                    idAsig=null;
      
                  $.ajax({
                      type:"post",
                      data:'idcursoAsig=' + idcursoAsig + '&idAsignaturaAsig=' + idAsignaturaAsig + '&opcion=' + opcion + '&idAsig=' + idAsig + '&cicloLectivo=' + cicloLectivo,
                      url:'bd/crud_altaBajaAsignacion.php',
                      
                       beforeSend: function() {
                                $('#imagenProceso').show();
                                          },
                      success:function(data){

                      console.log(data);


                      res = data.split('||');

                               
                        idAsig = res[0];
                        nombre = res[1];
                        nombreCurso = res[2];
  
                    if (idAsig!='') {


                            tablaDocente_Asig.row.add([idAsig,nombre,nombreCurso]).draw();

                            $('#imagenProceso').hide();
                       

                        $("#curso").val('0');
                        $("#asicCURS").val('0');

                    }else{
                    

                     $.ajax({
                      type:"post",
                      data:'idcursoAsig=' + idcursoAsig + '&idAsignaturaAsig=' + idAsignaturaAsig + '&opcion=' + opcion + '&idAsig=' + idAsig + '&cicloLectivo=' + cicloLectivo,
                      url:'bd/crud_altaBajaAsignacion2.php',
                      
                       beforeSend: function() {
                                $('#imagenProceso').show();
                                          },
                      success:function(data){

                      
                        Swal.fire({
                                  icon: 'error',
                                  title: 'Problema',
                                  text: 'La asignatura esta asignado a profesor/a'+data,
                                  footer: '<a href>Why do I have this issue?</a>'
                                })



                                  
                             }        
                        }); 
                





                    }
                                  
                    }        
                }); 
                


    }
});    


$(document).on("click", ".btnBorrar_Docente_asignacion", function(){    
    fila = $(this);
    idAsig = parseInt($(this).closest("tr").find('td:eq(0)').text());
    
     cicloLectivo= $.trim($("#cicloLectivo").val());


    opcion = 2 ;//borrar

    eliminarAntesPlanDocenteAsig(idAsig,opcion,cicloLectivo);
  
});
    




function eliminarAntesPlanDocenteAsig(idAsig,opcion,cicloLectivo) {

  

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

    eliminarAntesPlanDocenteAsigFINAL(idAsig,opcion,cicloLectivo);
  }
})



      
     
}


function  eliminarAntesPlanDocenteAsigFINAL(idAsig,opcion,cicloLectivo){


        
        $.ajax({
            url: "bd/crud_altaBajaAsignacion.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, idAsig:idAsig, cicloLectivo:cicloLectivo},
            beforeSend: function() {
                    $('#imagenProceso').show();
                              },
            success: function(){
            
               
            }
        });
        $('#imagenProceso').hide();
        tablaDocente_Asig.row(fila.parents('tr')).remove().draw();
         

    
}


    


    
});


</script>