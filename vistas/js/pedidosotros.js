//SUBIENDO LA FOTO DEL USUARIO

$(".nuevaImagenPedidoOtro").change(function(){


	var imagen = this.files[0];

	console.log("imagen", imagen);

	//VALIDAR QUE LA IMAGEN SEA JPG O PGN

	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){


		$(".nuevaImagenPedidoOtro").val("");

		Swal.fire({
			  title: "ERROR, La imagen debe estar en formato JPG o PNG",
			  icon: "error"

			});

	} else if(imagen["size"] > 2000000){

		$(".nuevaImagenPedidoOtro").val("");

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
$(".tablas").on("click", ".btnEditarPedidoOtro", function(){

    var idPedidoOtro = $(this).attr("idPedidoOtro");
    var datos = new FormData();
    datos.append("idPedidoOtro", idPedidoOtro);

    $.ajax({
        url:"ajax/pedidosotros.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

			$("#idPedidoOtro").val(respuesta["id"]);
            $("#editarNombreOtro").val(respuesta["nombre"]);
            $("#editarDireccionOtro").val(respuesta["direccion"]);
            $("#editarSolicitudOtro").val(respuesta["solicitud"]);
            $("#editarTelefonoPedidoOtro").val(respuesta["telefono"]);
            $("#editarEstadoSolicitudOtro").val(respuesta["estado_solicitud"]);
            $("#editarDescripcionPedidoOtro").val(respuesta["descripcion_pedido"]);

           if(respuesta["foto"] != ""){

       			$("#imagenActualPedidosOtro").val(respuesta["foto"]);
	           	$(".previsualizar").attr("src",  respuesta["foto"]);

           } else{

	           $(".previsualizar").attr("src",  "vistas/img/productos/default/anonymous.png");

           }
                
         }
        })

    });

/*=============================================
ELIMINAR Pedido
=============================================*/
$(".tablas").on("click", ".btnEliminarPedidoOtro", function(){

	var idPedidoOtro = $(this).attr("idPedidoOtro");

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

			window.location = "index.php?ruta=pedidos-otros&idPedidoOtro="+idPedidoOtro;

		}

	});

})

