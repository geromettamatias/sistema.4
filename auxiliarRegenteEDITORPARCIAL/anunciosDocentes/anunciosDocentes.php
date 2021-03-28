
<!--INICIO del cont principal-->
<div class="container">
 
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                  
                 <button id="btnNuevo_AnunciosDocente" type="button" class="btn btn-success" data-toggle="modal">Anuncios- Editar</button><br><br>
                <h3><u><b>Anuncios</b></u></h3>
                 <h5><b>informe:</b><div id="anunciosLeer" style="color:#FF0000";></div></h5>
                 

                </div>
        </div>  
</div>    
      

        
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD_anunciosDocente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formAnuncio">    
                         
            <div class="modal-body">
                

                <div class="form-group">
                <label for="anunciosf" class="col-form-label">Anuncio:</label>
                
                <textarea class="form-control" rows="10" id="anunciosf"></textarea>
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
anuncioDocente();

$("#btnNuevo_AnunciosDocente").click(function(){

    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Edite el Anuncio de los Docentes");            
    $("#modalCRUD_anunciosDocente").modal("show");

    anuncioDocente(); 


}); 






$("#formAnuncio").submit(function(e){
    e.preventDefault();    
 
    anunciosf= $("#anunciosf").val();
   

    ingresarDocenteAlumno(anunciosf);


    $("#modalCRUD_anunciosDocente").modal("hide");    
    
});    
    

    
});








function ingresarDocenteAlumno(anunciosf) {



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
                    ingresarAnuncioDocenteFina(anunciosf);
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


function ingresarAnuncioDocenteFina(anunciosf) {
    
   $.ajax({
        url: "bd/anuncioEditarDocente.php",
        type: "POST",
        dataType: "json",
        data: {anunciosf:anunciosf},
        success: function(data){  
            console.log(data);

            info = data.anuncio.informe;
           

            $("#anunciosLeer").html(info);
            $("#anunciosf").val(info);
           

                  
        }        
    });
}







function anuncioDocente() {

   
  
        $.ajax({
        url: "bd/anuncioLeerDocente.php",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data){  
            console.log(data);

            info = data.anuncio.informe;
           

            
            $("#anunciosLeer").html(info);
            $("#anunciosf").val(info);


                  
        }        
    });
}


</script>



