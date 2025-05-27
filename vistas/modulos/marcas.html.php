<div class="content-wrapper">

  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Administrar Marcas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Administrar Marcas</li>
            </ol>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">

        <div class="box">
          
          <div class="box-header with-border">

            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria" style="margin-bottom: 20px;">

              Agregar Marca

            </button>

          </div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive  tablas">
              
              <thead>
                
                <tr>
                  
                  <th style="width:10px">#</th>
                  <th>Marcas</th>
                  <th>Acciones</th>

                </tr>

              </thead>

              <tbody>
                
                <tr>
                  
                  <td>1</td>
                  <td> New Holland </td>

                  <td>
                    <div class="btn-group"> 

                      <button class="btn btn-warning"><i class="fa fa-pen"></i></button>
                      <button class="btn btn-danger"><i class="fa fa-times"></i></button>

                    </div>
                  </td>


                </tr>

                <tr>
                  
                  <td>1</td>
                  <td> New Holland </td>

                  <td>
                    <div class="btn-group"> 

                      <button class="btn btn-warning"><i class="fa fa-pen"></i></button>
                      <button class="btn btn-danger"><i class="fa fa-times"></i></button>

                    </div>
                  </td>


                </tr>

                <tr>
                  
                  <td>1</td>
                  <td> New Holland </td>

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

<!--MODAL AGREGAR CATEGORIA -->

<!-- Modal -->
<div class="modal fade" id="modalAgregarCategoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">

    <div class="modal-content">

      <form action="form" method="post">

        <div class="modal-header" style="background:#45A335;">

          <h3 class="modal-title fs-5" id="exampleModalLabel" > Agregar Marcas </h3>

        </div>


        <div class="modal-body">

          <div class="box-body">
            
            <div class="form-group">

              <!--nombre-->

              <div class="input-group">

                <span class="input-group-text" ><i class="fa fa-th"></i></span>


                <input type="text" class="form-control" name="nuevaCategoria" placeholder="Ingresar Categoria" required>


              </div>



            </div>

          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary"> Guardar Categoria </button>
        </div>

        

      </form>

    </div>
  </div>


</div>