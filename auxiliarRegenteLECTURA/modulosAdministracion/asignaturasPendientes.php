
    <style>
   
            table.table-bordered{
    border:1px solid black;
 
        }
      table.table-bordered > thead > tr > th{
          border:1px solid black;
      }
      table.table-bordered > tbody > tr > td{
          border:1px solid black;
      }
    </style>
<?php
    include_once '../bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    session_start();
    if (isset($_SESSION['idAlumnos'])){
        $idAlumnos=$_SESSION['idAlumnos'];

        $cicloLectivo=$_SESSION['cicloLectivo'];

          $cursoSe=$_SESSION['cursoSe'];
     


                $c2onsulta = "SELECT `datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos`, `curso_$cicloLectivo`.`nombre` FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos` = `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `inscrip_curso_alumno_$cicloLectivo`.`idCurso` WHERE `datosalumnos`.`idAlumnos`='$idAlumnos'";
                $r2esultado = $conexion->prepare($c2onsulta);
                $r2esultado->execute();
                $d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

                foreach($d2ata as $d2at) {
                    $nombreAlumnos=$d2at['nombreAlumnos'];
                    $dniAlumnos=$d2at['dniAlumnos'];
                    $nombreCurso=$d2at['nombre'];
                 } 


        $consulta = "SELECT `asignaturas_pendientes_$cicloLectivo`.`idAsigPendiente`,`asignaturas_pendientes_$cicloLectivo`.`idAlumno`,`asignaturas_pendientes_$cicloLectivo`.`asignaturas`, `asignaturas_pendientes_$cicloLectivo`.`situacion`, `plan_datos_asignaturas`.`nombre`, `plan_datos_asignaturas`.`ciclo` FROM `asignaturas_pendientes_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig`= `asignaturas_pendientes_$cicloLectivo`.`asignaturas`  WHERE `asignaturas_pendientes_$cicloLectivo`.`idAlumno`='$idAlumnos'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

           

?>

<input hidden="" id="idAlumnosFIna" value="<?php echo $idAlumnos; ?>">


<input hidden="" id="cicloFinalLet" value="<?php echo $cicloLectivo; ?>">


        
        <div class="col-lg-12 p-2">
            <div id="datosF"><h5>Curso: <?php echo $nombreCurso; ?></h5></div>
        </div>
        <div class="col-lg-12 p-2">
            <div id="nombreAlumnosF"><h5>Apellido y Nombre del Alumno:<?php echo $nombreAlumnos; ?></h5></div>
            <div id="dniF"><h5>DNI del Alumno:<?php echo $dniAlumnos; ?></h5></div>
        </div>
        <div class="col-lg-12 p-2">
            <button type="button" class="btn btn-outline-dark btn-block" id="RegresarLibreta">Libreta / Ficha <span class="badge badge-light"> Regresar lista de Alumno del curso</span></button>
        </div>
        <div class="col-lg-12 p-2">
            
            
            <button type="button" class="btn btn-outline-success btn-block modalCRUD_Libreta_DocentefiFinalFichaAlumno2">Ficha Digital <span class="badge badge-light"> Imprimir la segunda carilla</span></button>
        </div>
 
<button id="btnNuevo_asignatura" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>



                    <div class="table-responsive">        
                        <table id="tablaAsignacion" class="table table-bordered border-primar">

                        <thead class="text-center">
                            <tr>
                                        
                                <th>N°</th>
                                <th>N°AS</th>
                                <th>SITUACIÓN</th> 
                                <th>ASIGNATURA</th>
                                <th>1°MESA</th>
                                <th>2°MESA</th>
                                <th>3°MESA</th>
                                <th>4°MESA</th>
                              
                                 <th>5°MESA</th>
                                <th>BOTONES</th>
                                
                                
                             
                           
                            </tr>
                        </thead>
                        <tbody>
                          <?php                            
                            foreach($data as $dat) {                                                        
                            ?>

                            <tr>
                              <td><?php echo $dat['idAsigPendiente'] ?></td>
                              <td><?php echo $dat['asignaturas'] ?></td>
                              <td><?php echo $dat['situacion'] ?></td>
                              <td><?php echo $dat['nombre'].' '.$dat['ciclo']; ?></td>
                              <td><button class='btn btn-primary mesa1'>1°MESA</button></td>
                              <td><button class='btn btn-primary mesa2'>2°MESA</button></td>
                              <td><button class='btn btn-primary mesa3'>3°MESA</button></td>
                              <td><button class='btn btn-primary mesa4'>4°MESA</button></td>
                              <td><button class='btn btn-primary mesa5'>5°MESA</button></td>


                                 <td></td>
                            </tr>

                             <?php
                                }
                            ?>
                                                       
                        </tbody>        
                       </table>                    
                    </div>
         

<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD_asignacion" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                 <select class="form-control" id="situacion">
              <option>Asignatura Pendiente</option>
              <option>Equivalencia</option>
            
            </select>
                         
              </div>

 
                <div class="form-group">
              <label for="asignatura" class="col-form-label ediCur">ASIGNATURA Y CICLO:</label><br>
                        <select class="form-control" id="asignatura" >
                            <option value="0">Seleccione un curso</option>
                             <?php

                             include_once '../bd/conexion.php';
                                $objeto = new Conexion();
                                $conexion = $objeto->Conectar();
                                session_start();



                             $c1onsulta = "SELECT `idAsig`, `nombre`, `ciclo`, `idPlan` FROM `plan_datos_asignaturas` ORDER BY `ciclo`";
                                $r1esultado = $conexion->prepare($c1onsulta);
                                $r1esultado->execute();
                                $d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($d1ata as $d1at) {

                                         $idAsig = $d1at['idAsig'];
                                         $nombre = $d1at['nombre'];
                                         $ciclo = $d1at['ciclo'];
                                         $idPlan = $d1at['idPlan'];

                               
                                        $consulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos` WHERE `idPlan`='$idPlan'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($data as $dat) {

                                                $idPlan = $dat['nombre'];

                                        }



                                ?>
                                <option value="<?php echo $idAsig; ?>"><?php echo $ciclo.'--'.$nombre.'--'.$idPlan; ?></option>
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

 var tablaAsignacion = $('#tablaAsignacion').DataTable({ 

         destroy:true,

           columnDefs:[{
        targets: -1,
        data:null,
        defaultContent: "<div class='text-center'><div class='btn-group'><button class='btn btn-warning btnEditar_libreComp' title='IMPRIMIR FILA COMPLETA'><i class='fas fa-cog fa-spin'></i></button><button class='btn btn-dark btnEditar_libreNotas' title='IMPRIMIR SOLO NOTAS'><i class='fas fa-cog fa-spin'></i></button><div class='btn-group'><button class='btn btn-primary btnEditar_asignaturaPe'>Editar</button><button class='btn btn-danger btnBorrar_asignaturaPe'>Borrar</button></div></div>"  
       }],


     scrollY:        "400px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns: true,
        fixedColumns:   {
            leftColumns: 4//Le indico que deje fijas solo las 2 primeras columnas
        },

   
     language: {
      lengthMenu: "Display _MENU_ records per page",
      zeroRecords: "Nothing found - sorry",
      info: "Showing page _PAGE_ of _PAGES_",
      infoEmpty: "No records available",
      search: "",
      searchPlaceholder: "Buscar",
      loadingRecords: "Cargando...",
      processing: "Procesando....",
      paginate: {
        first: "primero",
        last: "ultimo",
        next: "siguiente",
        previous: "anterior"
      },
      infoFiltered: "(filtered from _MAX_ total records)"
    },
   

        
         
    });



$(document).on("click", ".mesa1", function(){    
    fila = $(this);
    idAsigPendiente = parseInt($(this).closest("tr").find('td:eq(0)').text());

    solisitud = 1;//borrar

    boton12(idAsigPendiente,solisitud);
  
});

$(document).on("click", ".mesa2", function(){    
    fila = $(this);
    idAsigPendiente = parseInt($(this).closest("tr").find('td:eq(0)').text());

    solisitud = 2;//borrar

    boton12(idAsigPendiente,solisitud);
  
});

$(document).on("click", ".mesa3", function(){    
    fila = $(this);
    idAsigPendiente = parseInt($(this).closest("tr").find('td:eq(0)').text());

    solisitud = 3;//borrar

    boton12(idAsigPendiente,solisitud);
  
});

$(document).on("click", ".mesa4", function(){    
    fila = $(this);
    idAsigPendiente = parseInt($(this).closest("tr").find('td:eq(0)').text());

    solisitud = 4;//borrar

    boton12(idAsigPendiente,solisitud);
  
});

$(document).on("click", ".mesa5", function(){    
    fila = $(this);
    idAsigPendiente = parseInt($(this).closest("tr").find('td:eq(0)').text());

    solisitud = 5;//borrar

    boton12(idAsigPendiente,solisitud);
  
});


function boton12(idAsigPendiente,solisitud) {


   $.ajax({
            url: "modulosAdministracion/elementos/califAsigPendi.php",
            type: "POST",
            data: {idAsigPendiente:idAsigPendiente, solisitud:solisitud},
             success: function(res){  
            console.log(res);
           
                data = res.split('||');

                   
                  calFinal = data[0];
                  fecha = data[1];
                  libro = data[2];
                  folio = data[3];
                  bloque = data[4];

                  if (bloque=='SI') {

                    ret=`<div class="col-12"><div class="form-group"><label for="bloqueFIL" class="col-form-label">BLOQUEO AL AUXILIAR:</label>
                <select class="form-control" id="bloqueFIL">
                <option>SI</option>
                <option>NO</option>
                </select></div><div class="form-group">
                <label for="calfinal" class="col-form-label">CAL.FINAL</label>
                <input type="number" class="form-control" id="calfinal" value='`+calFinal+`'>
                </div> 


                <div class="form-group">
                <label for="fecha" class="col-form-label">FECHA</label>
                <input type="date" class="form-control" id="fecha" value='`+fecha+`'>
                </div> 
                <div class="form-group">
                <label for="libro" class="col-form-label">LIBRO</label>
                <input type="data" class="form-control" id="libro" value='`+libro+`'>
                </div> 
                <div class="form-group">
                <label for="folio" class="col-form-label">FOLIO</label>
                <input type="data" class="form-control" id="folio" value='`+folio+`'>
                </div> 
            </div>`;

                  }else{

                     ret=`<div class="col-12"><div class="form-group"><label for="bloqueFIL" class="col-form-label">BLOQUEO AL AUXILIAR:</label>
                <select class="form-control" id="bloqueFIL">
                <option>NO</option>
                <option>SI</option>
                </select></div><div class="form-group">
                <label for="calfinal" class="col-form-label">CAL.FINAL</label>
                <input type="number" class="form-control" id="calfinal" value='`+calFinal+`'>
                </div> 


                <div class="form-group">
                <label for="fecha" class="col-form-label">FECHA</label>
                <input type="date" class="form-control" id="fecha" value='`+fecha+`'>
                </div> 
                <div class="form-group">
                <label for="libro" class="col-form-label">LIBRO</label>
                <input type="data" class="form-control" id="libro" value='`+libro+`'>
                </div> 
                <div class="form-group">
                <label for="folio" class="col-form-label">FOLIO</label>
                <input type="data" class="form-control" id="folio" value='`+folio+`'>
                </div> 
            </div>`;

                  }
                


                  Swal.fire({
              title: 'Datos para la Ficha del Alumno',
              html:ret, 
              focusConfirm: false,
              showCancelButton: true,                         
              }).then((result) => {
                if (result.value) {                                             
                  calfinal = document.getElementById('calfinal').value;
                  fecha = document.getElementById('fecha').value;
                  libro = document.getElementById('libro').value;
                  folio = document.getElementById('folio').value;
                  bloqueFIL = document.getElementById('bloqueFIL').value;
       

                  ingresar(calfinal,fecha,libro,folio,bloqueFIL,solisitud,idAsigPendiente);
                                  
                }
        });

            
               
            }
        });


}




function ingresar(calfinal,fecha,libro,folio,bloqueFIL,solisitud,idAsigPendiente) {



         ret=`<div class="col-12"> 
                <div class="form-group">
                
                <input type="data" class="form-control" id="pass">
                </div> 
            </div>`;


                  Swal.fire({
              title: 'INGRESE TU CONTRASEÑA',
              html:ret, 
              focusConfirm: false,
              showCancelButton: true,                         
              }).then((result) => {
                if (result.value) {                                             
                  pass = document.getElementById('pass').value;

                  if (pass=='32729125') {
                    ingresarF(calfinal,fecha,libro,folio,bloqueFIL,solisitud,idAsigPendiente);
                  }else{
                    Swal.fire({
                            icon: 'error',
                            title: 'CONTRASEÑA INCORRECTA',
                            text: 'Consulte con el administrador',
                            footer: '<a href>Why do I have this issue?</a>'
                          })
                  }
                
                  
                                  
                }
        });

            
    

}











function ingresarF(calfinal,fecha,libro,folio,bloqueFIL,solisitud,idAsigPendiente) {
  

  $.ajax({
            url: "bd/asignaturasPendientesFinal.php",
            type: "POST",
            dataType: "json",
            data: {calfinal:calfinal, fecha:fecha, libro:libro, folio:folio, bloqueFIL:bloqueFIL, solisitud:solisitud, idAsigPendiente:idAsigPendiente},
            success: function(){
            
               
            }
        });

  Swal.fire(
                        'MUY BIEN !',
                        'DATOS GUARDADOS',
                        'success'
                      )

}

























 
$(document).on("click", ".modalCRUD_Libreta_DocentefiFinalFichaAlumno2", function(){


 
   window.open('modulosAdministracion/asignaturasPendientesFicha.php', '_blank'); 

    

});


$("#btnNuevo_asignatura").click(function(){
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Carga");            
    $("#modalCRUD_asignacion").modal("show"); 

    $('#asignatura').select2({ width: '100%'});
       
    idAsigPendiente=null;
    opcion = 1; //alta
});


$("#RegresarLibreta").click(function(){

  $('#imagenProceso').show();

      $('#libreTaOcul').show();

      $('#libretaFina').html('');
                

           
    
 $('#imagenProceso').hide(); 

}); 



$(document).on("click", ".btnEditar_libreComp", function(){
    fila = $(this).closest("tr");

    idAsigPendiente = parseInt(fila.find('td:eq(0)').text());
  
    situacion = fila.find('td:eq(2)').text();
    fila='completa';


    idAlumnos=$('#idAlumnosFIna').val();

    cicloFinalLet=$('#cicloFinalLet').val();


    if (situacion=='Equivalencia') {


         $.ajax({
            url: "modulosAdministracion/elementos/seccionLibretaFilaPendienteEquivalencia.php",
            type: "POST",
            dataType: "json",
            data: {fila:fila, idAsigPendiente:idAsigPendiente, idAlumnos:idAlumnos, cicloFinalLet:cicloFinalLet},
            success: function(){
            

              window.open('modulosAdministracion/asignaturasPendientesLibretaFilaCompleCaraUno.php', '_blank'); 

    
               
            }
        });


    }else{

  $.ajax({
            url: "modulosAdministracion/elementos/seccionLibretaFilaPendienteEquivalencia.php",
            type: "POST",
            dataType: "json",
            data: {fila:fila, idAsigPendiente:idAsigPendiente, idAlumnos:idAlumnos, cicloFinalLet:cicloFinalLet},
            success: function(){
            
               
              window.open('modulosAdministracion/asignaturasPendientesLibretaFilaCompleCaraDos.php', '_blank'); 


            }
        });



    }



});
  

$(document).on("click", ".btnEditar_libreNotas", function(){
    fila = $(this).closest("tr");

    idAsigPendiente = parseInt(fila.find('td:eq(0)').text());

    situacion = fila.find('td:eq(2)').text();

    fila='notas';

       idAlumnos=$('#idAlumnosFIna').val();
       cicloFinalLet=$('#cicloFinalLet').val();

     if (situacion=='Equivalencia') {


         $.ajax({
            url: "modulosAdministracion/elementos/seccionLibretaFilaPendienteEquivalencia.php",
            type: "POST",
            dataType: "json",
            data: {fila:fila, idAsigPendiente:idAsigPendiente, idAlumnos:idAlumnos, cicloFinalLet:cicloFinalLet},
            success: function(){
            
            window.open('modulosAdministracion/asignaturasPendientesLibretaFilaCompleCaraUno.php', '_blank'); 

               
            }
        });




    }else{

  $.ajax({
            url: "modulosAdministracion/elementos/seccionLibretaFilaPendienteEquivalencia.php",
            type: "POST",
            dataType: "json",
            data: {fila:fila, idAsigPendiente:idAsigPendiente, idAlumnos:idAlumnos, cicloFinalLet:cicloFinalLet},
            success: function(){
            
               window.open('modulosAdministracion/asignaturasPendientesLibretaFilaCompleCaraDos.php', '_blank'); 

            }
        });



    }
    
});









$(document).on("click", ".btnEditar_asignaturaPe", function(){
    fila = $(this).closest("tr");

    

    idAsigPendiente = parseInt(fila.find('td:eq(0)').text());
    asignaturas=fila.find('td:eq(1)').text();
    
    situacion = fila.find('td:eq(2)').text();
    
   
    ciclo=$("#cicloFinalLet").val(); 

  

          
            $('#asignatura').select2({ width: '100%'});
            $('#asignatura').val(asignaturas).trigger('change.select2');
  
    
       
    $("#situacion").val(situacion);
 

    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar ");            
    $("#modalCRUD_asignacion").modal("show");  
    
});
  

$(document).on("click", ".btnBorrar_asignaturaPe", function(){    
    fila = $(this);
    idAsigPendiente = parseInt($(this).closest("tr").find('td:eq(0)').text());

    opcion = 3 ;//borrar

    eliminarAntesPE(idAsigPendiente,opcion);
  
});
    







function eliminarAntesPE(idAsigPendiente,opcion) {

  

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

    eliminarAntesPEDefini(idAsigPendiente,opcion);
  }
})



      
     
}


function  eliminarAntesPEDefini(idAsigPendiente,opcion){
 
        $.ajax({
            url: "bd/asignaturasPendientes.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, idAsigPendiente:idAsigPendiente},
            success: function(){
            
               
            }
        });

        tablaAsignacion.row(fila.parents('tr')).remove().draw();

    
}









$("#formPersonas").submit(function(e){
    e.preventDefault();    
    asignatura = $.trim($("#asignatura").val());
    
     situacion = $.trim($("#situacion").val());


    $.ajax({
        url: "bd/asignaturasPendientes.php",
        type: "POST",
        dataType: "json",
        data: {idAsigPendiente:idAsigPendiente, asignatura:asignatura, opcion:opcion, situacion:situacion},
        success: function(data){  
            console.log(data);
            idAsigPendiente = data[0].idAsigPendiente;            
            idAlumno = data[0].idAlumno;
            asignaturas = data[0].asignaturas;
          

            nombre = data[0].nombre;
            
            situacion = data[0].situacion;
            ciclo = data[0].ciclo;




              boton1="<button class='btn btn-primary mesa1'>1°MESA</button>";
              boton2="<button class='btn btn-primary mesa2'>2°MESA</button>";
              boton3="<button class='btn btn-primary mesa3'>3°MESA</button>";
              boton4="<button class='btn btn-primary mesa4'>4°MESA</button>";
              boton5="<button class='btn btn-primary mesa5'>5°MESA</button>";
            
        
            if(opcion == 1){tablaAsignacion.row.add([idAsigPendiente,asignaturas,situacion,nombre+' '+ciclo,boton1,boton2,boton3,boton4,boton5]).draw();}
            else{tablaAsignacion.row(fila).data([idAsigPendiente,asignaturas,situacion,nombre+' '+ciclo,boton1,boton2,boton3,boton4,boton5]).draw();}            
        }        
    });


    $("#modalCRUD_asignacion").modal("hide");    
    
});  


});




</script>




<?php  } ?>



