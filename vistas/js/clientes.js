// BUSCAR CLIENTE AJAX

$("#btnBuscarCliente").click(function(){
  var dni= $("#nuevoDNI").val();
          if(dni < 100000000) {
            

            var apiUrl = 'https://dniruc.apisperu.com/api/v1/dni/'+dni+'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InRvbXl1bGxvYTEyM0BnbWFpbC5jb20ifQ.xlgJiTkKolmCkDRcHfInHFsQABREEXb6uZusZncxDdQ';

            // Realizar la solicitud AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('GET', apiUrl, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    // Verificar si la solicitud fue exitosa (código 200)
                    if (xhr.status == 200) {
                        // Manejar la respuesta del servicio

                        var respuestaJSON = JSON.parse(xhr.responseText);

                        // Extraer el nombre
                        var nombres = respuestaJSON.nombres;

                        var apellidoPaterno = respuestaJSON.apellidoPaterno;

                        var apellidoMaterno = respuestaJSON.apellidoMaterno;
                       
                        $("#nuevoCliente").html(nombres+" "+apellidoPaterno+" "+apellidoMaterno);
                        $("#nuevoCliente").val(nombres+" "+apellidoPaterno+" "+apellidoMaterno);

                        $("#nuevoTipoCliente").val("PERSONA NATURAL")

                    } else {
                        // Manejar errores
                        console.error('Error en la solicitud. Código de estado: ' + xhr.status);
                    }
                }
            };
            xhr.send();
          } else {


            var apiUrl = 'https://dniruc.apisperu.com/api/v1/ruc/'+dni+'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InRvbXl1bGxvYTEyM0BnbWFpbC5jb20ifQ.xlgJiTkKolmCkDRcHfInHFsQABREEXb6uZusZncxDdQ';

            // Realizar la solicitud AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('GET', apiUrl, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    // Verificar si la solicitud fue exitosa (código 200)
                    if (xhr.status == 200) {
                        // Manejar la respuesta del servicio

                        var respuestaJSON = JSON.parse(xhr.responseText);

                        var razonSocial = respuestaJSON.razonSocial;

                        var telefonos = respuestaJSON.telefonos;

                        var direccion = respuestaJSON.direccion;

                        var departamento = respuestaJSON.departamento;

                        var provincia = respuestaJSON.provincia;

                        var distrito = respuestaJSON.distrito;
                       
                        $("#nuevoCliente").html(razonSocial);
                        $("#nuevoCliente").val(razonSocial);

                        $("#nuevoTelefono").val(telefonos);

                        $("#nuevaProcedencia").val(direccion);

                        $("#nuevoDepartamento").val(departamento);

                        $("#nuevoDistrito").val(distrito);

                        $("nuevoTipoCliente").html("PERSONA JURIDICA")
                        $("#nuevoTipoCliente").val("PERSONA JURIDICA")
                        

                    } else {
                        // Manejar errores
                        console.error('Error en la solicitud. Código de estado: ' + xhr.status);
                    }
                }
            };
            xhr.send();            

          }

        
})

/*=============================================
EDITAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEditarCliente", function(){

	var idCliente = $(this).attr("idCliente");

	var datos = new FormData();
    datos.append("idCliente", idCliente);

    $.ajax({

      url:"ajax/clientes.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
      
      	   $("#editarDNI").val(respuesta["DNI"]);
	       $("#editarCliente").val(respuesta["nombre_cliente"]);
           $("#editarTelefono").val(respuesta["telefono"]);
           $("#editarPerfilFacebook").val(respuesta["perfil_facebook"]);
           $("#editarPerfilInstagram").val(respuesta["perfil_instagram"]);
           $("#editarTelefonoAlternativo").val(respuesta["telefono_alternativo"]);
           $("#editarProcedencia").val(respuesta["procedencia_cliente"]);
           $("#editarDepartamento").val(respuesta["departamento"]);
           $("#editarDistrito").val(respuesta["distrito"]);
           $("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]);
           $("#editarTipoCliente").val(respuesta["tipo_cliente"]);
           $("#editarDescripcionCliente").val(respuesta["descripcion"]);
           $("#editarFuenteConocimiento").val(respuesta["fuentedeconocimiento"]);

	  }

  	})

})

/*=============================================
ELIMINAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEliminarCliente", function(){

	var idCliente = $(this).attr("idCliente");
	
	swal.fire({
        title: "¿Esta seguro de eliminar Cliente?",
          text: "¡Si no lo está puede cancelár la acción!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si, deseo elminar cliente",
          cancelButtonText: "Cancelar"
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=clientes&idCliente="+idCliente;
        }

  })

})

