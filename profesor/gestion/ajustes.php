
<!--INICIO del cont principal-->
<div class="container">
<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();


if (isset($_SESSION["s_usuarioProfesor"])){
$s_usuarioProfesor=$_SESSION['s_usuarioProfesor'];


         $c3onsulta = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo` FROM `datos_docentes` WHERE `dni`='$s_usuarioProfesor'";
        $r3esultado = $conexion->prepare($c3onsulta);
        $r3esultado->execute();
        $d3ata=$r3esultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($d3ata as $d3at) {
            $idDocente=$d3at['idDocente'];
            $nombre=$d3at['nombre'];
            $dni=$d3at['dni'];
            $domicilio=$d3at['domicilio'];
            $email=$d3at['email'];
            $telefono=$d3at['telefono'];
            $titulo=$d3at['titulo'];
          
         }






?>

<input hidden="" value="<?php echo $idDocente; ?>" id="idDocente">
<div class="container">
        <div class="row">
        		<div class="col-lg-12 p-2">
                  <h1 class="text-center">AJUSTES</h1>
                </div>
             
                <div class="col-lg-12 p-2">
                  <!-- Button trigger modal -->
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-outline-danger btn-block" id="cambiarContraseña" >
					  CAMBIO DE CONTRASEÑA
					</button>

                </div>

                <div class="col-lg-12 p-2">
                  <h5>DATOS PERSONALES</h5>
                </div>

                <div class="col-lg-12 p-2">
               		<form id="formDatos">
					  <div class="mb-3">
					    <label for="dniDocente" class="form-label">DNI del Docente</label>
					    <input type="text" class="form-control" id="dniDocente" aria-describedby="dniHelp" value="<?php echo $dni; ?>" title='No se Puede Editar el DNI- debera hablar con el administrador' readonly>
					    <div id="dniHelp" class="form-text">El numero de DNI es obligatorio</div>
					  </div>
					  <div class="mb-3">
					    <label for="nombreDocente" class="form-label">Apellido y Nombre del Docente</label>
					    <input type="text" class="form-control" id="nombreDocente" aria-describedby="nombreDocenteHelp" value="<?php echo $nombre; ?>" required>
					    <div id="nombreDocenteHelp" class="form-text">El nombre y apellido del docente es obligatorio</div>
					  </div>
					  <div class="mb-3">
					    <label for="domicilioDocente" class="form-label">Domicilio del Docente</label>
					    <input type="text" class="form-control" id="domicilioDocente" aria-describedby="domicilioHelp" value="<?php echo $domicilio; ?>" required>
					    <div id="domicilioHelp" class="form-text">El domicilio del docente es obligatorio</div>
					  </div>
					 <div class="mb-3">
					    <label for="emailDocente" class="form-label">Correo Electronico del Docente</label>
					    <input type="email" class="form-control" id="emailDocente" aria-describedby="emailDocenteHelp" value="<?php echo $email; ?>" required>
					    <div id="emailDocenteHelp" class="form-text">El Email del docente es obligatorio</div>
					  </div>
					  <div class="mb-3">
					    <label for="telefonoDocente" class="form-label">Telefono del Docente</label>
					    <input type="text" class="form-control" id="telefonoDocente" aria-describedby="telefonoDocenteHelp" value="<?php echo $telefono; ?>" required>
					    <div id="telefonoDocenteHelp" class="form-text">El Telefono del docente es obligatorio</div>
					  </div>
					  <div class="mb-3">
					    <label for="tituloDocente" class="form-label">Titulo que possee el Docente</label>
					    <input type="text" class="form-control" id="tituloDocente" aria-describedby="tituloDocenteHelp" value="<?php echo $titulo; ?>" required>
					    <div id="tituloDocenteHelp" class="form-text">El titulo del docente es obligatorio</div>
					  </div>

					  <div class="mb-3 form-check">
					    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
					    <label class="form-check-label" for="exampleCheck1">Verificación</label>
					  </div>
					  <button type="submit" class="btn btn-primary">Editar los datos personales</button>
					</form>
                </div>
   
        </div>
</div>



			<!-- Modal -->
					<div class="modal fade" id="modalCambioContraseña" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  				<div class="modal-dialog">
			   				 <div class="modal-content">
			      				<div class="modal-header">
			        				<h5 class="modal-title" id="exampleModalLabel">MODIFICAR LA CONTRASEÑA DE INGRESO A LA PLATAFORMA</h5>
			        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          				<span aria-hidden="true">&times;</span>
			        				</button>
			      				</div>
			      				<div class="modal-body">

			      					<form id="formContraseña">

			      					  <div class="form-group">
									    <label for="contraseñaVieja">Contraseña Actual</label>
									    <input type="password" class="form-control" id="contraseñaVieja" required>
									    
									  </div>
									  <hr class="sidebar-divider">
									  <div class="form-group">
									    <label for="nuevaContraseña">Nueva Contraseña</label>
									    <input type="password" class="form-control" id="nuevaContraseña" aria-describedby="nuevaContraseñaHelp" required>
									    <small id="nuevaContraseñaHelp" class="form-text text-muted">Debe tener entre 8 y 20 caracteres.</small>
									  </div>
									  <div class="form-group">
									    <label for="nuevaContraseña2">Repetir la Nueva Contraseña</label>
									    <input type="password" class="form-control" id="nuevaContraseña2" aria-describedby="nuevaContraseñaHelp2" required>
									    <small id="nuevaContraseñaHelp2" class="form-text text-muted">Debe tener entre 8 y 20 caracteres.</small>
									  </div>

									<hr class="sidebar-divider">	
									  <div class="form-check">
									    <input type="checkbox" class="form-check-input" id="nuevaContr" required>
									    <label class="form-check-label" for="nuevaContr">Verificacion</label>
									  </div>
									  <button type="submit" class="btn btn-primary">Guardar la Nueva Contraseña</button>
									</form>


			        
			      				</div>
			      			<div class="modal-footer">
			        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        		
			     			</div>
			    		</div>
				 	</div>
				</div>


 <script type="text/javascript">
$(document).ready(function(){

$('#imagenProceso').hide();
  
		$("#cambiarContraseña").click(function(){

		    $("#formContraseña").trigger("reset");
		    $(".modal-header").css("background-color", "#1cc88a");
		    $(".modal-header").css("color", "white");
		    $(".modal-title").text("MODIFICAR LA CONTRASEÑA DE INGRESO A LA PLATAFORMA");            
		    $("#modalCambioContraseña").modal("show"); 

		    
		}); 



		$("#formDatos").submit(function(e){
		    e.preventDefault();    
		 
		    idDocente = $.trim($("#idDocente").val());
		    
		   
		    nombreDocente = $.trim($("#nombreDocente").val());
		    domicilioDocente = $.trim($("#domicilioDocente").val());
		    emailDocente = $.trim($("#emailDocente").val());
		    telefonoDocente = $.trim($("#telefonoDocente").val());
		    tituloDocente = $.trim($("#tituloDocente").val());
		    
		  
		    $.ajax({
		          type:"post",
		          data:'idDocente=' + idDocente + '&nombreDocente=' + nombreDocente + '&domicilioDocente=' + domicilioDocente + '&emailDocente=' + emailDocente + '&telefonoDocente=' + telefonoDocente + '&tituloDocente=' + tituloDocente,
		          url:'bd/datosDocente.php',
		          success:function(r){

		          	if (r==1) {

		          		let timerInterval
								Swal.fire({
								  title: 'MUY BIEN',
								  html: '<h5>Redireccionando</h5>',
								  timer: 2000,
								  timerProgressBar: true,
								  didOpen: () => {
								    Swal.showLoading()
								    timerInterval = setInterval(() => {
								      const content = Swal.getContent()
								      if (content) {
								        const b = content.querySelector('b')
								        if (b) {
								          b.textContent = Swal.getTimerLeft()
								        }
								      }
								    }, 100)
								  },
								  willClose: () => {
								    clearInterval(timerInterval)
								  }
								}).then((result) => {
								  /* Read more about handling dismissals below */
								  if (result.dismiss === Swal.DismissReason.timer) {
								    location.href="../profesor/";
								  }
								})

		          	

		          	}else{
		          		alert('Error Servidor')
		          	}
		          
		           
		          
		        }
		     });


		}); 



		$("#formContraseña").submit(function(e){
		    e.preventDefault();    
		 
		    idDocente = $.trim($("#idDocente").val());
		    contraseñaVieja = $.trim($("#contraseñaVieja").val());
		    nuevaContraseña = $.trim($("#nuevaContraseña").val());
		    nuevaContraseña2 = $.trim($("#nuevaContraseña2").val());

		   
		  
		  if (nuevaContraseña==nuevaContraseña2) {
		  
		  	   $.ajax({
		          type:"post",
		          data:'idDocente=' + idDocente + '&contraseñaVieja=' + contraseñaVieja + '&nuevaContraseña=' + nuevaContraseña,
		          url:'bd/contraseñaDocente.php',
		          success:function(r){

		          	if (r==1) {

		          		let timerInterval
								Swal.fire({
								  title: 'MUY BIEN',
								  html: '<h5>Redireccionando</h5>',
								  timer: 2000,
								  timerProgressBar: true,
								  didOpen: () => {
								    Swal.showLoading()
								    timerInterval = setInterval(() => {
								      const content = Swal.getContent()
								      if (content) {
								        const b = content.querySelector('b')
								        if (b) {
								          b.textContent = Swal.getTimerLeft()
								        }
								      }
								    }, 100)
								  },
								  willClose: () => {
								    clearInterval(timerInterval)
								  }
								}).then((result) => {
								  /* Read more about handling dismissals below */
								  if (result.dismiss === Swal.DismissReason.timer) {
								    location.href="../";
								  }
								})

		          	

		          	}else if(r==2){
		          			Swal.fire({
									  icon: 'error',
									  title: 'ERROR',
									  text: 'LA CONTRASEÑA VIEJA ES INCORRECTA, CONSULTE CON EL ADMINISTRADOR',
									  footer: '<a href>Why do I have this issue?</a>'
									})
		          	}else{
		          		alert('Error Servidor');
		          	}
		          
		           
		          
		        }
		     });



		  }else{
		  	alert('contraseña diferente');
		  }

		});    
    

    
});

</script>


<?php  } ?>

