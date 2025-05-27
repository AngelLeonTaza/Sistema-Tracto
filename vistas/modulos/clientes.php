<div class="content-wrapper">

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Administrar Clientes <span style="font-size: 20px; font-weight: 100;">Panel de Clientes</span></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Administrar Clientes</li>
          </ol>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <section class="content">

    <div class="box">
      <div class="box-header with-border">

        <button class="btn btn-primary btnAgregarCliente" data-toggle="modal" data-target="#modalAgregarCliente" style="margin-bottom: 20px;">
          Agregar Cliente
        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" style="width:100%">
          <thead>

            <tr>

              <th style="width: 10px;">#</th>
              <th>DNI/RUC</th>
              <th>Nombre Completo</th>
              <th>Telefono</th>
              <th>Telefono Alternativo</th>
              <th>Perfil de Facebook</th>
              <th>Perfil de Instagram</th>
              <th>Procedencia</th>
              <th>Departamento</th>
              <th>Distrito</th>
              <th>Cumpleaños</th>
              <th>Total de Compras </th>
              <th>Ultima Compra</th>
              <th>Fecha de Registro </th>
              <th>Tipo de Cliente</th>
              <th>Descripción</th>
              <th>Fuente de conocimiento</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>
            <?php

            $item = null;
            $valor = null;

            $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

            foreach ($clientes as $key => $value) {


              echo '<tr>

                    <td>' . ($key + 1) . '</td>

                    <td>' . $value["DNI"] . '</td>

                    <td>' . $value["nombre_cliente"] . '</td>

                    <td>' . $value["telefono"] . '</td>

                    <td>' . $value["telefono_alternativo"] . '</td>

                    <td>' . $value["perfil_facebook"] . '</td>

                    <td>' . $value["perfil_instagram"] . '</td>

                    <td>' . $value["procedencia_cliente"] . '</td>

                    <td>' . $value["distrito"] . '</td>

                    <td>' . $value["departamento"] . '</td>

                    <td>' . $value["fecha_nacimiento"] . '</td>

                    <td>' . $value["total_compras"] . '</td>

                    <td>' . $value["ultima_compra"] . '</td>             

                    <td>' . $value["fecha_registro"] . '</td>

                    <td>' . $value["tipo_cliente"] . '</td>

                    <td>' . $value["descripcion"] . '</td>

                    <td>' . $value["fuentedeconocimiento"] . '</td>

                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="' . $value["id"] . '"><i class="fa fa-pen"></i></button>

                        <button class="btn btn-danger btnEliminarCliente" idCliente="' . $value["id"] . '"><i class="fa fa-times"></i></button>

                      </div>  

                    </td>

                  </tr>';
            }

            ?>
          </tbody>

        </table>

      </div>

    </div>


  </section>
</div>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">




      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            <div class="form-group row">
              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-key"></i></span>
                  <input type="text"
                    class="form-control input-lg"
                    id="nuevoDNI"
                    name="nuevoDNI"
                    placeholder="Ingresar DNI (8) o RUC (11)"
                    maxlength="11"
                    required>
                </div>
                <small class="text-muted form-text">
                  <span id="mensajeDNI">Ingrese 8 dígitos para DNI o 11 para RUC (solo números)</span>
                  <span id="errorDNI" class="text-danger d-none">❌ Documento inválido (debe tener exactamente 8 u 11 dígitos)</span>
                  <span id="errorDNIDuplicado" class="text-danger d-none">❌ Este documento ya está registrado</span>
                </small>
              </div>

              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                  <span class="input-group-text"> <button type="button" id="btnBuscarCliente"><i class="fa fa-search"></i> BUSCAR CLIENTE</button></span>
                </div>
              </div>

            </div>

            <script>
              // Variable global para almacenar DNIs existentes
              let dnisExistentes = [];

              // Obtener DNIs existentes al cargar la página (simulación)
              document.addEventListener('DOMContentLoaded', function() {
                // En una aplicación real, harías una petición AJAX aquí para obtener los DNIs existentes
                // Ejemplo:
                /*
                fetch('obtener_dnis.php')
                  .then(response => response.json())
                  .then(data => {
                    dnisExistentes = data;
                  });
                */

                // Para el ejemplo, simulamos algunos DNIs existentes
                dnisExistentes = ['', ''];
              });

              // Validación al enviar el formulario
              document.querySelector('form[role="form"]').addEventListener('submit', function(e) {
                const dniInput = document.getElementById('nuevoDNI');
                const dniValue = dniInput.value;
                const errorSpan = document.getElementById('errorDNI');
                const errorDuplicadoSpan = document.getElementById('errorDNIDuplicado');

                // Resetear errores
                errorSpan.classList.add('d-none');
                errorDuplicadoSpan.classList.add('d-none');

                // Validar longitud correcta (8 u 11 dígitos)
                if (dniValue.length !== 8 && dniValue.length !== 11) {
                  e.preventDefault();
                  errorSpan.classList.remove('d-none');
                  mostrarErrorCampo(dniInput);
                  return;
                }

                // Validar si el DNI ya existe
                if (dnisExistentes.includes(dniValue)) {
                  e.preventDefault();
                  errorDuplicadoSpan.classList.remove('d-none');
                  mostrarErrorCampo(dniInput);
                }
              });

              function mostrarErrorCampo(input) {
                input.focus();
                input.scrollIntoView({
                  behavior: 'smooth',
                  block: 'center'
                });
                input.classList.add('is-invalid');
                setTimeout(() => {
                  input.classList.remove('is-invalid');
                }, 2000);
              }

              // Validación en tiempo real
              document.getElementById('nuevoDNI').addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
              });
            </script>

            <style>
              .is-invalid {
                border: 2px solid #dc3545 !important;
                animation: shake 0.5s;
              }

              @keyframes shake {

                0%,
                100% {
                  transform: translateX(0);
                }

                20%,
                60% {
                  transform: translateX(-5px);
                }

                40%,
                80% {
                  transform: translateX(5px);
                }
              }
            </style>

            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
                <input type="text"
                  class="form-control input-lg"
                  id="nuevoCliente"
                  name="nuevoCliente"
                  placeholder="Ingresar nombre completo"
                  required
                  oninput="validarNombre(this)">
              </div>
              <small class="text-muted form-text">
                <span id="mensajeNombre">Solo letras, espacios y apóstrofes (mín. 3 caracteres)</span>
                <span id="errorNombre" class="text-danger d-none">❌ Solo se permiten letras, espacios y apóstrofes (mín. 3 caracteres)</span>
              </small>
            </div>

            <script>
              // Función de validación en tiempo real
              function validarNombre(input) {
                const errorSpan = document.getElementById('errorNombre');
                const valor = input.value;

                // Expresión regular que permite:
                // - Letras (incluyendo acentuadas y ñ)
                // - Espacios
                // - Apóstrofes (para nombres como O'Connor)
                // - Guiones (para nombres compuestos)
                const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s'-]+$/;

                // Validar mientras escribe
                if (valor.length > 0) {
                  if (!regex.test(valor) || valor.length < 3) {
                    input.classList.add('is-invalid');
                    errorSpan.classList.remove('d-none');
                  } else {
                    input.classList.remove('is-invalid');
                    errorSpan.classList.add('d-none');
                  }
                } else {
                  input.classList.remove('is-invalid');
                  errorSpan.classList.add('d-none');
                }
              }

              // Validación al enviar el formulario (agrega esto al existente)
              document.querySelector('form[role="form"]').addEventListener('submit', function(e) {
                const nombreInput = document.getElementById('nuevoCliente');
                const nombreValue = nombreInput.value;
                const errorSpan = document.getElementById('errorNombre');
                const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s'-]{3,}$/;

                if (!regex.test(nombreValue)) {
                  e.preventDefault();
                  errorSpan.classList.remove('d-none');
                  nombreInput.classList.add('is-invalid');
                  mostrarErrorCampo(nombreInput);
                }
              });
            </script>

            <style>
              /* (Asegúrate de que este CSS esté en tu código) */
              .is-invalid {
                border: 2px solid #dc3545 !important;
                box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
              }

              @keyframes shake {

                0%,
                100% {
                  transform: translateX(0);
                }

                20%,
                60% {
                  transform: translateX(-5px);
                }

                40%,
                80% {
                  transform: translateX(5px);
                }
              }

              .is-invalid {
                animation: shake 0.3s;
              }
            </style>


            <!-- ENTRADA PARA EL TELEFONO -->

            <div class="form-group row">

              <!-- ENTRADA PARA EL TELEFONO PRINCIPAL -->
              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-phone"></i></span>
                  <input type="text"
                    class="form-control input-lg"
                    id="nuevoTelefono"
                    name="nuevoTelefono"
                    placeholder="Telefono Principal (9 dígitos)"
                    maxlength="9"
                    required>
                </div>
                <small class="text-muted form-text">
                  <span id="mensajeTelefono">Ingrese 9 dígitos (ej: 987654321)</span>
                  <span id="errorTelefono" class="text-danger d-none">❌ El teléfono debe tener exactamente 9 dígitos</span>
                </small>
              </div>

              <!-- ENTRADA PARA EL TELEFONO ALTERNATIVO -->
              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-phone"></i></span>
                  <input type="text"
                    class="form-control input-lg"
                    id="nuevoTelefonoAlternativo"
                    name="nuevoTelefonoAlternativo"
                    placeholder="Telefono Alternativo (9 dígitos)"
                    maxlength="9">
                </div>
                <small class="text-muted form-text">
                  <span id="mensajeTelefonoAlt">Ingrese 9 dígitos (opcional)</span>
                  <span id="errorTelefonoAlt" class="text-danger d-none">❌ El teléfono debe tener exactamente 9 dígitos</span>
                </small>
              </div>

            </div>

            <!-- JS PARA LOS TELEFONOS -->
            <script>
              // Validación en tiempo real para ambos teléfonos
              document.querySelectorAll('#nuevoTelefono, #nuevoTelefonoAlternativo').forEach(input => {
                input.addEventListener('input', function() {
                  // Eliminar todo lo que no sea dígito
                  this.value = this.value.replace(/[^0-9]/g, '');

                  // Validación visual mientras escribe
                  if (this.value.length > 0 && this.value.length !== 9) {
                    this.classList.add('is-invalid');
                  } else {
                    this.classList.remove('is-invalid');
                  }
                });
              });

              // Validación al enviar el formulario
              document.querySelector('form[role="form"]').addEventListener('submit', function(e) {
                let formularioValido = true;

                // Validar teléfono principal (obligatorio)
                const telefono = document.getElementById('nuevoTelefono');
                const errorTelefono = document.getElementById('errorTelefono');

                if (telefono.value.length !== 9) {
                  e.preventDefault();
                  errorTelefono.classList.remove('d-none');
                  mostrarErrorCampo(telefono);
                  formularioValido = false;
                } else {
                  errorTelefono.classList.add('d-none');
                }

                // Validar teléfono alternativo (opcional, pero si llenó debe ser válido)
                const telefonoAlt = document.getElementById('nuevoTelefonoAlternativo');
                const errorTelefonoAlt = document.getElementById('errorTelefonoAlt');

                if (telefonoAlt.value.length > 0 && telefonoAlt.value.length !== 9) {
                  e.preventDefault();
                  errorTelefonoAlt.classList.remove('d-none');
                  mostrarErrorCampo(telefonoAlt);
                  formularioValido = false;
                } else {
                  errorTelefonoAlt.classList.add('d-none');
                }

                return formularioValido;
              });

              // Reutilizamos la función de mostrar errores
              function mostrarErrorCampo(input) {
                input.focus();
                input.scrollIntoView({
                  behavior: 'smooth',
                  block: 'center'
                });
                input.classList.add('is-invalid');
                setTimeout(() => {
                  input.classList.remove('is-invalid');
                }, 2000);
              }
            </script>

            <!-- ENTRADA PARA EL FACEBOOK -->

            <div class="form-group row">

              <div class="col-xs-12 col-sm-6">

                <div class="input-group">

                  <span class="input-group-text"><i class="fa fa-user"></i></span>

                  <input type="text" class="form-control input-lg" id="nuevoPerfilFacebook" name="nuevoPerfilFacebook" placeholder="Perfil de Facebook">

                </div>

              </div>

              <div class="col-xs-12 col-sm-6">

                <!-- ENTRADA PARA EL INSTAGRAM-->
                <div class="input-group">

                  <span class="input-group-text"><i class="fa fa-user"></i></span>

                  <input type="text" class="form-control input-lg" id="nuevoPerfilInstagram" name="nuevoPerfilInstagram" placeholder="Perfil de Instagram">

                </div>

              </div>

            </div>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-location-arrow"></i></span>

                <input type="text" class="form-control input-lg" id="nuevaProcedencia" name="nuevaProcedencia" placeholder="Ingrese la direccion de procedencia">

              </div>

            </div>

            <!-- ENTRADA PARA EL DEPARTAMENTO Y DISTRITO -->
            <div class="form-group row">

              <!-- ENTRADA PARA EL DEPARTAMENTO (ahora obligatorio) -->
              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-location-arrow"></i></span>
                  <input type="text"
                    class="form-control input-lg"
                    id="nuevoDepartamento"
                    name="nuevoDepartamento"
                    placeholder="Ingrese el Departamento *"
                    required
                    oninput="validarUbicacion(this)">
                </div>
                <small class="text-muted form-text">
                  <span id="mensajeDepartamento">Solo letras y espacios (ej: Lima, La Libertad)</span>
                  <span id="errorDepartamento" class="text-danger d-none">❌ Este campo es obligatorio</span>
                  <span id="errorFormatoDepartamento" class="text-danger d-none">❌ Solo letras y espacios</span>
                </small>
              </div>

              <!-- ENTRADA PARA EL DISTRITO (ahora obligatorio) -->
              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-location-arrow"></i></span>
                  <input type="text"
                    class="form-control input-lg"
                    id="nuevoDistrito"
                    name="nuevoDistrito"
                    placeholder="Ingrese el Distrito *"
                    required
                    oninput="validarUbicacion(this)">
                </div>
                <small class="text-muted form-text">
                  <span id="mensajeDistrito">Solo letras y espacios (ej: Miraflores, San Isidro)</span>
                  <span id="errorDistrito" class="text-danger d-none">❌ Este campo es obligatorio</span>
                  <span id="errorFormatoDistrito" class="text-danger d-none">❌ Solo letras y espacios</span>
                </small>
              </div>

            </div>

            <!-- JS PARA DEPARTAMENTO Y DISTRITO -->
            <script>
              // Función mejorada para validar ubicaciones
              function validarUbicacion(input) {
                const id = input.id;
                const errorObligatorio = document.getElementById(`error${id.charAt(0).toUpperCase() + id.slice(1)}`);
                const errorFormato = document.getElementById(`errorFormato${id.charAt(0).toUpperCase() + id.slice(1)}`);
                const valor = input.value.trim();

                // Resetear errores
                errorObligatorio.classList.add('d-none');
                errorFormato.classList.add('d-none');
                input.classList.remove('is-invalid');

                // Validar solo si hay contenido
                if (valor.length > 0) {
                  const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s-]+$/;
                  if (!regex.test(valor)) {
                    input.classList.add('is-invalid');
                    errorFormato.classList.remove('d-none');
                  }
                }
              }

              // Validación al enviar el formulario (actualizada)
              document.querySelector('form[role="form"]').addEventListener('submit', function(e) {
                const departamento = document.getElementById('nuevoDepartamento');
                const distrito = document.getElementById('nuevoDistrito');
                const errorDeptoObligatorio = document.getElementById('errorDepartamento');
                const errorDistObligatorio = document.getElementById('errorDistrito');
                const errorDeptoFormato = document.getElementById('errorFormatoDepartamento');
                const errorDistFormato = document.getElementById('errorFormatoDistrito');
                const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s-]+$/;

                let formularioValido = true;

                // Validar Departamento
                if (departamento.value.trim() === '') {
                  e.preventDefault();
                  errorDeptoObligatorio.classList.remove('d-none');
                  mostrarErrorCampo(departamento);
                  formularioValido = false;
                } else if (!regex.test(departamento.value)) {
                  e.preventDefault();
                  errorDeptoFormato.classList.remove('d-none');
                  mostrarErrorCampo(departamento);
                  formularioValido = false;
                }

                // Validar Distrito
                if (distrito.value.trim() === '') {
                  e.preventDefault();
                  errorDistObligatorio.classList.remove('d-none');
                  mostrarErrorCampo(distrito);
                  formularioValido = false;
                } else if (!regex.test(distrito.value)) {
                  e.preventDefault();
                  errorDistFormato.classList.remove('d-none');
                  mostrarErrorCampo(distrito);
                  formularioValido = false;
                }

                return formularioValido;
              });
            </script>

            <!-- ENTRADA PARA LA FECHA DE CUMPLEAÑOS -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                <input type="date"
                  class="form-control input-lg"
                  id="nuevoCumpleaños"
                  name="nuevoCumpleaños"
                  placeholder="Ingresar fecha de nacimiento"
                  required
                  oninput="validarFechaNacimiento(this)">
              </div>
              <small class="text-muted form-text">
                <span id="mensajeFecha">Formato: DD/MM/AAAA (Edad 18-100 años)</span>
                <span id="errorFechaRequerida" class="text-danger d-none">❌ Este campo es obligatorio</span>
                <span id="errorFechaFuturo" class="text-danger d-none">❌ No se permiten fechas futuras</span>
                <span id="errorFechaMenorEdad" class="text-danger d-none">❌ El cliente debe ser mayor de 18 años</span>
                <span id="errorFechaMayor100" class="text-danger d-none">❌ La edad máxima permitida es 100 años</span>
              </small>
            </div>

            <!-- JS PARA LA FECHA DE CUMPLEAÑOS -->
            <script>
              function validarFechaNacimiento(input) {
                const fechaInput = input.value;
                const hoy = new Date();
                const fechaNacimiento = new Date(fechaInput);
                const errorRequerido = document.getElementById('errorFechaRequerida');
                const errorFuturo = document.getElementById('errorFechaFuturo');
                const errorMenorEdad = document.getElementById('errorFechaMenorEdad');
                const errorMayor100 = document.getElementById('errorFechaMayor100');

                // Resetear todos los errores
                [errorRequerido, errorFuturo, errorMenorEdad, errorMayor100].forEach(error => error.classList.add('d-none'));
                input.classList.remove('is-invalid');

                if (!fechaInput) {
                  input.classList.add('is-invalid');
                  errorRequerido.classList.remove('d-none');
                  return;
                }

                // Calcular edad
                const edad = calcularEdad(fechaNacimiento, hoy);

                // Validar fecha futura
                if (fechaNacimiento > hoy) {
                  input.classList.add('is-invalid');
                  errorFuturo.classList.remove('d-none');
                  return;
                }

                // Validar menor de edad
                if (edad < 18) {
                  input.classList.add('is-invalid');
                  errorMenorEdad.classList.remove('d-none');
                  return;
                }

                // Validar mayor de 100 años
                if (edad > 100) {
                  input.classList.add('is-invalid');
                  errorMayor100.classList.remove('d-none');
                  return;
                }
              }

              function calcularEdad(fechaNacimiento, fechaReferencia) {
                let edad = fechaReferencia.getFullYear() - fechaNacimiento.getFullYear();
                const mes = fechaReferencia.getMonth() - fechaNacimiento.getMonth();

                if (mes < 0 || (mes === 0 && fechaReferencia.getDate() < fechaNacimiento.getDate())) {
                  edad--;
                }

                return edad;
              }

              // Validación al enviar el formulario
              document.querySelector('form[role="form"]').addEventListener('submit', function(e) {
                const fechaInput = document.getElementById('nuevoCumpleaños');
                const fechaValor = fechaInput.value;
                const hoy = new Date();
                const fechaNacimiento = new Date(fechaValor);

                if (!fechaValor) {
                  e.preventDefault();
                  document.getElementById('errorFechaRequerida').classList.remove('d-none');
                  mostrarErrorCampo(fechaInput);
                  return false;
                }

                const edad = calcularEdad(fechaNacimiento, hoy);

                if (fechaNacimiento > hoy) {
                  e.preventDefault();
                  document.getElementById('errorFechaFuturo').classList.remove('d-none');
                  mostrarErrorCampo(fechaInput);
                  return false;
                }

                if (edad < 18) {
                  e.preventDefault();
                  document.getElementById('errorFechaMenorEdad').classList.remove('d-none');
                  mostrarErrorCampo(fechaInput);
                  return false;
                }

                if (edad > 100) {
                  e.preventDefault();
                  document.getElementById('errorFechaMayor100').classList.remove('d-none');
                  mostrarErrorCampo(fechaInput);
                  return false;
                }

                return true;
              });
            </script>


            <!-- ENTRADA PARA EL TIPO DE CLIENTE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" id="nuevoTipoCliente" name="nuevoTipoCliente" placeholder="Ingresar el Tipo de Cliente" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCION CLIENTE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-map-marker"></i></span>

                <textarea type="text" class="form-control input-lg" id="nuevaDescripcionCliente" name="nuevaDescripcionCliente" placeholder="Ingresar una corta descripcion del cliente"></textarea>
              </div>

            </div>


            <!-- ENTRADA PARA LA FUENTE DE CONOCIMIENTO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" id="nuevaFuenteConocimiento" name="nuevaFuenteConocimiento" placeholder="¿Como se enteró el cliente de nosotros?">

              </div>

            </div>


          </div>

          <!--=====================================
        PIE DEL MODAL
        ======================================-->

          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary">Guardar cliente</button>

          </div>

      </form>

      <?php

      $crearCliente = new ControladorClientes();
      $crearCliente->ctrCrearCliente();

      ?>

    </div>

  </div>

</div>

<!--EDITAR CLIENTE-->
<div id="modalEditarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <h4 class="modal-title">Editar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">



            <!-- ENTRADA PARA EL DOCUMENTO ID -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-key"></i></span>

                <input type="number" min="0" class="form-control input-lg" id="editarDNI" name="editarDNI" required>

              </div>

            </div>

            <!-- ENTRADA PARA EDITAR EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" id="editarCliente" name="editarCliente" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELEFONO -->

            <div class="form-group row">

              <div class="col-xs-12 col-sm-6">

                <div class="input-group">

                  <span class="input-group-text"><i class="fa fa-phone"></i></span>

                  <input type="text" class="form-control input-lg" id="editarTelefono" name="editarTelefono" data-inputmask="'mask':'(51) 999-999-999'" data-mask>

                </div>

              </div>

              <div class="col-xs-12 col-sm-6">

                <!-- ENTRADA PARA EL TELEFONO ALTERNATIVO-->
                <div class="input-group">

                  <span class="input-group-text"><i class="fa fa-phone"></i></span>

                  <input type="text" class="form-control input-lg" id="editarTelefonoAlternativo" name="editarTelefonoAlternativo" data-inputmask="'mask':'(51) 999-999-999'" data-mask>

                </div>

              </div>

            </div>


            <!-- ENTRADA PARA EL FACEBOOK -->

            <div class="form-group row">

              <div class="col-xs-12 col-sm-6">

                <div class="input-group">

                  <span class="input-group-text"><i class="fa fa-instagram"></i></span>

                  <input type="text" class="form-control input-lg" id="editarPerfilFacebook" name="editarPerfilFacebook">

                </div>

              </div>

              <div class="col-xs-12 col-sm-6">

                <!-- ENTRADA PARA EL INSTAGRAM-->
                <div class="input-group">

                  <span class="input-group-text"><i class="fa fa-phone"></i></span>

                  <input type="text" class="form-control input-lg" id="editarPerfilInstagram" name="editarPerfilInstagram">

                </div>

              </div>

            </div>




            <!-- ENTRADA PARA EL PROCEDENCIA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-location-arrow"></i></span>

                <input type="text" class="form-control input-lg" id="editarProcedencia" name="editarProcedencia" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DEPARTAMENTO -->

            <div class="form-group row">

              <div class="col-xs-12 col-sm-6">

                <div class="input-group">

                  <span class="input-group-text"><i class="fa fa-location-arrow"></i></span>

                  <input type="text" class="form-control input-lg" id="editarDepartamento" name="editarDepartamento">

                </div>

              </div>

              <div class="col-xs-12 col-sm-6">

                <!-- ENTRADA PARA EL DISTITO-->
                <div class="input-group">

                  <span class="input-group-text"><i class="fa fa-location-arrow"></i></span>

                  <input type="text" class="form-control input-lg" id="editarDistrito" name="editarDistrito">

                </div>

              </div>

            </div>

            <!-- ENTRADA PARA LA FECHA DE CUMPLE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-calendar"></i></span>

                <input type="date" class="form-control input-lg" id="editarFechaNacimiento" name="editarFechaNacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>

              </div>

            </div>

          </div>

          <!-- ENTRADA PARA EL TIPO DE CLIENTE -->

          <div class="form-group">

            <div class="input-group">

              <span class="input-group-text"><i class="fa fa-map-marker"></i></span>

              <input type="text" class="form-control input-lg" id="editarTipoCliente" name="editarTipoCliente">

            </div>

          </div>

          <!-- ENTRADA PARA LA DESCRIPCION CLIENTE -->

          <div class="form-group">

            <div class="input-group">

              <span class="input-group-text"><i class="fa fa-map-marker"></i></span>

              <textarea type="text" class="form-control input-lg" id="editarDescripcionCliente" name="editarDescripcionCliente"></textarea>
            </div>

          </div>

          <!-- ENTRADA PARA LA FUENTE DE CONOCIMIENTO -->

          <div class="form-group">

            <div class="input-group">

              <span class="input-group-text"><i class="fa fa-map-marker"></i></span>

              <input type="text" class="form-control input-lg" id="editarFuenteConocimiento" name="editarFuenteConocimiento" readonly>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

      </form>

      <?php

      $editarCliente = new ControladorClientes();
      $editarCliente->ctrEditarCliente();

      ?>

    </div>

  </div>

</div>

<?php

$eliminarCliente = new ControladorClientes();
$eliminarCliente->ctrEliminarCliente();

?>