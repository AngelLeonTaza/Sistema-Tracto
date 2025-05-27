/*===========================================
EDITAR Serie
=============================================*/
$(".tablas").on("click", ".btnEditarSerie", function(){

    var idSerie = $(this).attr("idSerie");
    var datos = new FormData();
    datos.append("idSerie", idSerie);

    $.ajax({
        url:"ajax/series.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            
                $("#editarSerie").val(respuesta["serie"]);
                $("#editarMarcaSerie").html(respuesta["marca"]);
                $("#editarMarcaSerie").val(respuesta["marca"]);
        },
    });
});


/*=============================================
ELIMINAR Serie
=============================================*/
$(".tablas").on("click", ".btnEliminarSerie", function(){

	 var idSerie = $(this).attr("idSerie");

	 Swal.fire({
	 	  title: "¿Esta seguro de eliminar Serie?",
		  text: "¡Si no lo está puede cancelár la acción!",
		  icon: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#3085d6",
		  cancelButtonColor: "#d33",
		  confirmButtonText: "Si, deseo elminar serie",
		  cancelButtonText: "Cancelar"
	 }).then(function(result){

	 	if(result.isConfirmed){

	 		window.location = "index.php?ruta=series&idSerie="+idSerie;

	 	}

	 });

})

