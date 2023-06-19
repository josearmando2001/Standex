<!-- incluyen 2 archivos de plantilla con la función include -->
<?php
include("templates/base.php");
include("templates/sliderbar.php");
?>
<title>Registro</title>
<!-- formulario de registro de cliente, contenido principal del código.  -->
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Registro</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Formulario</li>
                <li class="breadcrumb-item active">Registro</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-xxl-4 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Registro de cliente</h5>
                        <p>Para proceder con el registro de cliente, necesitamos que completes el siguiente formulario
                            con tus datos personales:</p>
                        <!-- Formulario registro de cliente -->
                        <form class="row g-3 " action="" method="post" id="formulario">
                            <!-- Nombre  -->
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required="">
                                <p class="text-danger d-none" id="mesaje_nombre">El campo nombre debe cumplir con lo
                                    necesario, minimo 3 caracteres y maximo 50.<span><i
                                            class="bi bi-backspace"></i></span></p>
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
                                <input type="text" class="form-control" id="numero_tarjeta" name="numero_tarjeta"
                                    required="">
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
                            <!-- Boton para enviar los datos  -->
                            <div class="form-group text-center">
                                <!-- Evento onclik para registrar datos  -->
                                <!-- Al momento de registrar se guardan los datos en el LocalStorage en el archivo js/validacion.js  -->
                                <input type="button" value="Registrar" onclick="registrar(event)"  class="btn btn-primary btn-block">
                            </div>
                        </form>
                        <!-- Termina Formulario -->
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<!-- Validación con libreria Jquery Validator -->
<script>
    $(document).ready(function () {
        $('#formulario').validate({
            rules: {
                nombre: {
                    required: true,
                },
                fecha_nacimiento: {
                    required: true
                },
                numero_tarjeta: {
                    required: true,
                    creditcard: true
                },
                url_youtube: {
                    required: true,
                    url: true
                },
            },
            errorElement: "p",
            errorPlacement: function (error, element) {
                error.addClass("text-danger");
                error.insertAfter(element);
            },
        });
    });
</script>
<script src="js/validacion.js"></script>

<?php
include("templates/header.php");
include("templates/footer.php");
?>