<div class="content-wrapper">

	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Administrar Usuarios</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Administrar Usuarios</li>
            </ol>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">

       	<div class="box">
          
          <div class="box-header with-border">

            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario" style="margin-bottom: 20px;">
              Agregar Usuario
            </button>

          </div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive  tablas">
              
              <thead>
                
                <tr>
                  
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Usuario</th>
                  <th>Foto</th>
                  <th>Perfil</th>
                  <th>Estado</th>
                  <th>último login</th>
                  <th>Acciones</th>

                </tr>

              </thead>

              <tbody>
                
                <tr>
                  
                  <td>1</td>
                  <td>Amen Adminsitrador</td>
                  <td>Admin</td>
                  <td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                  <td> Administrador </td>
                  <td> <button class="btn btn-success btn-xs">Activado</button> </td>
                  <td>2017-12-12 12:05:11</td>
                  <td>
                    <div class="btn-group"> 

                      <button class="btn btn-warning"><i class="fa fa-pen"></i></button>
                      <button class="btn btn-danger"><i class="fa fa-times"></i></button>

                    </div>
                  </td>


                </tr>

                <tr>
                  
                  <td>1</td>
                  <td>Usuario Adminsitrador</td>
                  <td>Admin</td>
                  <td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                  <td> Administrador </td>
                  <td> <button class="btn btn-danger btn-xs">Desactivado</button> </td>
                  <td>2017-12-12 12:05:11</td>
                  <td>
                    <div class="btn-group"> 

                      <button class="btn btn-warning"><i class="fa fa-pen"></i></button>
                      <button class="btn btn-danger"><i class="fa fa-times"></i></button>

                    </div>
                  </td>


                </tr>

                <tr>
                  
                  <td>1</td>
                  <td>Usuario Adminsitrador</td>
                  <td>Admin</td>
                  <td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                  <td> Administrador </td>
                  <td> <button class="btn btn-success btn-xs">Activado</button> </td>
                  <td>2017-12-12 12:05:11</td>
                  <td>
                    <div class="btn-group"> 

                      <button class="btn btn-warning"><i class="fa fa-pen"></i></button>
                      <button class="btn btn-danger"><i class="fa fa-times"></i></button>

                    </div>
                  </td>


                </tr>

              </tbody>

            </table>

          </div>

        </div>
    	
    </section>
</div>

<!--MODAL AGREGAR USUARIO -->

<!-- Modal -->
<div class="modal fade" id="modalAgregarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">

    <div class="modal-content">

      <form action="form" method="post" enctype="multipart/form-data">

        <div class="modal-header" style="background:#45A335;">

          <h3 class="modal-title fs-5" id="exampleModalLabel" > Agregar Usuario </h3>

        </div>


        <div class="modal-body">

          <div class="box-body">
            
            <div class="form-group">

              <!--nombre-->

              <div class="input-group">

                <span class="input-group-text" ><i class="fa fa-user"></i></span>


                <input type="text" class="form-control" name="nuevoNombre" placeholder="Ingresar Nombre" required>


              </div>

              <!--nombre-->

              <div class="input-group" style="margin-top: 20px;">

                <span class="input-group-text" ><i class="fa fa-key"></i></span>


                <input type="text" class="form-control" name="nuevoUsuario" placeholder="Ingresar Usuario" required>

              </div>

              <!--contraseña-->

              <div class="input-group" style="margin-top: 20px;">

                <span class="input-group-text" ><i class="fa fa-lock"></i></span>


                <input type="text" class="form-control" name="nuevoPassword" placeholder="Ingresar Contraseña" required>

              </div>


              <!--perfil-->

              <div class="input-group" style="margin-top: 20px;">

                <span class="input-group-text" ><i class="fa fa-users"></i></span>


                <select name="nuevoPerfil" class="form-control input-lg">
                  
                  <option value=""> Seleccionar Perfil </option>

                  <option value="Administrador">Administrador</option>

                  <option value="Administrador">Vendedor</option>

                </select>

              </div>

              <!--Subir foto-->

              <div class="form-group" style="text-align: center;">
                
                <div class="panel" style="padding-top: 50px;"> <h5>SUBIR FOTO</h2></div>

                <input type="file" id="nuevaFoto" name="nuevaFoto"  style="padding-top: 20px; font-size: 1em;">

                <p class="help-block"> Peso máximo de la foto 200MB </p>

                <img src="vistas\img\usuarios\default\anonymous.png" class="img-thumbnail" width="100px">

              </div>

            </div>

          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary"> Guardar Cambios </button>
        </div>

      </form>

    </div>
  </div>


</div>