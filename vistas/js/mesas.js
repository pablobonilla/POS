/*=============================================
EDITAR MESA
=============================================*/
$(".tablas").on("click", ".btnEditarMesa", function(){

	var idMesa = $(this).attr("id");
		
	var datos = new FormData();
	datos.append("id", idMesa);

	
	$.ajax({
		url: "ajax/mesas.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

			 $("#editarMesa").val(respuesta["nombre"]);
			 $("#editarUbicacion").val(respuesta["ubicacion"]);
			 
     		$("#idMesa").val(respuesta["id"]);

     	},
     	error: function (jqXHR, exception) {
            console.log(jqXHR);
            alert(jqXHR);

            // Your error handling logic here..
        },

	})


})

/*=============================================
ELIMINAR MESA
=============================================*/
$(".tablas").on("click", ".btnEliminarMesa", function(){

	 var idMesa = $(this).attr("id");

	 swal({
	 	title: '¿Está seguro de borrar la categoría?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar Mesa!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=mesas&idMesa="+idMesa;

	 	}

	 })

})