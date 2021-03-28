<?php
      include_once '../bd/conexion.php';
      $objeto = new Conexion();
      $conexion = $objeto->Conectar();
      session_start();
      if ((isset($_SESSION['cursoSe']))){
          $cursoSe=$_SESSION['cursoSe'];

          $cicloLectivo=$_SESSION['cicloLectivo'];
        


            $consulta = "SELECT `inscrip_curso_alumno_$cicloLectivo`.`idIns`, `datosalumnos`.`dniAlumnos`, `datosalumnos`.`nombreAlumnos` FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos`= `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idCurso` = '$cursoSe'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 p-2">
          <button class="btn btn-success glyphicon glyphicon-pencil" id="incrpAlumnoMatric" onclick="botonInscripcion('')">Nueva Inscripción</button>

          <button class="btn btn-danger glyphicon glyphicon-pencil eliminar" id="eliminarMatricula" >Eliminar Seleción</button>

          <button class="btn btn-info glyphicon glyphicon-pencil" id="cambiar">Cambio de Curso</button>
        </div>
    </div>
</div>


<div class="table-responsive">        
        <table id="tablaInscripcion" class="table table-striped table-bordered table-condensed" style="width:100%">
              <thead class="text-center">
                  <tr>
                    <th>Sel <input type="checkbox" onClick="ActivarCasilla(this);" value="0" /> </th>
                    <th>N°inscrip</th>
                    <th>DNI</th>
                    <th>Apellido y Nombre</th>
                  </tr>
              </thead>
              <tbody>
              <?php
               foreach($data as $dat) { 
                $idIns=$dat['idIns'];
                $dniAlumnos=$dat['dniAlumnos'];
                $nombreAlumnos=$dat['nombreAlumnos'];
              
                            ?>
                            <tr id="<?php echo $idIns ?>">
                              
                                <td><label><input type='checkbox' class="seleTod" value="<?php echo $idIns ?>" > AsClick</label></td>
                                
                                <td><?php echo $idIns ?></td>

                                <td><?php echo $dniAlumnos ?></td>
                             
                                <td><?php echo $nombreAlumnos ?></td>
           
                               

</td>
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
<div class="modal fade" id="modalCRUD_cambioCurso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>       
            <div class="modal-body">
              <div class="form-group">
                <label for="planSeleC" class="col-form-label">Curso:</label>
                <select class="form-control" id="cursoSeCambi">
                  <option value="0">Seleccione un Curso</option>
                  <?php

                    $consulta = "SELECT `idCurso`, `idPlan`, `ciclo`, `nombre` FROM `curso_$cicloLectivo` WHERE `idPlan`='básico'";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a as $da1t) { 
                    $idPlan=$da1t['idPlan'];
                    $idCurso=$da1t['idCurso'];
                    $nombre=$da1t['nombre'];

                    ?>
                    <option value="<?php echo $idCurso ?>"><?php echo $nombre.'--'.$idPlan ?></option>
                    <?php } ?>

                     <?php
           
                  $consulta = "SELECT `curso_$cicloLectivo`.`idCurso`, `plan_datos`.`nombre`, `curso_$cicloLectivo`.`nombre` AS 'nombreCurso' FROM `curso_$cicloLectivo` INNER JOIN `plan_datos` ON `plan_datos`.`idPlan`= `curso_$cicloLectivo`.`idPlan`";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($data as $dat) { 
                
                    $idCurso=$dat['idCurso'];
                    $nombreCurso=$dat['nombreCurso'];
                    $nombre=$dat['nombre'];

                    ?>
                    <option value="<?php echo $idCurso ?>"><?php echo $nombreCurso.'--'.$nombre ?></option>
                    <?php } ?>
                </select>
              </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success glyphicon glyphicon-pencil cambiarFinal">Guardar</button>
            </div>
        </div>
    </div>
</div>  




<div id="tabla_inscrp"></div>





<script type="text/javascript">
    $(document).ready(function(){

      $('#tabla_inscrp').load('modulosAdministracion/tabla_Inscripcion_Alumno_Curso.php');


      
      var tablaInscripcion = $('#tablaInscripcion').DataTable({
        "destroy":true,   
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
      $(document).on("click", "#cambiar", function(){
         fila = $(this);
          $(".modal-header").css("background-color", "#1cc88a");
          $(".modal-header").css("color", "white");
          $(".modal-title").text("Nueva Curso");            
          $("#modalCRUD_cambioCurso").modal("show");
        });

      $(document).on("click", ".eliminar", function(){
        botonMuchosEliminar();
      });

      function botonMuchosEliminar() {
        Swal.fire({
          title: 'Esta seguro de Desmatricular estos alumno/s del curso?',
          text: "Los alumnos perderan todas las notas de la Libreta digital",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Desmatricular'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
              'Deleted!',
              'Operación éxitosa',
              'success'
            )

          $("#imagenProceso").show();
          document.getElementById("eliminarMatricula").disabled = true;
          document.getElementById("cambiar").disabled = true;
          document.getElementById("incrpAlumnoMatric").disabled = true;
          botonMuchosEliminarFi();
        }
      })
      }


      function botonMuchosEliminarFi() {
        cursoSe = $("#cursoSe").val();
        idAlumnos=null;
        opcion=2;

        $("input:checkbox:checked").each(function() {

          idIns = $(this).val();
          fila=$(this);
          
     
          if (idIns!=0) {

                tablaInscripcion.row(fila.parents('tr')).remove().draw();
               

                $.ajax({
                  type:"post",
                  data:'idAlumnos=' + idAlumnos + '&cursoSe=' + cursoSe + '&idIns=' + idIns + '&opcion=' + opcion,
                  url:'bd/crud_inscripcion.php',
                  success:function(respuesta){

                    v=respuesta.split('||');

                             
                    idAlumnos = v[0];
                   
               
 
                      $("#asig-"+idAlumnos).html('Sin Curso');
                      document.getElementById("boton-"+idAlumnos).disabled = false;
                      
                     
             
                  }
                });

           
            
          }

        });
        Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Se actualizo los registros',
              showConfirmButton: false,
              timer: 500
            });
        $("#imagenProceso").hide();
        document.getElementById("eliminarMatricula").disabled = false;
        document.getElementById("cambiar").disabled = false;
        document.getElementById("incrpAlumnoMatric").disabled = false;
      }




      $(document).on("click", ".cambiarFinal", function(){
        fila = $(this);
        cambioCursoTotalttt();
      });

      function cambioCursoTotalttt() {
        Swal.fire({
              title: 'Esta seguro de cambiar estos alumno/s a otro curso?',
              text: "Los alumnos perderan todas las notas de la Libreta digital de este curso",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Cambiar'
            }).then((result) => {
              if (result.isConfirmed) {
                Swal.fire(
                  'Deleted!',
                  'Operación éxitosa',
                  'success'
                )

               $("#imagenProceso").show();
              document.getElementById("eliminarMatricula").disabled = true;
              document.getElementById("cambiar").disabled = true;
              document.getElementById("incrpAlumnoMatric").disabled = true;
              cambioCursoTotaltttFinal();
            }
          })
          }


          function cambioCursoTotaltttFinal() {
            cursoSe = $("#cursoSeCambi").val();
            if (cursoSe!='0') {
              $("#modalCRUD_cambioCurso").modal("hide");
              $("input:checkbox:checked").each(function() {
                idIns = $(this).val();
                if (idIns!=0) {
                  cadena="idIns=" + idIns + "&cursoSe=" + cursoSe;
                  cambioCursoTotal();
                }
              });
            }
            $("#imagenProceso").hide();
            document.getElementById("eliminarMatricula").disabled = false;
            document.getElementById("cambiar").disabled = false;
            document.getElementById("incrpAlumnoMatric").disabled = false;
          }


          function cambioCursoTotal() {
            cursoSe = $("#cursoSeCambi").val();
            if (cursoSe!='0') {
              $("#modalCRUD_cambioCurso").modal("hide");
              $("input:checkbox:checked").each(function() {
                idIns = $(this).val();
                fila=$(this);
   
              if (idIns!=0) {
                idAlumnos=null;
                opcion=3;
                tablaInscripcion.row(fila.parents('tr')).remove().draw();
                
                $.ajax({
                      type:"post",
                      data:'idAlumnos=' + idAlumnos + '&cursoSe=' + cursoSe + '&idIns=' + idIns + '&opcion=' + opcion,
                      url:'bd/crud_inscripcion.php',
                      success:function(respuesta){
                        console.log(respuesta);
                         v=respuesta.split('||');

                             
                        idAlum = v[0];
                        nombre = v[1];
                   
                   
               

                          $("#asig-"+idAlum).html(nombre);


                      
                     }
                });
              }
            });
              Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Se actualizo los registros',
                        showConfirmButton: false,
                        timer: 500
                      });
            }
          }
  });

  function ActivarCasilla(casilla){
    miscasillas=document.getElementsByClassName('seleTod'); //Rescatamos controles tipo Input
    for(i=0;i<miscasillas.length;i++) //Ejecutamos y recorremos los controles
      {
        if(miscasillas[i].type == "checkbox") // Ejecutamos si es una casilla de verificacion
        {
          miscasillas[i].checked=casilla.checked; // Si el input es CheckBox se aplica la funcion ActivarCasilla
        }
      }
    }

  function agregarCursoAlumno(data){

    v=data.split('||');

    idIns = v[0];    
    dniAlumnos = v[1];
    nombreAlumnos = v[2];
    nombre = v[3];

    

   

    fila= '<label><input type="checkbox" class="seleTod" value="'+idIns+'" > AsClick</label>';

    var tablaInscripcion = $('#tablaInscripcion').DataTable();
    tablaInscripcion.row.add( [fila,idIns,dniAlumnos,nombreAlumnos]).node().id = idIns;
    tablaInscripcion.draw( false );

         
  }


</script>

<?php  } ?>


