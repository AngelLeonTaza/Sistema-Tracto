/*=============================================
CARGAR LA TABLA DINÁMICA DE PRODUCTOS
=============================================*/

$('.tablaProductos').DataTable( {
	"ajax": "ajax/datatable-productos.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	"language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrando _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar: ",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}
} );


//GENERAR CODIGO
function generarCodigo() {
    var longitudCodigo = 9;
    var caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    var codigo = '';

    for (var i = 0; i < longitudCodigo; i++) {
        var index = Math.floor(Math.random() * caracteres.length);
        codigo += caracteres.charAt(index);
    }

    return codigo;
}


$(".btnAgregarProductoCodigo").click(function () {
    // Generar un código único
    var nuevoCodigo = generarCodigo();
    // Puedes cambiar esto por el texto que quieras imprimir
    document.getElementById("nuevoCodigo").value = nuevoCodigo;
});


/*=============================================
AGREGANDO PRECIO DE VENTA
=============================================*/
$("#nuevoPrecioCompra, #editarPrecioCompra").change(function(){

	if($(".porcentaje").prop("unchecked")){

		var valorPorcentaje = $(".nuevoPorcentaje").val();
		
		var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());

		//var editarPorcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());

		$("#nuevoPrecioVenta").val(porcentaje);
		$("#nuevoPrecioVenta").prop("readonly",true);

		//$("#editarPrecioVenta").val(editarPorcentaje);
		//$("#editarPrecioVenta").prop("readonly",true);

	}

})

/*=============================================
CAMBIO DE PORCENTAJE
=============================================*/
$(".nuevoPorcentaje").change(function(){

	if($(".porcentaje").prop("checked")){

		var valorPorcentaje = $(this).val();
		
		var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());

		//var editarPorcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());

		$("#nuevoPrecioVenta").val(porcentaje);
		$("#nuevoPrecioVenta").prop("readonly",true);

		//$("#editarPrecioVenta").val(editarPorcentaje);
		//$("#editarPrecioVenta").prop("readonly",true);

	}

})

$(".porcentaje").on("ifUnchecked",function(){

	$("#nuevoPrecioVenta").prop("readonly",false);
	//$("#editarPrecioVenta").prop("readonly",false);

})

$(".porcentaje").on("ifChecked",function(){

	$("#nuevoPrecioVenta").prop("readonly",true);
	//$("#editarPrecioVenta").prop("readonly",true);

})

/*=============================================
SUBIENDO LA FOTO DEL PRODUCTO
=============================================*/


$(".nuevaImagen").change(function(){


	var imagen = this.files[0];

	console.log("imagen", imagen);

	//VALIDAR QUE LA IMAGEN SEA JPG O PGN

	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){


		$(".nuevaImagen").val("");

		Swal.fire({
			  title: "ERROR, La imagen debe estar en formato JPG o PNG",
			  icon: "error"

			});

	} else if(imagen["size"] > 2000000){

		$(".nuevaImagen").val("");

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

/*ver tabla*/


/*=============================================
EDITAR PRODUCTO
=============================================*/

$(".tablaProductos tbody").on("click", "button.btnEditarProducto", function(){

	var idProducto = $(this).attr("idProducto");
	
	var datos = new FormData();
    datos.append("idProducto", idProducto);

     $.ajax({

      url:"ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
          
          var datosMarca = new FormData();
          datosMarca.append("idMarca",respuesta["marca_producto"]);

           $.ajax({

              url:"ajax/marcas.ajax.php",
              method: "POST",
              data: datosMarca,
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success:function(respuesta){
                  
                  $("#editarMarca").val(respuesta["id"]);
                  $("#editarMarca").html(respuesta["marca"]);

              }

          })

           $("#editarSerie").val(respuesta["serie_producto"]);

           $("#editarParte").val(respuesta["parte_producto"]);

           $("#editarNombre").val(respuesta["nombre_producto"]);

           $("#editarCompatibilidad").val(respuesta["compatibilidades"]);

           $("#editarCodigo").val(respuesta["codigo_producto"]);

           $("#editarCodigoMundial").val(respuesta["codigo_mundial"]);

           $("#editarCodigoAlternativo").val(respuesta["codigo_alternativo"]);

           $("#editarDescripcion").val(respuesta["descripcion_producto"]);

           $("#editarUbicacion").val(respuesta["ubicacion"]);

           $("#editarStock").val(respuesta["stock"]);

           $("#editarPrecioCompra").val(respuesta["precio_compra"]);

           $("#editarPrecioVenta").val(respuesta["precio_venta"]);

           if(respuesta["imagen_producto"] != ""){

	           	$("#imagenActual").val(respuesta["imagen_producto"]);

	           	$(".previsualizar").attr("src",  respuesta["imagen_producto"]);

           }

      }

  })

})

/*=============================================
ELIMINAR PRODUCTO
=============================================*/

$(".tablaProductos tbody").on("click", "button.btnEliminarProducto", function(){

	var idProducto = $(this).attr("idProducto");
	var codigo = $(this).attr("codigo");
	var imagen = $(this).attr("imagen");
	
	Swal.fire({
	  title: "¿Esta seguro de eliminar el Producto?",
	  text: "¡Si no lo está puede cancelár la acción!",
	  icon: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#3085d6",
	  cancelButtonColor: "#d33",
	  confirmButtonText: "Si, deseo elminar producto",
	  cancelButtonText: "Cancelar"
	}).then(function(result){

    if(result.isConfirmed){

        	window.location = "index.php?ruta=productos&idProducto="+idProducto+"&imagen="+imagen+"&codigo="+codigo;

    }

  })
})

/*=============================================
VER PRODUCTO
=============================================*/

$(".tablaProductos tbody").on("click", "button.btnVerProducto", function(){

	var idProducto = $(this).attr("idProducto");
	
	var datos = new FormData();
    datos.append("idProducto", idProducto);

     $.ajax({

      url:"ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
          
          var datosMarca = new FormData();
          datosMarca.append("idMarca",respuesta["marca_producto"]);


           $.ajax({

              url:"ajax/marcas.ajax.php",
              method: "POST",
              data: datosMarca,
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success:function(respuesta){
                  
                  document.getElementById("verMarca").innerHTML = "<strong>MARCA: </strong>" + respuesta["marca"] + "|";

              }

          })
			

		   var datosSerie = new FormData(); 
           datosSerie.append("idSerie", respuesta["serie_producto"]);

           $.ajax({

              url:"ajax/series.ajax.php",
              method: "POST",
              data: datosSerie,
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success:function(respuesta){
                  
                  document.getElementById("verSerie").innerHTML = "<strong>SERIE: </strong>" + respuesta["serie"] + " |";

              }

          })

           	document.getElementById("verNombre").innerHTML = respuesta["nombre_producto"];
           	document.getElementById("verParte").innerHTML = "<strong>PARTE: </strong>" + respuesta["parte_producto"] + "|";
     	  	document.getElementById("verCompatibilidad").innerHTML = "<strong>COMPATIBILIDAD: </strong>" +respuesta["compatibilidades"];
           	document.getElementById("verCodigoMundial").innerHTML = "<strong>CÓDIGO MUNDIAL: </strong>" + respuesta["codigo_mundial"] + "|";
           	document.getElementById("verCodigoAlternativo").innerHTML = "<strong>CÓDIGO ALTERNATIVO: </strong>" + respuesta["codigo_alternativo"];
           	document.getElementById("verCodigoTienda").innerHTML = "<strong>CÓDIGO TIENDA: </strong>" + respuesta["codigo_producto"] + "|";
           	document.getElementById("verUbicacion").innerHTML = "<strong>UBICACIÓN: </strong>" +respuesta["ubicacion"];
     	  	document.getElementById("verDescripcion").innerHTML = "<strong>DESCRIPCIÓN: </strong>" +respuesta["descripcion_producto"];
     	  	document.getElementById("verPrecioVenta").innerHTML = "<strong>PRECIO VENTA: S/.</strong>" +respuesta["precio_venta"];
     	  	document.getElementById("verStock").innerHTML = "<strong>STOCK: </strong>" +respuesta["stock"];

			if(respuesta["imagen_producto"] != ""){


	           	$(".previsualizar").attr("src",  respuesta["imagen_producto"]);

           } else{

	           $(".previsualizar").attr("src",  "vistas/img/productos/default/anonymous.png");

           }

      }

  })

})




$(document).ready(function(){
    $('#nuevaMarca').change(function(){

        var selectedMarca = $(this).val();
		
        // Realizar la solicitud AJAX al servidor
        $.ajax({
            url: 'ajax/obtenerseries.ajax.php', // El archivo PHP que obtiene las series
            method: 'GET',
            data: {marca: selectedMarca},
            success: function(response){
                // Limpiar las opciones actuales del selector de series
                $('#nuevaSerie').html('<option value="">Selecciona una serie</option>');
                // Agregar las nuevas opciones de series obtenidas del servidor
                $('#nuevaSerie').append(response);
            }
        });
    });
});