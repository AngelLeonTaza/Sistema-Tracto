//SUBIENDO LA FOTO DEL USUARIO

$(".nuevaImagenPedidoImplemento").change(function(){


	var imagen = this.files[0];

	console.log("imagen", imagen);

	//VALIDAR QUE LA IMAGEN SEA JPG O PGN

	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){


		$(".nuevaImagenPedidoImplemento").val("");

		Swal.fire({
			  title: "ERROR, La imagen debe estar en formato JPG o PNG",
			  icon: "error"

			});

	} else if(imagen["size"] > 2000000){

		$(".nuevaImagenPedidoImplemento").val("");

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
$(".tablas").on("click", ".btnEditarPedidoImplemento", function(){

    var idPedidoImplemento = $(this).attr("idPedidoImplemento");
    var datos = new FormData();
    datos.append("idPedidoImplemento", idPedidoImplemento);

    $.ajax({
        url:"ajax/pedidosimplementos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

			$("#idPedidoImplemento").val(respuesta["id"]);
            $("#editarNombreImplemento").val(respuesta["nombre"]);
            $("#editarDireccionImplemento").val(respuesta["direccion"]);
            $("#editarSolicitudImplemento").val(respuesta["solicitud"]);
            $("#editarTelefonoPedidoImplemento").val(respuesta["telefono"]);
            $("#editarEstadoSolicitudImplemento").val(respuesta["estado_solicitud"]);
            $("#editarDescripcionPedidoImplemento").val(respuesta["descripcion_pedido"]);

           if(respuesta["foto"] != ""){

       			$("#imagenActualPedidosImplemento").val(respuesta["foto"]);
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
$(".tablas").on("click", ".btnEliminarPedidoImplemento", function(){

	var idPedidoImplemento = $(this).attr("idPedidoImplemento");

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

			window.location = "index.php?ruta=pedidos-implementos&idPedidoImplemento="+idPedidoImplemento;

		}

	});

})

