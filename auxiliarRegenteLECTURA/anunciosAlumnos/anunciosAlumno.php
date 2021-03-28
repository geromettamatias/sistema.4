
<!--INICIO del cont principal-->
<div class="container">
 
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                  
                 
                <h3><u><b>Anuncios</b></u></h3>
                 <h5><b>informe:</b><div id="anunciosLeer" style="color:#FF0000";></div></h5>
                 

                </div>
        </div>  
</div>    
      




 <script type="text/javascript">
$(document).ready(function(){
$('#imagenProceso').hide();
anuncioAlumno();


    
});



function anuncioAlumno(anunciosf) {

   
  
        $.ajax({
        url: "bd/anuncioLeerAlumno.php",
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



