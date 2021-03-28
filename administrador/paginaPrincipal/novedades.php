
<!--INICIO del cont principal-->
<div class="container">
 
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                  
                 <button id="btnNuevo_Novedades" type="button" class="btn btn-success" data-toggle="modal">Novedades- Editar</button><br><br>
                <h3><u><b>NOVEDADES</b></u></h3>
                 <h5><b>Información:</b><div id="novedadesLeer" style="color:#FF0000";></div></h5>
                 

                </div>
        </div>  
</div>    
      

        
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD_novedades" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formnovedades">    
                         
            <div class="modal-body">
                

                <div class="form-group">
                <label for="novedadesf" class="col-form-label">NOVEDAES:</label>
                
                <textarea class="form-control" rows="10" id="novedadesf"></textarea>
                </div>
               
                
                <h5><b><u>Aclaración:</b></u> El Texto debe poseer las etiquetas html (para que reconosca los estilos).<br><b><u>Tutoriales:</b></u><a href="http://www.manualweb.net/html/texto-basico-html/" target="_blank">Texto basico -html</a></h5>

            

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
$('#imagenProceso').hide();
novedades();

$("#btnNuevo_Novedades").click(function(){

    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Edite las novedades");            
    $("#modalCRUD_novedades").modal("show");

    novedades(); 


}); 






$("#formnovedades").submit(function(e){
    e.preventDefault();    
 
    novedadesf= $("#novedadesf").val();
   

 console.log({novedadesf:novedadesf});

    $.ajax({
        url: "bd/novedadesEditar.php",
        type: "POST",
        dataType: "json",
        data: {novedadesf:novedadesf},
        success: function(data){  
            console.log(data);

            informe = data.novedades.informe;
           

            $("#novedadesLeer").html(informe);
            $("#novedadesf").val(informe);


                  
        }        
    });
    $("#modalCRUD_novedades").modal("hide");    
    
});    
    

    
});



function novedades() {

   
  
        $.ajax({
        url: "bd/novedadesLeer.php",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data){  
            console.log(data);

            informe = data.novedades.informe;
       
            $("#novedadesLeer").html(informe);
            $("#novedadesf").val(informe);

                  
        }        
    });
}


</script>

