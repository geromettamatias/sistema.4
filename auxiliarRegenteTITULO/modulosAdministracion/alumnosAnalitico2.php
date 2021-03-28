
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
<!--INICIO del cont principal-->

 <?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();


if (isset($_SESSION['idAlumnos'])){
$idAlumnos=$_SESSION['idAlumnos'];


$c3onsulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor` FROM `datosalumnos` WHERE `idAlumnos`='$idAlumnos'";
        $r3esultado = $conexion->prepare($c3onsulta);
        $r3esultado->execute();
        $d3ata=$r3esultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($d3ata as $d3at) {
            $nombreAlumnos=$d3at['nombreAlumnos'];
            $dniAlumnos=$d3at['dniAlumnos'];
         }




    $c9onsulta = "SELECT datosalumnos.dniAlumnos, datosalumnos.nombreAlumnos, plan_datos.nombre FROM datosalumnos INNER JOIN plan_datos ON plan_datos.idPlan = datosalumnos.idPlanEstudio WHERE datosalumnos.idAlumnos = '$idAlumnos'";
        $r9esultado = $conexion->prepare($c9onsulta);
        $r9esultado->execute();
        $d9ata=$r9esultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($d9ata as $d9at) {
            $dniAlumnos=$d9at['dniAlumnos'];
            $nombreAlumnos=$d9at['nombreAlumnos'];
            $nombrePlan=$d9at['nombre'];
         }

?>


                <div class="col-lg-12">
                    <h2>Analítico</h2><br>
                    <div id="datosF411"><h5>Modalidad: <?php echo $nombrePlan; ?> </h5></div>
                    <div id="nombreAlumnosF311"><h5>Apellido y Nombre del Alumno:<?php echo $nombreAlumnos; ?></h5></div>
                    <div id="dniF311"><h5>DNI del Alumno:<?php echo $dniAlumnos; ?></h5></div>
                </div>
                <div class="col-lg-12">
                  <div class="container">
<button type="button" class="btn btn-outline-warning btn-block" id="RegresarAnalirico">Analíticos <span class="badge badge-light"> Regresar lista de Alumnos</span></button>


                      <br>

                 
                 <button type="button" class="btn btn-success  modalCRUD_AnaliticoAlumnoFinas">Analítico (MODELO VIEJO)<span class="badge badge-light"> Imprimir</span></button>
                 <button type="button" class="btn btn-info modalCRUD_AnaliticoAlumnoFinasNuevo">Analítico (NUEVO MODELO)<span class="badge badge-light"> Imprimir</span></button>

                 <br>     <br>

                 <button class="btn btn-info glyphicon glyphicon-pencil" onclick="botonEXTRA('<?php echo $idAlumnos ?>')">Analítico <span class="badge badge-light"> Datos extras</span></button>


                 <button type="button" class="btn btn-danger modalCRUD_AlumnoAnalitico">Analítico <span class="badge badge-light"> GUARDAR LOS DATOS EDITADOS</span></button>
                </div>
            



<input type="text" hidden=""  id="datosF311" value="<?php echo 'Modalidad: '.$nombrePlan. ' -- Apellido y nombre: '.$nombreAlumnos.'; DNI: : '.$dniAlumnos; ?>">


<br>
 

                      
                        <table id="tablanotas" class="table table-bordered border-primar" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>N°</th>
                                <th>CICLO</th> 
                                <th>ESPACIO CURRICULAR</th>
                                <th >CALIF NUME</th>
                                <th style="width: 50px;">CALIF ESCR</th> 
                                <th>CONDICIÓN</th> 
                                <th>MES</th> 
                                <th>AÑO</th>
                                <th>ESTABLECI.</th> 
                                
                                                    
                             
                            </tr>
                        </thead>
                        <tbody>
                            <?php 

                            $consulta = "SELECT analitico.idAnalitico, plan_datos_asignaturas.nombre, plan_datos_asignaturas.ciclo, analitico.nota, analitico.notaEscr,  analitico.fechaMes, analitico.fechaAño,  analitico.condicion,  analitico.establecimiento FROM analitico INNER JOIN plan_datos_asignaturas ON plan_datos_asignaturas.idAsig = analitico.idAsig WHERE analitico.idAlumno = '$idAlumnos'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                           
                            foreach($data as $dat) {                                
                    
                                $idAnalitico=$dat['idAnalitico'];
                                $nota=$dat['nota'];
                                $notaEscr=$dat['notaEscr'];

                                $ciclo=$dat['ciclo'];
                                $nombre=$dat['nombre'];

                                $fechaMes=$dat['fechaMes'];
                                 $fechaAño=$dat['fechaAño'];
                                $condicion=$dat['condicion'];
                                 $establecimiento=$dat['establecimiento'];
                            

                            ?>
                            <tr>
                              
                                <td><?php echo $idAnalitico ?></td>
                                <td><?php echo $ciclo ?></td>
                                <td><?php echo $nombre ?></td>

                                <td><input type="number" class="form-control bg-dark-x border-0" id="nota_<?php echo $idAnalitico; ?>" value="<?php echo $nota; ?>"></td>

                                <td><input type="text" class="form-control bg-dark-x border-0" id="notaEscr_<?php echo $idAnalitico; ?>" value="<?php echo $notaEscr; ?>" ></td>

                                <td><input type="text" class="form-control bg-dark-x border-0" id="condicion_<?php echo $idAnalitico; ?>" value="<?php echo $condicion; ?>"></td>

                                <td><input type="text" class="form-control bg-dark-x border-0" id="fechaMes_<?php echo $idAnalitico; ?>" value="<?php echo $fechaMes; ?>"></td>

                                <td><input type="text" class="form-control bg-dark-x border-0" id="fechaAño_<?php echo $idAnalitico; ?>" value="<?php echo $fechaAño; ?>"></td>

                                <td><input type="text" class="form-control bg-dark-x border-0" id="establecimiento_<?php echo $idAnalitico; ?>" value="<?php echo $establecimiento; ?>"></td>


                                
           
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                








 <script type="text/javascript">
$(document).ready(function(){

     Swal.fire(
          'IMPORTANTE !!',
          'No se olvide de guardar los datos despues de modificarlos',
          'warning'
        )

    

    var tablanotas = $('#tablanotas').DataTable({ 

    
        "destroy":true,

     scrollY:        "400px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns: true,
        fixedColumns:   {
            leftColumns: 3//Le indico que deje fijas solo las 2 primeras columnas
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



$("#RegresarAnalirico").click(function(){

    $('#buscarTablaInstitucional').show();

    $('#tablaInstitucional').load('modulosAdministracion/alumnosAnalitico1.php');
          
    
}); 




var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".modalCRUD_AnaliticoAlumnoFinas", function(){


 window.open('modulosAdministracion/alumnosAnalitico3.php', '_blank');   

});
$(document).on("click", ".modalCRUD_AnaliticoAlumnoFinasNuevo", function(){


 window.open('modulosAdministracion/alumnosAnalitico4.php', '_blank');   

});

//botón EDITAR    
$(document).on("click", ".modalCRUD_AlumnoAnalitico", function(){
    fila = $(this).closest("tr");




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
    

        tablanotas.rows().data().each(function (value) {
            var analitico= value[0];
        
               
            analiticoFinal(analitico);


            });
           
            
            Swal.fire(
          'MUY BIEN',
          'Los datos fueron registrados y guardados en la base de dato',
          'success'
        )

            
          

  }
})

});



});






function botonEXTRA(idAlumno) {



  $.ajax({
    type:"post",
    data:'idAlumno=' + idAlumno,
    url:'modulosAdministracion/elementos/buscarDatosAnalitico.php',
    success:function(res){

        
            data = res.split('||');

            Libro = data[0];            
            Folio = data[1];
            egreso = data[2];
            lugar = data[3];
            fecha = data[4];
            obs = data[5];
         

    Swal.fire({
              title: 'Datos del Analítico',
              html:`<div class="col-12">
              <div class="form-group">
                  <label for="Libro" class="col-form-label">Libro:</label>
                  <input type="text" class="form-control" id="Libro" value='`+Libro+`'>
              </div>
              <div class="form-group">
                  <label for="Folio" class="col-form-label">Folio:</label>
                  <input type="text" class="form-control" id="Folio" value='`+Folio+`'>
              </div>
              <div class="form-group">
                  <label for="egreso" class="col-form-label">FECHA DE EGRESO::</label>
                  <input type="text" class="form-control" id="egreso" value='`+egreso+`'>
              </div>
              <div class="form-group">
                  <label for="lugar" class="col-form-label">LUGAR:</label>
                  <input type="text" class="form-control" id="lugar" value='`+lugar+`'>
              </div>
              <div class="form-group">
                  <label for="fecha" class="col-form-label">FECHA:</label>
                  <input type="text" class="form-control" id="fecha" value='`+fecha+`'>
              </div>
              <div class="form-group">
                  <label for="obs" class="col-form-label">OBSERVACIONES: Ingresó con:</label>
                  <input type="text" class="form-control" id="obs" value='`+obs+`'>
              </div>
            
            </div>`, 
              focusConfirm: false,
              showCancelButton: true,                         
              }).then((result) => {
                if (result.value) {                                             
                  Libro = document.getElementById('Libro').value,
                  Folio = document.getElementById('Folio').value,
                  egreso = document.getElementById('egreso').value,
                  lugar = document.getElementById('lugar').value,
                   fecha = document.getElementById('fecha').value,
                   obs = document.getElementById('obs').value,
                
                 ingresarDatosAnalitico(idAlumno,Libro,Folio,egreso,lugar,fecha,obs);
                                  
                }
        });



    }
  });


  
          
}

function ingresarDatosAnalitico(idAlumno,Libro,Folio,egreso,lugar,fecha,obs) {
  
  $.ajax({
    type:"post",
    data:'idAlumno=' + idAlumno +'&Libro=' + Libro +'&Folio=' + Folio +'&egreso=' + egreso +'&lugar=' + lugar +'&fecha=' + fecha +'&obs=' + obs,
    url:'bd/ingresarDatosAnalitico.php',
    success:function(r){

      Swal.fire(
            'Muy bien !!',
            'Operación exitosa',
            'success'
          )

    }
  });

}


</script>




<?php  } ?>



