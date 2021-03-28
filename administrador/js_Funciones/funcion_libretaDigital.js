function botonNotas(idIns) {


		$.ajax({
		          type:"post",
		          data:'idIns=' + idIns,
		          url:'modulosAdministracion/elementos/seccionLibretaDigital.php',
		          beforeSend: function() {
                  $("#imagenProceso").show();
                                
                              },
              success:function(r){
		          	

              $('#libreTaOcul').hide();
              $("#imagenProceso").hide();

            $('#libretaFina').load('modulosAdministracion/LibretaDigital.php');
                            

		            
		            
		          }
		        });



	
          
}


function botonAsignaturaPendiente(idAlumnos) {


    $.ajax({
              type:"post",
              data:'idAlumnos=' + idAlumnos,
              url:'modulosAdministracion/elementos/seccionPendienteApro.php',
              beforeSend: function() {
                  $("#imagenProceso").show();
                                
                              },
              success:function(r){
                

              $('#libreTaOcul').hide();
              $("#imagenProceso").hide();

            $('#libretaFina').load('modulosAdministracion/asignaturasPendientes.php');
                            

                
                
              }
            });



  
          
}




function botonDatosLibreta(idAlumno) {



  $.ajax({
    type:"post",
    data:'idAlumno=' + idAlumno,
    url:'modulosAdministracion/elementos/buscarDatosLibreta.php',
    success:function(res){

            console.log(res);

            data = res.split('||');

            promovido1 = data[0];            
            ob1 = data[1];
            lugarFecha1 = data[2];
     

    Swal.fire({
              title: 'Datos para la Ficha del Alumno',
              html:`<div class="col-12">
              <div class="form-group">
                  <label for="promovido" class="col-form-label">Promovido a:</label>
                  <input type="text" class="form-control" id="promovido" value='`+promovido1+`'>
              </div>
              <div class="form-group">
                  <label for="ob" class="col-form-label">OBSERVACIONES:</label>
                  <input type="text" class="form-control" id="ob" value='`+ob1+`'>
              </div>
              <div class="form-group">
                  <label for="lugarFecha" class="col-form-label">Lugar y Fecha:</label>
                  <input type="text" class="form-control" id="lugarFecha" value='`+lugarFecha1+`'>
              </div>
             
            </div>`, 
              focusConfirm: false,
              showCancelButton: true,                         
              }).then((result) => {
                if (result.value) {                                             
                  promovido = document.getElementById('promovido').value,
                  ob = document.getElementById('ob').value,
                  lugarFecha = document.getElementById('lugarFecha').value,
                
                 
                 ingresarDatosLibreta(idAlumno,promovido,ob,lugarFecha);
                                  
                }
        });



    }
  });


  
          
}

function ingresarDatosLibreta(idAlumno,promovido,ob,lugarFecha) {
  


  $.ajax({
    type:"post",
    data:'idAlumno=' + idAlumno +'&promovido=' + promovido +'&ob=' + ob +'&lugarFecha=' + lugarFecha,
    url:'bd/ingresarDatosLibretaAlumno.php',
    success:function(r){
      console.log(r);
      Swal.fire(
            'Muy bien !!',
            'Operación exitosa',
            'success'
          )

    }
  });

}










function botonDatosFicha(idAlumno) {



	$.ajax({
		type:"post",
		data:'idAlumno=' + idAlumno,
		url:'modulosAdministracion/elementos/buscarDatosFicha.php',
		success:function(res){

			  
            data = res.split('||');

            Libro = data[0];            
            Folio = data[1];
            nLegajo = data[2];
            nacionalidadAlumno = data[3];
            procedenciaAlumno = data[4];
            nacionalidadTutor = data[5];
            auxiliar = data[6];
            piePagina = data[7];
    


		Swal.fire({
              title: 'Datos para la Ficha del Alumno',
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
              		<label for="nLegajo" class="col-form-label">N° Lejajo:</label>
              		<input type="text" class="form-control" id="nLegajo" value='`+nLegajo+`'>
            	</div>
            	<div class="form-group">
              		<label for="nacionalidadAlumno" class="col-form-label">Nacido en (del alumno):</label>
              		<input type="text" class="form-control" id="nacionalidadAlumno" value='`+nacionalidadAlumno+`'>
            	</div>
            	<div class="form-group">
              		<label for="procedenciaAlumno" class="col-form-label">Procedencia del alumno:</label>
              		<input type="text" class="form-control" id="procedenciaAlumno" value='`+procedenciaAlumno+`'>
            	</div>
            	<div class="form-group">
              		<label for="nacionalidadTutor" class="col-form-label">Nacionalidad del Tutor:</label>
              		<input type="text" class="form-control" id="nacionalidadTutor" value='`+nacionalidadTutor+`'>
            	</div>
            	<div class="form-group">
              		<label for="auxiliar" class="col-form-label">Auxiliar Docente:</label>
              		<input type="text" class="form-control" id="auxiliar" value='`+auxiliar+`'>
            	</div>
              <div class="form-group">
                  <label for="piePagina" class="col-form-label">Observaciones(Pie de Pagina):</label>
                 
                  <textarea class="form-control" id="piePagina" rows="5">`+piePagina+`</textarea>
              </div>
            </div>`, 
              focusConfirm: false,
              showCancelButton: true,                         
              }).then((result) => {
                if (result.value) {                                             
                  Libro = document.getElementById('Libro').value,
                  Folio = document.getElementById('Folio').value,
                  nLegajo = document.getElementById('nLegajo').value,
                  nacionalidadAlumno = document.getElementById('nacionalidadAlumno').value,
                   procedenciaAlumno = document.getElementById('procedenciaAlumno').value,
                   nacionalidadTutor = document.getElementById('nacionalidadTutor').value,
                   auxiliar = document.getElementById('auxiliar').value,
                   piePagina = document.getElementById('piePagina').value,
                 
                 ingresarDatosFicha(idAlumno,Libro,Folio,nLegajo,nacionalidadAlumno,procedenciaAlumno,nacionalidadTutor,auxiliar,piePagina);
                                  
                }
        });



		}
	});


	
          
}

function ingresarDatosFicha(idAlumno,Libro,Folio,nLegajo,nacionalidadAlumno,procedenciaAlumno,nacionalidadTutor,auxiliar,piePagina) {
	
	$.ajax({
		type:"post",
		data:'idAlumno=' + idAlumno +'&Libro=' + Libro +'&Folio=' + Folio +'&nLegajo=' + nLegajo +'&nacionalidadAlumno=' + nacionalidadAlumno +'&procedenciaAlumno=' + procedenciaAlumno +'&nacionalidadTutor=' + nacionalidadTutor +'&auxiliar=' + auxiliar +'&piePagina=' + piePagina,
		url:'bd/ingresarDatosFichaAlumno.php',
		success:function(r){

			Swal.fire(
					  'Muy bien !!',
					  'Operación exitosa',
					  'success'
					)

		}
	});

}