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
           
        

            <button type="button" id='btn_imprimir' class="btn btn-success" >IMPRIMIR PLANILLA</button>

         
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
                                <td><?php echo $notaEsc; ?></td>

                                <td><?php echo $notaOral; ?></td>

                                <td><?php echo $promNumérico; ?></td>

                                <td><?php echo $promLetra; ?></td>

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


 
</script>



<?php } ?> 


