$(document).ready(function(){

    $('#imagenProceso').hide();
  
    cargaDatoPagina();



    


     $("#planillaCentralizadora").click(function(){ 
        $('#imagenProceso').show();
         $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
      
        $('#buscarTablaInstitucional').html(''); 
        $('#buscarTablaInstitucional').load('centralizadora/buscarPrimero.php');
        $('#contenidoAyuda').html(''); 
          


  
    }); 





    $("#cargaAlumno").click(function(){
        $('#imagenProceso').show();
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').load('modulosCarga/alumno/alumnos.php');
        
    });

    $("#cargaDocente").click(function(){
        $('#imagenProceso').show();
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').load('modulosCarga/docente/docente.php');
        
    });

   



    $("#libretaDigital").click(function(){



        $('#imagenProceso').show();
        $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        $('#buscarTablaInstitucional').html('');
        $('#buscarTablaInstitucional').load('modulosAdministracion/Inscrp_BuscarCursosLibretaDigitalPri.php');
         
      
        $('#contenidoAyuda').html(''); 
          


    });


 



    $("#actas").click(function(){
            $('#imagenProceso').show();
               $('#contenidoCursos').html('');
       
        $('#tablaInstitucional').html(''); 
         $('#buscarTablaInstitucional').load('modulosAdministracion/actasBuscar.php');
        $('#contenidoAyuda').html(''); 
        

    
    });





      $("#asistenciaDocente").click(function(){
        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('asistencias/asistenciaDocente.php');
        
        
    });

  


       $("#circularProfe").click(function(){
        $('#contenidoAyuda').html(''); 
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('anuncios/circulares.php');
        
      
        
    });

       $("#anuncioAlumno").click(function(){
        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('anunciosAlumnos/anunciosAlumno.php');
        
     
        
    });

         $("#mensajePublico").click(function(){
            $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('mensajePagina/mensajePaginaPrincipal.php');
        
     
        
    });

       $("#anuncioProfe").click(function(){
        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        
        $('#tablaInstitucional').load('anunciosDocentes/anunciosDocentes.php');
        
      
        
    });

    $("#logoutModalfINAL").click(function(){
        $('#imagenProceso').show();

    $(".modal-header").css("background-color", "#DC1738");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("¿Confirma salir y cerrar Sesión?");            
        $('#imagenProceso').hide();
  }); 





});
















 



















function cargaDatoPagina() {
  
  
        $.ajax({
        url: "bd/datoAplicativoLeer.php",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data){  
       
            tituloS = data.titulo;
            tituloMenuS = data.tituloMenu;
            url = data.url;
            
        
          
            

            $('#logoImagenF').val('<img src="'+url+'" type="reset"  style="width: 40%;" class="mx-auto d-block">');

        

            var imagenPrevisualizacion = document.querySelector("#mostrarimagenLo");

            //  verificamos que sea PDF
           
                 imagenPrevisualizacion.src = "../"+url+"";


        $('#tituloMenuURL').val(url);

          $('#titulo').html('<title>'+tituloS+'</title>');    
                      $("#tituloMenu").html(tituloMenuS);
                           
                  
        }        
    });

}