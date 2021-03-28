function mesajeAdmiFuncion(mesajeAdmi) {

	var mesajeAd = [];
	
	   $.ajax({
        url: "bd/mensajeAdminLeer.php",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data){ 

        	console.log(data);

    
		            for (dat in data){
		            	mesajeAd.push(data[dat]);
		            }
  	
	            	mesajeAd.push(mesajeAdmi);
		            console.log(mesajeAd);


		            $.ajax({
					        url: "bd/mensajeAdmin.php",
					        type: "POST",
					        dataType: "json",
					        data: {mesajeAd:mesajeAd},
					        success: function(data){  
					            console.log(data);

					                  
					        }        
					    });


                  
        }        
    });









	
}

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
            
        
       

            var imagenPrevisualizacion = document.querySelector("#mostrarimagenLo");

            //  verificamos que sea PDF
           
                 imagenPrevisualizacion.src = url;

            $('#titulo').html('<title>'+tituloS+'</title>');
               
                  
        }        
    });

}