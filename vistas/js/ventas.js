/*=============================================
CARGAR LA TABLA DINÁMICA DE VENTAS
=============================================*/

// $.ajax({

// 	url: "ajax/datatable-ventas.ajax.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// })// 

$('.tablaVentas').DataTable( {
    "ajax": "ajax/datatable-ventas.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
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





//BUSCAR CLIENTE

$("#btnBuscarClienteSistema").click(function(){
    var dniCliente = $("#buscarclientedeventa").val(); // Agrega los paréntesis para obtener el valor

    var datos = new FormData();
    datos.append("dniCliente", dniCliente);

    $.ajax({
        url: "ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

			console.log(respuesta["nombre_cliente"]);
			console.log(respuesta["id"]);
            $("#clienteEncontrado").val(respuesta["nombre_cliente"]);
			$("#seleccionarCliente").val(respuesta["id"]);
			$("#seleccionarCliente").html(respuesta["id"]);

        }
    });
});





/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/

$(".tablaVentas tbody").on("click", "button.agregarProducto", function(){

	var idProducto = $(this).attr("idProducto");

	$(this).removeClass("btn-primary agregarProducto");

	$(this).addClass("btn-default");

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

      	    var descripcion = respuesta["nombre_producto"];
          	var stock = respuesta["stock"];
          	var precio = respuesta["precio_venta"];

          	/*=============================================
          	EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
          	=============================================*/

          	if(stock == 0){

      			swal.fire({
			      title: "No hay stock disponible",
			      icon: "error",
			      confirmButtonText: "¡Cerrar!"
			    });

			    $("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

			    return;

          	}

          	$(".nuevoProducto").append(

        	'<div class="row" style="padding:5px 15px">'+

			'<!-- Descripción del producto -->'+
	          
	          '<div class="col-sm-7" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-text"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

	              '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+'" readonly required>'+

	            '</div>'+

	          '</div>'+

			  '<!-- Precio del producto -->'+

	          '<div class="col-sm-3 ingresoPrecio">'+

	            '<div class="input-group">'+

	              '<span class="input-group-text"><i class="ion ion-social-usd"></i></span>'+
	                 
	              '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+
	 
	            '</div>'+
	             
	          '</div>'+

	          '<!-- Cantidad del producto -->'+

	          '<div class="col-sm-2">'+
	            
	             '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required >'+

	          '</div>' +

	          

	        '</div>') 

	        // SUMAR TOTAL DE PRECIOS

	        sumarTotalPrecios()

			// AGREGAR IMPUESTO
	        
			agregarImpuesto()


	        // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarProductos()

	        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

	        $(".nuevoPrecioProducto").number(true, 2);


			localStorage.removeItem("quitarProducto");

      	}

     })

});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaVentas").on("draw.dt", function(){

	if(localStorage.getItem("quitarProducto") != null){

		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

		for(var i = 0; i < listaIdProductos.length; i++){

			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');

		}


	}


})



/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".formularioVenta").on("click", "button.quitarProducto", function(){

	$(this).parent().parent().parent().parent().remove();

	var idProducto = $(this).attr("idProducto");

	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=============================================*/

	if(localStorage.getItem("quitarProducto") == null){

		idQuitarProducto = [];
	
	}else{

		idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

	}

	idQuitarProducto.push({"idProducto":idProducto});

	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');

	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

	if($(".nuevoProducto").children().length == 0){

		$("#nuevoImpuestoVenta").val(0);
		$("#nuevoTotalFinalVenta").val(0);
		$("#totalVenta").val(0);
		$("#nuevoTotalFinalVenta").attr("total",0);

	}else{

		// SUMAR TOTAL DE PRECIOS

    	sumarTotalPrecios()
		
		// AGREGAR IMPUESTO
	        
		agregarImpuesto()


        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos()

	}

})


/*=============================================
SELECCIONAR PRODUCTO
=============================================*/

$(".formularioVenta").on("change", "select.nuevaDescripcionProducto", function(){

	var nombreProducto = $(this).val();

	var nuevaDescripcionProducto = $(this).parent().parent().parent().children().children().children(".nuevaDescripcionProducto");

	var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

	var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

	var datos = new FormData();
    datos.append("nombreProducto", nombreProducto);

	


	  $.ajax({

     	url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
      	    
      	    $(nuevaDescripcionProducto).attr("idProducto", respuesta["id"]);
      	    $(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
      	    $(nuevaCantidadProducto).attr("nuevoStock", Number(respuesta["stock"])-1);
      	    $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
      	    $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);
  	      // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarProductos()

      	}

      })
})

/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){

	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

	var precioFinal = $(this).val() * precio.attr("precioReal");
	
	precio.val(precioFinal);

	var nuevoStock = Number($(this).attr("stock")) - $(this).val();

	$(this).attr("nuevoStock", nuevoStock);

	if(Number($(this).val()) > Number($(this).attr("stock"))){

		/*=============================================
		SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
		=============================================*/

		$(this).val(0);

		$(this).attr("nuevoStock", $(this).attr("stock"));

		var precioFinal = $(this).val() * precio.attr("precioReal");

		precio.val(precioFinal);

		sumarTotalPrecios();

		swal({
	      title: "La cantidad supera el Stock",
	      text: "¡Sólo hay "+$(this).attr("stock")+" unidades!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

	    return;

	}

	// SUMAR TOTAL DE PRECIOS

	sumarTotalPrecios()

	// AGREGAR IMPUESTO
	        
    agregarImpuesto()


    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos()

})



/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/


function sumarTotalPrecios(){

	var precioItem = $(".nuevoPrecioProducto");

	
	var arraySumaPrecio = [];  

	for(var i = 0; i < precioItem.length; i++){

		 arraySumaPrecio.push(Number($(precioItem[i]).val()));
		
		 
	}

	function sumaArrayPrecios(total, numero){

		return total + numero;

	}
		
	$('#nuevoSubTotalVista').number( true, 2);

	$('#nuevoImpuestoVentaVista').number( true, 2);

	$('#nuevoTotalFinalVentaSA').number( true, 2);	



	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);


	var sumaTotalImpuesto = Math.round(sumaTotalPrecio*0.18);

	var sumaSubTotal = arraySumaPrecio.reduce(sumaArrayPrecios) - sumaTotalImpuesto;

	var sumaTotalFinal = sumaTotalImpuesto + sumaSubTotal ;


	$("#nuevoSubTotal").val(sumaSubTotal);

	$("#nuevoSubTotalVista").val(sumaSubTotal);

	$("#nuevoSubTotal").attr("total",sumaTotalPrecio);

	$("#nuevoImpuestoVenta").val(sumaTotalImpuesto);


	$("#nuevoImpuestoVentaVista").val(sumaTotalImpuesto);


	$("#nuevoTotalFinalVentaSA").val(sumaTotalFinal);

	var anticipo = $("#nuevoAnticipo").val();

	$("#totalVenta").val(sumaTotalPrecio);

	if(anticipo > 0){
		var nuevoTotalFinalVenta = anticipo;
		document.querySelector('.costoTotalconAnticipo').innerHTML = `
        <div class="mb-3 text-right">
            <label class="ml-2">TOTAL DE VENTA: </label>
            <input class="ml-2" type="text" class="form-control input-lg" id="nuevoDeudaFinalVenta" name="nuevoDeudaFinalVenta" placeholder="S/.000" value="${sumaTotalFinal}" readonly required>
        </div>
    `;
		$('#nuevoDeudaFinalVenta').number( true, 2);
	} else{
			$('#nuevoDeudaFinalVenta').number( true, 2);
		var nuevoTotalFinalVenta = sumaTotalFinal;
	}

	$("#nuevoDeudaFinalVenta").html(sumaTotalFinal - anticipo);


	$("#nuevoTotalFinalVenta").val(nuevoTotalFinalVenta);
	$("#nuevoTotalFinalVenta").html(nuevoTotalFinalVenta);

	
	


	console.log(anticipo);
	console.log(nuevoTotalFinalVenta);

}

/*=============================================
FUNCIÓN AGREGAR IMPUESTO
=============================================*/

function agregarImpuesto(){

	var impuesto = $("#nuevoImpuestoVenta").val();
	var precioTotal = $("#nuevoSubTotal").attr("total");

	var precioImpuesto = Number(precioTotal * impuesto/100);

	var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);
	

	$("#totalVenta").val(totalConImpuesto);

}


/*=============================================
FORMATO AL PRECIO FINAL
=============================================*/

$("#nuevoTotalFinalVenta").number(true, 2);

/*=============================================
SELECCIONAR MÉTODO DE PAGO
=============================================*/

$("#nuevoMetodoPago").change(function(){

	var metodo = $(this).val();

	if(metodo == "Efectivo"){

		$(this).parent().parent().removeClass("col-xs-6");

		$(this).parent().parent().addClass("col-xs-4");

		$(this).parent().parent().parent().children(".cajasMetodoPago").html(

			 '<div class="col-xs-4">'+ 

			 	'<div class="input-group">'+ 

			 		'<span class="input-group-text"><i class="ion ion-social-usd"></i></span>'+ 

			 		'<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="000000" required>'+

			 	'</div>'+

			 '</div>'+

			 '<div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">'+

			 	'<div class="input-group">'+

			 		'<span class="input-group-text"><i class="ion ion-social-usd"></i></span>'+

			 		'<input type="text" class="form-control" id="nuevoCambioEfectivo" placeholder="000000" readonly required>'+

			 	'</div>'+

			 '</div>'

		 )

		// Agregar formato al precio

		$('#nuevoValorEfectivo').number( true, 2);
      	$('#nuevoCambioEfectivo').number( true, 2);


      	// Listar método en la entrada
      	listarMetodos()

	}else{

		$(this).parent().parent().removeClass('col-xs-4');

		$(this).parent().parent().addClass('col-xs-6');

		 $(this).parent().parent().parent().children('.cajasMetodoPago').html(

		 	'<div class="col-xs-6" style="padding-left:0px">'+
                        
                '<div class="input-group">'+
                     
                  '<input type="number" min="0" class="form-control" id="nuevoCodigoTransaccion" placeholder="Código transacción"  required>'+
                       
                  '<span class="input-group-text"><i class="fa fa-lock"></i></span>'+
                  
                '</div>'+

              '</div>')

	}

	

})

/*=============================================
CAMBIO EN EFECTIVO
=============================================*/
$(".formularioVenta").on("change", "input#nuevoValorEfectivo", function(){

	var efectivo = $(this).val();

	var cambio =  Number(efectivo) - Number($('#nuevoTotalFinalVenta').val());

	var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

	nuevoCambioEfectivo.val(cambio);

})

/*=============================================
CAMBIO TRANSACCIÓN
=============================================*/
$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function(){

	// Listar método en la entrada
     listarMetodos()


})


/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos(){

	var listaProductos = [];

	var descripcion = $(".nuevaDescripcionProducto");

	var cantidad = $(".nuevaCantidadProducto");

	var precio = $(".nuevoPrecioProducto");

	for(var i = 0; i < descripcion.length; i++){

		listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"), 
							  "nombre_producto" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "stock" : $(cantidad[i]).attr("nuevoStock"),
							  "precio" : $(precio[i]).attr("precioReal"),
							  "total" : $(precio[i]).val()})

	}

	$("#listaProductos").val(JSON.stringify(listaProductos)); 

}




/*=============================================
LISTAR MÉTODO DE PAGO
=============================================*/

function listarMetodos(){

	var listaMetodos = "";

	if($("#nuevoMetodoPago").val() == "Efectivo"){

		$("#listaMetodoPago").val("Efectivo");

	}else{

		$("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());

	}

}

/*=============================================
BOTON EDITAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEditarVenta", function(){

	var idVenta = $(this).attr("idVenta");

	window.location = "index.php?ruta=editar-venta&idVenta="+idVenta;


})

/*=============================================
BOTON VER VENTA
=============================================*/
$(".seleccionarBoleta").change(function() {
    var idVentaSeleccionada = $(this).val();

    $("#idVenta").val(idVentaSeleccionada);
    $("#idVenta").html(idVentaSeleccionada);

    // Enviar el valor seleccionado al servidor utilizando AJAX
    $.ajax({
        type: "GET",
        url: "vistas/modulos/ver-venta-anticipo.php", // Cambiar la URL a la ruta de la plantilla "ver-venta-anticipo.php"
        data: { idVenta: idVentaSeleccionada },
        success: function(response) {
            $("#idVentaContainer").html(response);


        }
    });
}); 

/*=============================================
BOTON VER DETALLE VENTAS
=============================================*/
$(".btnVerVenta").click(function() {

	var idVenta = $(this).attr("idVenta");

    $.ajax({
        type: "GET",
        url: "vistas/modulos/ver-detalle-venta.php", // Cambiar la URL a la ruta de la plantilla "ver-venta-anticipo.php"
        data: { idVenta: idVenta },
        success: function(response) {

			$("#verVentacontainer").html(response);


        }
    });
}); 

/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarAgregarProducto(){

	//Capturamos todos los id de productos que fueron elegidos en la venta
	var idProductos = $(".quitarProducto");

	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTabla = $(".tablaVentas tbody button.agregarProducto");

	//Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
	for(var i = 0; i < idProductos.length; i++){

		//Capturamos los Id de los productos agregados a la venta
		var boton = $(idProductos[i]).attr("idProducto");
		
		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for(var j = 0; j < botonesTabla.length; j ++){

			if($(botonesTabla[j]).attr("idProducto") == boton){

				$(botonesTabla[j]).removeClass("btn-primary agregarProducto");
				$(botonesTabla[j]).addClass("btn-default");

			}
		}

	}
	
}

/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

$('.tablaVentas').on( 'draw.dt', function(){

	quitarAgregarProducto();

})


/*=============================================
BORRAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEliminarVenta", function(){

  var idVenta = $(this).attr("idVenta");

  Swal.fire({
  title: "¿Esta seguro de borrar la venta?",
  text: "¡Si no lo está puede cancelár la acción!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Si, deseo elminar usuario",
  cancelButtonText: "Cancelar"
	}).then(function(result){

    if(result.isConfirmed){

    	window.location = "index.php?ruta=ventas&idVenta="+idVenta;
    }

  })

})

/*=============================================
IMPRIMIR FACTURA
=============================================*/

$(".tablas").on("click", ".btnImprimirComprobante", function(){

	var codigoVenta = $(this).attr("codigoVenta");
	var tipoComprobante = $(this).attr("tipoComprobante");
	var tipoAnticipo = $(this).attr("tipoAnticipo");
	var idVenta = $(this).attr("idVenta");

	window.open("extensiones/invoice/"+tipoComprobante+tipoAnticipo+".php?idVenta="+idVenta, "_blank");



})

/*=============================================
IMPRIMIR FACTURA
=============================================*/

$(".tablas").on("click", ".btnImprimirGuiaRemision", function(){

	var codigoVenta = $(this).attr("codigoVenta");
	var idVenta = $(this).attr("idVenta");


	window.open("extensiones/invoice/NOTAVENTA.php?idVenta="+idVenta, "_blank");



})

/*=============================================
RANGO DE FECHAS
=============================================*/

$('#daterange-btn').daterangepicker(
  {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#daterange-btn span").html();
   
   	localStorage.setItem("capturarRango", capturarRango);

   	window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "ventas";
})

/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.opensleft .ranges li").on("click", function(){

	var textoHoy = $(this).attr("data-range-key");

	if(textoHoy == "Hoy"){

		var d = new Date();
		
		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var año = d.getFullYear();

		// if(mes < 10){

		// 	var fechaInicial = año+"-0"+mes+"-"+dia;
		// 	var fechaFinal = año+"-0"+mes+"-"+dia;

		// }else if(dia < 10){

		// 	var fechaInicial = año+"-"+mes+"-0"+dia;
		// 	var fechaFinal = año+"-"+mes+"-0"+dia;

		// }else if(mes < 10 && dia < 10){

		// 	var fechaInicial = año+"-0"+mes+"-0"+dia;
		// 	var fechaFinal = año+"-0"+mes+"-0"+dia;

		// }else{

		// 	var fechaInicial = año+"-"+mes+"-"+dia;
	 //    	var fechaFinal = año+"-"+mes+"-"+dia;

		// }

		dia = ("0"+dia).slice(-2);
		mes = ("0"+mes).slice(-2);

		var fechaInicial = año+"-"+mes+"-"+dia;
		var fechaFinal = año+"-"+mes+"-"+dia;	

    	localStorage.setItem("capturarRango", "Hoy");

    	window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})



$("#seleccionarComprobante").on("click", function(){

    var seleccion = this.value; // Obtener el valor seleccionado
    var valorSeleccionadoParrafo = document.getElementById("valorSeleccionado"); // Obtener el párrafo donde se mostrará el valor seleccionado

	const selectTipoAnticipo = document.getElementById('seleccionarTipoAnticipo');
    
    // Lógica condicional basada en la selección del usuario
    switch (seleccion) {		
		
        case 'FACTURA':

			selectTipoAnticipo.querySelector('option[value="A"]').disabled = false;
			selectTipoAnticipo.querySelector('option[value="D.A."]').disabled = false;

			
			$.ajax({
				url: 'ajax/codigoFacturas.ajax.php', // Ruta al script PHP que generará el valor
				type: 'GET',
				success: function(response) {
					// Actualizar el contenido HTML en .verCodigo con el valor recibido
					document.querySelector('.verCodigo').innerHTML = `
						<span class="input-group-text"><i class="fa fa-key"></i></span>
						<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="${response}" readonly>
					`;
				},
				error: function(xhr, status, error) {
					console.error(error); // Manejar errores en la solicitud AJAX
				}
			});
			break;
		case 'BOLETA':
			selectTipoAnticipo.querySelector('option[value="A"]').disabled = false;
			selectTipoAnticipo.querySelector('option[value="D.A."]').disabled = false;
			$.ajax({
				url: 'ajax/codigoBoletas.ajax.php', // Ruta al script PHP que generará el valor
				type: 'GET',
				success: function(response) {
					// Actualizar el contenido HTML en .verCodigo con el valor recibido
					document.querySelector('.verCodigo').innerHTML = `
						<span class="input-group-text"><i class="fa fa-key"></i></span>
						<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="${response}" readonly>
					`;
				},
				error: function(xhr, status, error) {
					console.error(error); // Manejar errores en la solicitud AJAX
				}
			});
			break;
		case 'COTIZACION':

			selectTipoAnticipo.value = 'S.A.';
			selectTipoAnticipo.querySelector('option[value="A"]').disabled = true;
			selectTipoAnticipo.querySelector('option[value="D.A."]').disabled = true;
			$('#nuevoAnticipo').val(0.00).prop('readonly', true);
			$('#nuevoAnticipo').html(0.00).prop('readonly', true);
			$('#btnGuardarVenta').prop('disabled', false);
			$('#nuevoAnticipo').number( true, 2);



			$.ajax({
				url: 'ajax/codigoCotizaciones.ajax.php', // Ruta al script PHP que generará el valor
				type: 'GET',
				success: function(response) {
					// Actualizar el contenido HTML en .verCodigo con el valor recibido
					document.querySelector('.verCodigo').innerHTML = `
						<span class="input-group-text"><i class="fa fa-key"></i></span>
						<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="${response}" readonly>
					`;
				},
				error: function(xhr, status, error) {
					console.error(error); // Manejar errores en la solicitud AJAX
				}
			});
			break;

			case 'NOTAVENTA':

			selectTipoAnticipo.querySelector('option[value="A"]').disabled = false;
			selectTipoAnticipo.querySelector('option[value="D.A."]').disabled = false;


			$.ajax({
				url: 'ajax/codigoNotadeVenta.ajax.php', // Ruta al script PHP que generará el valor
				type: 'GET',
				success: function(response) {
					// Actualizar el contenido HTML en .verCodigo con el valor recibido
					document.querySelector('.verCodigo').innerHTML = `
						<span class="input-group-text"><i class="fa fa-key"></i></span>
						<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="${response}" readonly>
					`;
				},
				error: function(xhr, status, error) {
					console.error(error); // Manejar errores en la solicitud AJAX
				}
			});
			break;


			
		}
});

$(document).ready(function() {
    $('#seleccionarTipoAnticipo').on('change', function() {
      var selectedOption = $(this).val();

	  // Actualiza el valor del input y lo hace readonly según la opción seleccionada
      if (selectedOption === 'S.A.') {
		$('#nuevoAnticipo').val(0.00).prop('readonly', true);
        $('#nuevoAnticipo').html(0.00).prop('readonly', true);
		$('#btnGuardarVenta').prop('disabled', false);
		$('#nuevoAnticipo').number( true, 2);

      } else if(selectedOption === 'A') {
        
		$('#btnGuardarVenta').prop('disabled', false);
        $('#nuevoAnticipo').val('').prop('readonly', false);

      } else{

		$('#btnGuardarVenta').prop('disabled', true);
		$('#nuevoAnticipo').val('').prop('readonly', false);

	  }


	  $('#modalSinAnticipo, #modalConAnticipo, #modalDeduccionAnticipo').modal('hide');

	  
      if(selectedOption === 'D.A.'){

		$('#modalDeduccionAnticipo').modal('show');

	  };
	  
    });
  });


/*=============================================
ABRIR ARCHIVO XML EN NUEVA PESTAÑA
=============================================*/

$(".abrirXML").click(function(){

	var archivo = $(this).attr("archivo");
	window.open(archivo, "_blank");


})



