
<!--INICIO del cont principal-->
<div class="container">

 <?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();



 
$consulta = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo`, `nregistro` FROM `datos_docentes`";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


?>








    

  
 
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                  
                 <button id="btnNuevo_Directivo" type="button" class="btn btn-success" data-toggle="modal">Datos de los Directivos- Editar</button><br><br>
                <h3><u><b>Director</b></u></h3>
                 <h5><b>Nombre y Apellido:</b><div id="nombreDirectivos" style="color:#FF0000";></div></h5>
                 <h5><b>Datos:</b><div id="datosDirectivos" style="color:#FF0000";></div></h5>
                 <h3><u><b>Vice-Director</b></u></h3>
                 <h5><b>Nombre y Apellido:</b><div id="nombreviceDirector" style="color:#FF0000";></div></h5>
                 <h5><b>Datos:</b><div id="datosviceDirector" style="color:#FF0000";></div></h5>
                 <h3><u><b>Asesor Pedag.</b></u></h3>
                 <h5><b>Nombre y Apellido:</b><div id="nombreasesora" style="color:#FF0000";></div></h5>
                 <h5><b>Datos:</b><div id="datosasesora" style="color:#FF0000";></div></h5>





                </div>
        </div>  
</div>    
      

        
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD_DatosDirectivos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formDatosDirec">    
                         
            <div class="modal-body">
                

                <div class="form-group">
                <label for="nombreDirectivosf" class="col-form-label">Nombre del Director:</label>
                <input type="text" class="form-control" id="nombreDirectivosf">
                </div>
                <div class="form-group">
                <label for="datosDirectivosf" class="col-form-label">Datos del Director:</label>
                <input type="text" class="form-control" id="datosDirectivosf">
                </div>
                <div class="form-group">
                <label for="nombreviceDirectorf" class="col-form-label">Nombre del Vice-Director:</label>
                <input type="text" class="form-control" id="nombreviceDirectorf">
                </div>
                <div class="form-group">
                <label for="datosviceDirectorf" class="col-form-label">Datos del Vice-Director:</label>
                <input type="text" class="form-control" id="datosviceDirectorf">
                </div>
                <div class="form-group">
                <label for="nombreasesoraf" class="col-form-label">Nombre del Asesor:</label>
                <input type="text" class="form-control" id="nombreasesoraf">
                </div>
                <div class="form-group">
                <label for="datosasesoraf" class="col-form-label">Datos del Asesor:</label>
                <input type="text" class="form-control" id="datosasesoraf">
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
      
  
</div>


 <script type="text/javascript">
$(document).ready(function(){

datosDirectivosAdmin();

$("#btnNuevo_Directivo").click(function(){

    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Edite los Datos del Directivos");            
    $("#modalCRUD_DatosDirectivos").modal("show");

    datosDirectivosAdmin(); 


}); 






$("#formDatosDirec").submit(function(e){
    e.preventDefault();    
 
    nombreDirectivos= $("#nombreDirectivosf").val();
    datosDirectivos= $("#datosDirectivosf").val();

    nombreviceDirector= $("#nombreviceDirectorf").val();
    datosviceDirector= $("#datosviceDirectorf").val();

    nombreasesora= $("#nombreasesoraf").val();
    datosasesora= $("#datosasesoraf").val();

 console.log({nombreDirectivos:nombreDirectivos, datosDirectivos:datosDirectivos, nombreviceDirector:nombreviceDirector, datosviceDirector:datosviceDirector, nombreasesora:nombreasesora, datosasesora:datosasesora});

    $.ajax({
        url: "bd/DatosDirectivosEditar.php",
        type: "POST",
        dataType: "json",
        data: {nombreDirectivos:nombreDirectivos, datosDirectivos:datosDirectivos, nombreviceDirector:nombreviceDirector, datosviceDirector:datosviceDirector, nombreasesora:nombreasesora, datosasesora:datosasesora},
        success: function(data){  
            console.log(data);

            nombreDirectivos = data.director.nombreDirectivos;
            datosDirectivos = data.director.datosDirectivos;

            nombreviceDirector = data.viceDirector.nombreviceDirector;
            datosviceDirector = data.viceDirector.datosviceDirector;

            nombreasesora = data.asesora.nombreasesora;
            datosasesora = data.asesora.datosasesora;

            $("#nombreDirectivos").html(nombreDirectivos);
            $("#nombreDirectivosf").val(nombreDirectivos);  
            $("#datosDirectivos").html(datosDirectivos);
            $("#datosDirectivosf").val(datosDirectivos);

            $("#nombreviceDirector").html(nombreviceDirector);
            $("#nombreviceDirectorf").val(nombreviceDirector);  
            $("#datosviceDirector").html(datosviceDirector);
            $("#datosviceDirectorf").val(datosviceDirector);
            
            $("#nombreasesora").html(nombreasesora);
            $("#nombreasesoraf").val(nombreasesora);  
            $("#datosasesora").html(datosasesora);
            $("#datosasesoraf").val(datosasesora);

                  
        }        
    });
    $("#modalCRUD_DatosDirectivos").modal("hide");    
    
});    
    

    
});



function datosDirectivosAdmin() {

   
  
    $.ajax({
        url: "bd/DatosDirectivosLeer.php",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data){  
            console.log(data);

            nombreDirectivos = data.director.nombreDirectivos;
            datosDirectivos = data.director.datosDirectivos;

            nombreviceDirector = data.viceDirector.nombreviceDirector;
            datosviceDirector = data.viceDirector.datosviceDirector;

            nombreasesora = data.asesora.nombreasesora;
            datosasesora = data.asesora.datosasesora;

            $("#nombreDirectivos").html(nombreDirectivos);
            $("#nombreDirectivosf").val(nombreDirectivos);  
            $("#datosDirectivos").html(datosDirectivos);
            $("#datosDirectivosf").val(datosDirectivos);

            $("#nombreviceDirector").html(nombreviceDirector);
            $("#nombreviceDirectorf").val(nombreviceDirector);  
            $("#datosviceDirector").html(datosviceDirector);
            $("#datosviceDirectorf").val(datosviceDirector);
            
            $("#nombreasesora").html(nombreasesora);
            $("#nombreasesoraf").val(nombreasesora);  
            $("#datosasesora").html(datosasesora);
            $("#datosasesoraf").val(datosasesora);

                  
        }        
    });
}


</script>

