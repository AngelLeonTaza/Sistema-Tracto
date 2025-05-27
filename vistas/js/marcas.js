/*=============================================
EDITAR Marca
=============================================*/
$(".tablas").on("click", ".btnEditarMarca", function(){

	var idMarca = $(this).attr("idMarca");

	var datos = new FormData();
	datos.append("idMarca", idMarca);

	$.ajax({
		url: "ajax/marcas.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		$("#editarMarca").val(respuesta["marca"]);
     		$("#idMarca").val(respuesta["id"]);

     	}

	});

})

/*=============================================
ELIMINAR Marca
=============================================*/
$(".tablas").on("click", ".btnEliminarMarca", function(){

	 var idMarca = $(this).attr("idMarca");

	 Swal.fire({
	 	  title: "¿Esta seguro de eliminar Marca?",
		  text: "¡Si no lo está puede cancelár la acción!",
		  icon: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#3085d6",
		  cancelButtonColor: "#d33",
		  confirmButtonText: "Si, deseo elminar marca",
		  cancelButtonText: "Cancelar"
	 }).then(function(result){

	 	if(result.isConfirmed){

	 		window.location = "index.php?ruta=marcas&idMarca="+idMarca;

	 	}

	 });

})

