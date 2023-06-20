<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
  <!-- Se incluye el archivo base  -->
  <?php
    include("templates/base.php");
  ?>
</head>

<body>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Consulta</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Consulta con Data Tables</h5>
              <p>Registro de clientes en la base de datos:</p>
              <div class="table-responsive">
                <!-- Tabla de la consulta de los clientes  -->
                <table id="tablaClientes" class="display table table-hover ">
                  <thead class="thead-dark">
                    <tr>
                      <th class="text-center">Id</th>
                      <th class="text-center">Nombre</th>
                      <th class="text-center">Fecha Nacimeinto</th>
                      <th class="text-center">Número de tarjeta</th>
                      <th class="text-center">URL Youtube</th>
                      <th class="text-center">Editar</th>
                      <th class="text-center">Eliminar</th>
                    </tr>
                  </thead>
                  <!-- Resultado de la consulta por medio de la funcion ListarClientes en el archivo js/funciones.js  -->
                  <tbody id="resultado">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Modal para la edición de los archivos -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Cliente</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-xxl-4 col-xl-12">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Edición de cliente</h5>
                    <p>Para proceder con la edición de cliente, necesitamos que completes el siguiente formulario
                      con tus datos personales:</p>
                    <!-- Formulario registro de cliente -->
                    <form class="row g-3 " action="" method="post" id="formulario">
                      <!-- Nombre  -->
                      <!-- Se utiliza para enviar los datos a editar -->
                      <input type="hidden" name="id_cliente" id="id_cliente">
                      <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required="">
                        <p class="text-danger d-none" id="mesaje_nombre">El campo nombre debe cumplir con lo
                          necesario, minimo 3 caracteres y maximo 50.<span><i class="bi bi-backspace"></i></span></p>
                      </div>
                      <!-- Fecha de nacimiento  -->
                      <div class="col-md-6">
                        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                          required="">
                        <p class="text-danger d-none" id="mesaje_fecha_nacimiento">El campo fecha debe cumplir
                          con lo necesario.<span><i class="bi bi-backspace"></i></span></p>
                      </div>
                      <!-- Número de tarjeta  -->
                      <div class="col-md-6">
                        <label for="numero_tarjeta" class="form-label">Ingresa tu número de tarjeta</label>
                        <input type="text" class="form-control" id="numero_tarjeta" name="numero_tarjeta" required="">
                        <p class="text-danger d-none" id="mesaje_numero_tarjeta">El campo debe cumplir con lo
                          necesario.<span><i class="bi bi-backspace"></i></span></p>

                      </div>
                      <!-- URL Youtube  -->
                      <div class="col-md-6">
                        <label for="url_youtube" class="form-label">Ingresa tu url de youtube</label>
                        <input type="text" class="form-control" id="url_youtube" name="url_youtube" required="">
                        <p class="text-danger d-none" id="mesaje_url_youtube">El campo debe cumplir con lo
                          necesario.<span><i class="bi bi-backspace"></i></span></p>

                      </div>
                    </form>
                    <!-- Termina Formulario -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <!-- Boton con evento onclik para realizar la función UPDATE -->
            <button type="button" class="btn btn-primary" onclick="editardatos(event);">Editar</button>
          </div>
        </div>
      </div>
    </div>
  </main><!-- End #main -->
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

  <?php include("templates/footer.php"); ?>
</body>

</html>
<script src="js/validacion.js"></script>
<script src="js/funciones.js"></script>