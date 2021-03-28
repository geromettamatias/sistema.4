
<!--INICIO del cont principal-->
<div class="container">
 
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                  
                 <button id="btnNuevo_Historia" type="button" class="btn btn-success" data-toggle="modal">Historia- Editar</button><br><br>
                <h3><u><b>HISTORIA</b></u></h3>
                 <h5><b>informe:</b><div id="historiaLeer" style="color:#FF0000";></div></h5>
                 

                </div>
        </div>  
</div>    
      

        
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD_historia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formhistoria">    
                         
            <div class="modal-body">
                

                <div class="form-group">
                <label for="historiaf" class="col-form-label">Historia:</label>
                
                <textarea class="form-control" rows="10" id="historiaf"></textarea>
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
historia();

$("#btnNuevo_Historia").click(function(){

    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Edite la historia");            
    $("#modalCRUD_historia").modal("show");

    historia(); 


}); 






$("#formhistoria").submit(function(e){
    e.preventDefault();    
 
    historiaf= $("#historiaf").val();
   

 console.log({historiaf:historiaf});

    $.ajax({
        url: "bd/historiaEditar.php",
        type: "POST",
        dataType: "json",
        data: {historiaf:historiaf},
        success: function(data){  
            console.log(data);

            informe = data.historia.informe;
           

            $("#historiaLeer").html(informe);
            $("#historiaf").val(informe);
           

                  
        }        
    });
    $("#modalCRUD_historia").modal("hide");    
    
});    
    

    
});



function historia() {

   
  
        $.ajax({
        url: "bd/historiaLeer.php",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data){  
            console.log(data);

            informe = data.historia.informe;
           

            
            $("#historiaLeer").html(informe);
            $("#historiaf").val(informe);


                  
        }        
    });
}


</script>

