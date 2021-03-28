$(document).ready(function(){

    $('#imagenProceso').hide();
    $('#mensajeAlumno').load('mensajes/mensajeBoton.php');
    $('#mensajeProfesor').load('mensajes/mensajeBotonDocente.php');
    cargaDatoPagina();






     $("#planillaCentralizadora").click(function(){ 
        $('#imagenProceso').show();
         $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
      
        $('#buscarTablaInstitucional').html(''); 
        $('#buscarTablaInstitucional').load('centralizadora/buscarPrimero.php');
        $('#contenidoAyuda').html(''); 
          


  
    }); 



     $("#usuarioOtro").click(function(){ 
        $('#imagenProceso').show();
         $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
      
        $('#buscarTablaInstitucional').html(''); 
        $('#tablaInstitucional').load('usuarios/usuarioOtro.php');
        $('#contenidoAyuda').html(''); 
          


  
    }); 

    $("#usuarioAdmin").click(function(){ 
        $('#imagenProceso').show();
         $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
      
        $('#buscarTablaInstitucional').html(''); 
        $('#tablaInstitucional').load('usuarios/usuarioSistema.php');
        $('#contenidoAyuda').html(''); 
          


  
    });






    $("#datos_Institucion").click(function(){ 
        $('#imagenProceso').show();
         $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
      
        $('#buscarTablaInstitucional').html(''); 
        $('#tablaInstitucional').load('modulosCarga/institucion/datos_Institucion.php');
        $('#contenidoAyuda').html(''); 
          


  
    });



        

    
      $("#ciclo").click(function(){
        $('#imagenProceso').show();

         $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');

        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').load('modulosAdministracion/cicloLectivo.php');
          


    
    });




    $("#encabesados").click(function(){
        $('#imagenProceso').show();
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').html('');
        $('#buscarTablaInstitucional').load('modulosAdministracion/encabesados/buscarCicloLectivo.php');
             
    });

     $("#datosPlanEstudios").click(function(){
        $('#imagenProceso').show();
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').load('modulosCarga/planEstudio/planEstudios.php');
         


      });

     $("#asignaturas").click(function(){
        $('#imagenProceso').show();
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').load('modulosCarga/asignaturas/asignaturas_Selec.php');
         


      });




      $("#cursos").click(function(){
        $('#imagenProceso').show();
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulosCarga/curso/Selepcion_Curso.php');
        
            

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

    $("#cargaUsuarios").click(function(){
        $('#imagenProceso').show();
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').load('usuarios/usuarioSistema.php');
            
    });


    $("#inscripNota").click(function(){

        $('#imagenProceso').show();
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
         $('#buscarTablaInstitucional').load('modulosAdministracion/Inscrp_BuscarCursos.php');
      
        $('#tablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
          


      
  
    });


    $("#libretaDigital").click(function(){



        $('#imagenProceso').show();
        $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        $('#buscarTablaInstitucional').html('');
        $('#buscarTablaInstitucional').load('modulosAdministracion/Inscrp_BuscarCursosLibretaDigitalPri.php');
         
      
        $('#contenidoAyuda').html(''); 
          


    });


 


    $("#posteo").click(function(){
    
    $('#imagenProceso').show();
       $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
    $('#buscarTablaInstitucional').html(''); 
     $('#tablaInstitucional').load('modulosAdministracion/posteo.php');
    $('#contenidoAyuda').html(''); 
    

    });

    $("#actas").click(function(){
            $('#imagenProceso').show();
               $('#contenidoCursos').html('');
       
        $('#tablaInstitucional').html(''); 
         $('#buscarTablaInstitucional').load('modulosAdministracion/actasBuscar.php');
        $('#contenidoAyuda').html(''); 
        

    
    });




    $("#analiticos").click(function(){
      $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulosAdministracion/alumnosAnalitico1.php');  
         
    });

     $("#asistenciaAlumno").click(function(){
        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('asistencias/asistenciaAlumno.php');
        
         
    });

      $("#asistenciaDocente").click(function(){
        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('asistencias/asistenciaDocente.php');
        

        
    });

    $("#directivoDatos").click(function(){
      $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('paginaPrincipal/datosDire.php');
        
      
        
    });

     $("#novedades").click(function(){
      $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('paginaPrincipal/novedades.php');
        
      
        
    });

      $("#historia").click(function(){
        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('paginaPrincipal/historia.php');
        
      
        
    });

       $("#circularProfe").click(function(){
        $('#imagenProceso').show();
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

    $("#datosSitio").click(function(){
      $('#imagenProceso').show();

        $('#contenidoAyuda').html(''); 
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('datosAplicativo/datosAplicativo.php');
        
     
                  
   
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


           var imagenPrevisualizacion = document.querySelector("#logoImagen");

            //  verificamos que sea PDF
           
               imagenPrevisualizacion.src = "../"+url+"";

        $('#tituloMenuURL').val(url);

          $('#titulo').html('<title>'+tituloS+'</title>');    
                      $("#tituloMenu").html(tituloMenuS);
                           
                  
        }        
    });

}