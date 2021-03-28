<?php
    include_once '../bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    session_start();
    if (isset($_SESSION['idActa_inscriAlumno'])){
        $idActa_inscriAlumno=$_SESSION['idActa_inscriAlumno'];
    
           $consulta = "SELECT actas_examen_datos.idActa,actas_examen_datos.tipo, plan_datos_asignaturas.ciclo, plan_datos_asignaturas.nombre AS 'nombreAsignatura', plan_datos_asignaturas.idPlan, actas_examen_datos.precentacion, datos_docentes1.nombre AS 'docentePresidente', datos_docentes2.nombre AS 'docente1erSuplente', datos_docentes3.nombre AS 'docente2doSuplente' FROM actas_examen_datos INNER JOIN plan_datos_asignaturas ON plan_datos_asignaturas.idAsig = actas_examen_datos.idAsignatura INNER JOIN datos_docentes AS datos_docentes1 ON datos_docentes1.idDocente = actas_examen_datos.docente1 INNER JOIN datos_docentes AS datos_docentes2 ON datos_docentes2.idDocente = actas_examen_datos.docente2 INNER JOIN datos_docentes AS datos_docentes3 ON datos_docentes3.idDocente = actas_examen_datos.docente3 WHERE actas_examen_datos.idActa = '$idActa_inscriAlumno'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $d1ata=$resultado->fetchAll(PDO::FETCH_ASSOC);



                            foreach($d1ata as $d1at) { 

                              

                            $idActa=$d1at['idActa'];
                            $tipo=$d1at['tipo'];
                            $ciclo=$d1at['ciclo'];
                            $idPlan=$d1at['idPlan'];
                            $nombreAsignatura=$d1at['nombreAsignatura'];
                            $precentacion=$d1at['precentacion'];

                            $docente1=$d1at['docentePresidente'];
                            $docente2=$d1at['docente1erSuplente'];
                            $docente3=$d1at['docente2doSuplente'];

                                        $consulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos` WHERE `idPlan`='$idPlan'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($data as $dat) {

                                                $idPlan = $dat['nombre'];

                                        }


                }


?>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">INSCRIBIR A LA MESA DE EXAMEN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
 



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
                   
                    $consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor` FROM `datosalumnos`";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                          
                    foreach($data as $dat) { 
                                                   ?>
                        <tr>
                            <td><?php echo $dat['idAlumnos'] ?></td>
                            <td><?php echo $dat['dniAlumnos'] ?></td>
                            <td><?php echo $dat['nombreAlumnos'] ?></td>
                            <td><button id="boton-<?php echo $idAlumnos; ?>" class="btn btn-danger glyphicon glyphicon-pencil" onclick="botonInscribirFINAL('<?php echo $dat['idAlumnos']; ?>')">Inscribir</button></td>
                        </tr>
                    <?php   }  ?>                                
                    </tbody>        
                </table>                    
            </div>
        </div>
    </div>  
</div>   


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>




<!--  -->

<div class="container">
    <div class="row">
      <div class="col-lg-12 p-2">
            <button id="btn_regresar" type="button" class="btn btn-outline-primary btn-block" data-toggle="modal">Regresar</button>
      </div>
      <div class="col-lg-12 p-2">
            <h1><?php echo $tipo; ?></h1>
      </div>

      <div class="col-lg-12 p-2">
            <h3><?php echo 'TIPO: '.$idPlan.'--CICLO: '.$ciclo.'--ASIGNATURA: '.$nombreAsignatura; ?></h3>
      </div>
      <div class="col-lg-12 p-2">
            <h3>DOCENTES: <?php echo $docente1.'; '.$docente2.'; '.$docente3; ?></h3>
      </div>
      <div class="col-lg-12 p-2">
           
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">INSCRIBIR ALUMNO</button>

            <button type="button"  class="btn btn-danger modalCRUD_actaGuardarNota" >GUARDAR NOTAS EDITADAS</button>

            <button type="button" id='btn_imprimir' class="btn btn-success" >IMPRIMIR PLANILLA</button>

            <button class="btn btn-danger glyphicon glyphicon-pencil eliminar" id="eliminarMatricula" >Eliminar Seleción</button>

      </div>
       
        
    </div>
</div>


 
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tabla_inscripFinal" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>N°</th> 
                                <th>APELLIDO Y NOMBRE</th>
                                <th>DNI</th> 
                                <th>Nota Esc</th> 
                                <th>Nota Oral</th> 
                                <th>Prom Numérico</th>
                                <th>Prom Letra</th>                         
                                <th>ELIMINAR <input type="checkbox" onClick="ActivarCasilla(this);" value="0" /> </th>
                            </tr>
                        </thead>
                        <tbody>
                       <?php  

                           $consulta = "SELECT acta_examen_inscrip.idInscripcion, datosalumnos.nombreAlumnos, datosalumnos.dniAlumnos, acta_examen_inscrip.notaEsc, acta_examen_inscrip.notaOral, acta_examen_inscrip.promNumérico, acta_examen_inscrip.promLetra FROM acta_examen_inscrip INNER JOIN datosalumnos ON datosalumnos.idAlumnos = acta_examen_inscrip.idAlumno WHERE acta_examen_inscrip.idActa = '$idActa_inscriAlumno'";
                              $resultado = $conexion->prepare($consulta);
                              $resultado->execute();
                              $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                              foreach($data as $dat) { 

                              

                            $idInscripcion=$dat['idInscripcion'];
                            $nombreAlumnos=$dat['nombreAlumnos'];
                            $dniAlumnos=$dat['dniAlumnos'];

                            $notaEsc=$dat['notaEsc'];
                            $notaOral=$dat['notaOral'];
                            $promNumérico=$dat['promNumérico'];
                            $promLetra=$dat['promLetra'];

                          





                          
                          ?>
                         
                            <tr id="<?php echo $idInscripcion ?>">
                              
                              
                         
                                <td><?php echo $idInscripcion; ?></td>
                                <td><?php echo $nombreAlumnos; ?></td>
                                <td><?php echo $dniAlumnos; ?></td>
                                <td><input type="text" class="form-control bg-dark-x border-0" id="notaEsc_<?php echo $idInscripcion; ?>" value="<?php echo $notaEsc; ?>"></td>

                                <td><input type="text" class="form-control bg-dark-x border-0" id="notaOral_<?php echo $idInscripcion; ?>" value="<?php echo $notaOral; ?>"></td>

                                <td><input type="text" class="form-control bg-dark-x border-0" id="promNumérico_<?php echo $idInscripcion; ?>" value="<?php echo $promNumérico; ?>"></td>

                                <td><input type="text" class="form-control bg-dark-x border-0" id="promLetra_<?php echo $idInscripcion; ?>" value="<?php echo $promLetra; ?>"></td>

                                <td><input type='checkbox' class="seleTod" value="<?php echo $idInscripcion ?>" > ELIMINAR</input></td>
                            </tr>
                           <?php } ?>                            
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
      









 <script type="text/javascript">
$(document).ready(function(){


  


     var tablaAlumno = $('#tablaAlumnoNuevo').DataTable({ 

          
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

                    });








	$("#btn_regresar").click(function(){
        $('#imagenProceso').show();
        $('#tablaInstitucional').html(''); 
        $('#tablaInstitucional').load('modulosAdministracion/actaTabla.php');
        $('#contenidoAyuda').html(''); 
        
        $('#imagenProceso').hide();


          
         $('#buscarTablaInstitucional').load('modulosAdministracion/actasBuscar.php');
     
        
    });

 
   
    var tabla_inscripFinal = $('#tabla_inscripFinal').DataTable({ 

          
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
                      
                    });



$("#btn_imprimir").click(function(e){
    e.preventDefault();

  contadorAlumno=0;

  comparar=25;

  contador=0;


  tabla_inscripFinal.rows().data().each(function (value) {
    
    contadorAlumno++;

    if (contadorAlumno==comparar) {

      contador++;

    
      comparar=comparar+25;

    }
    
   
     
  });
 

          $.ajax({
                  type:"post",
                  data:'contadorAlumno=' + contadorAlumno + '&contador=' + contador,
                  url:'modulosAdministracion/elementos/seccionCantidadImprimirActa.php',
                  success:function(respuesta){

 
             
              }
            });

        
        window.open('modulosAdministracion/imprimirActaFinal.php', '_blank'); 

});









$(document).on("click", ".modalCRUD_actaGuardarNota", function(){
  

Swal.fire({
  title: 'ESTA SEGURO DE EDITAR',
  text: "Una vez editado no se podra recuperar la nota",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes'
}).then((result) => {
  if (result.isConfirmed) {
    

        tabla_inscripFinal.rows().data().each(function (value) {
            var idInscripcion= value[0];
        
               
            notaActaGuardar(idInscripcion);


            });
           
            
            Swal.fire(
          'MUY BIEN',
          'Los datos fueron registrados y guardados en la base de dato',
          'success'
        )

            
          

  }
})

});










 $(document).on("click", ".eliminar", function(){
        botonMuchosEliminar1();
      });

      function botonMuchosEliminar1() {
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
         
          botonMuchosEliminarFi2();
        }
      })
      }


      function botonMuchosEliminarFi2() {
 
        $("input:checkbox:checked").each(function() {

          idInscripcion = $(this).val();
          fila=$(this);
          
     
          if (idInscripcion!=0) {

            

                tabla_inscripFinal.row(fila.parents('tr')).remove().draw();
               
                opcion=3;
                $.ajax({
                  type:"post",
                  data:'idInscripcion=' + idInscripcion + '&opcion=' + opcion,
                  url:'bd/crud_inscrp_Acta_Examen.php',
                  success:function(respuesta){

 
             
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
        
      }






});

function botonInscribirFINAL(idAlumnos) {
  
   
          


    opcion=1;
    $.ajax({
          type:"post",
          data:'idAlumnos=' + idAlumnos + '&opcion=' + opcion,
          url:'bd/crud_inscrp_Acta_Examen.php',
          success:function(res){
            
            data = res.split('||');

            idInscripcion = data[0];            
            nombreAlumnos = data[1];
            dniAlumnos = data[2];
            notaEsc = data[3];
            notaOral = data[4];
            promNumérico = data[5];
            promLetra = data[6];


            if (idInscripcion != '0') {

            notaEsc= '<input type="text" class="form-control bg-dark-x border-0" id="notaEsc_'+idInscripcion+'" value="'+notaEsc+'" maxlength="2">';

            notaOral= '<input type="text" class="form-control bg-dark-x border-0" id="notaOral_'+idInscripcion+'" value="'+notaOral+'" maxlength="2">';

            promNumérico= '<input type="text" class="form-control bg-dark-x border-0" id="promNumérico_'+idInscripcion+'" value="'+promNumérico+'" maxlength="2">';

            promLetra= '<input type="text" class="form-control bg-dark-x border-0" id="promLetra_'+idInscripcion+'" value="'+promLetra+'" maxlength="2">';

            boton= '<input type="checkbox" class="seleTod" value="'+idInscripcion+'"> ELIMINAR</input>';



            var tabla_inscripFinal = $('#tabla_inscripFinal').DataTable();
            tabla_inscripFinal.row.add( [idInscripcion,nombreAlumnos,dniAlumnos,notaEsc,notaOral,promNumérico,promLetra,boton]).node().id = idInscripcion;
            tabla_inscripFinal.draw( false );

            Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Tu trabajo ha sido guardado',
                      showConfirmButton: false,
                      timer: 600
                    })

          }else{

            Swal.fire({
                      icon: 'error',
                      title: 'Advertencia',
                      text: 'El Alumno ya esta inscripto en la mesa',
                      footer: '<a href>Why do I have this issue?</a>'
                    })
          }

          
          }
        });


 

}






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




function notaActaGuardar(idInscripcion) {
   
    
    notaEsc = $("#notaEsc_"+idInscripcion).val();
    
    notaOral = $("#notaOral_"+idInscripcion).val();
    promNumérico = $("#promNumérico_"+idInscripcion).val();
    promLetra = $("#promLetra_"+idInscripcion).val();

    
    $.ajax({
        url: "bd/crud_notaActaInscrip.php",
        type: "POST",
        dataType: "json",
        data: {idInscripcion:idInscripcion, notaEsc:notaEsc, notaOral:notaOral, promNumérico:promNumérico, promLetra:promLetra},
        success: function(data){  
           
            

        }        
    });
    
    
}    
 
</script>



<?php } ?> 


