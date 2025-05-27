//SUBIENDO LA FOTO DEL USUARIO

$(".nuevaImagenPedido").change(function(){


	var imagen = this.files[0];

	console.log("imagen", imagen);

	//VALIDAR QUE LA IMAGEN SEA JPG O PGN

	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){


		$(".nuevaImagenPedido").val("");

		Swal.fire({
			  title: "ERROR, La imagen debe estar en formato JPG o PNG",
			  icon: "error"

			});

	} else if(imagen["size"] > 2000000){

		$(".nuevaImagenPedido").val("");

		Swal.fire({
			  title: "ERROR, La imagen es muy grande",
			  icon: "error"

			});
	} else{

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on("load", function(event){

			var rutaImagen = event.target.result;

			$(".previsualizar").attr("src", rutaImagen);

		})

	}
})

/*===========================================
EDITAR PEDIDO TRACTORES
=============================================*/
$(".tablas").on("click", ".btnEditarPedidoTractor", function(){

    var idPedidoTractor = $(this).attr("idPedidoTractor");
    var datos = new FormData();
    datos.append("idPedidoTractor", idPedidoTractor);

    $.ajax({
        url:"ajax/pedidostractores.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

			$("#idPedidoTractor").val(respuesta["id"]);
            $("#editarNombre").val(respuesta["nombre"]);
            $("#editarDireccion").val(respuesta["direccion"]);
            $("#editarSolicitud").val(respuesta["solicitud"]);
            $("#editarTelefonoPedido").val(respuesta["telefono"]);
            $("#editarEstadoSolicitud").val(respuesta["estado_solicitud"]);
            $("#editarDescripcionPedido").val(respuesta["descripcion_pedido"]);

           if(respuesta["foto"] != ""){

       			$("#imagenActualPedidosTractores").val(respuesta["foto"]);
	           	$(".previsualizar").attr("src",  respuesta["foto"]);

           } else{

	           $(".previsualizar").attr("src",  "vistas/img/productos/default/anonymous.png");

           }
                
         }
        })

		var elemento = $("#editarTelefonoPedido").val();


		console.log(elemento);
    });

/*=============================================
ELIMINAR Pedido
=============================================*/
$(".tablas").on("click", ".btnEliminarPedidoTractor", function(){

	var idPedidoTractor = $(this).attr("idPedidoTractor");

	Swal.fire({
		  title: "¿Esta seguro de eliminar el Pedido?",
		 text: "¡Si no lo está puede cancelár la acción!",
		 icon: "warning",
		 showCancelButton: true,
		 confirmButtonColor: "#3085d6",
		 cancelButtonColor: "#d33",
		 confirmButtonText: "Si, deseo elminar marca",
		 cancelButtonText: "Cancelar"

	}).then(function(result){

		if(result.isConfirmed){

			window.location = "index.php?ruta=pedidos-tractores&idPedidoTractor="+idPedidoTractor;

		}

	});

})

