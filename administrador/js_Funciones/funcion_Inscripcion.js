function botonInscripcion() {
    $("#contenidoAyuda").toggle();
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Matriculación");            
    $("#modalCRUD_tablaAlumnoMatriculacion").modal("show");
}

function botonInscribir(datos) {

    $("#imagenProceso").show();
    document.getElementById("eliminarMatricula").disabled = true;
    document.getElementById("cambiar").disabled = true;
    document.getElementById("incrpAlumnoMatric").disabled = true;
    cursoSe = $("#cursoSe").val();
    d=datos.split('||');
    idAlumnos=d[0];
    idIns = null; 
    opcion=1;
    $.ajax({
          type:"post",
          data:'idAlumnos=' + idAlumnos + '&cursoSe=' + cursoSe+ '&idIns=' + idIns+ '&opcion=' + opcion,
          url:'bd/crud_inscripcion.php',
          success:function(data){
            console.log(data);
             
            agregarCursoAlumno(data);

             v=data.split('||');

              
                nombre = v[3];

                    $("#asig-"+idAlumnos).html(nombre);
                    
                    document.getElementById("boton-"+idAlumnos).disabled = true;
                   

         }
    });
    $("#imagenProceso").hide();
    document.getElementById("eliminarMatricula").disabled = false;
    document.getElementById("cambiar").disabled = false;
    document.getElementById("incrpAlumnoMatric").disabled = false;

    Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Se actualizo los registros',
                            showConfirmButton: false,
                            timer: 500
                          });
    }






















