

<div class="hold-transition login-page">

  <div id="back"></div>

  <div class="login-box">

  <div class="login-logo">

    <img src="vistas/img/plantillas/logo_sin_fondo.png" style="height: 100px;">

    <span style="color: #43A335; font-weight: 600;">TRACTO</span> <span style="color: #F6B034;font-weight: 600;">LEO</span></span>

  </div>


  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Ingresa tus datos para Iniciar Sesión</p>

      <form method="post">

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="ingPassword" required>

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>


          <div class="col-4" >
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>

        </div>

        <?php
          $login = new ControladorUsuarios();
          $login -> ctrIngresoUsuario();
        ?>

      </form>
    </div>
  </div>
</div>
</div>
