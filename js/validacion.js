//validacion formulario 
const formEv = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
const expresiones = {
    // Expresiones regulares que se deben cumplir para el registro de datos
    nombre: /^[a-zA-Z0-9À-ÿ\s]{3,50}$/, // Letras, numeros, guion y guion_bajo de 3 a 50 caracteres
    fecha_nacimiento: /^(?=.*\d)\d{4}-(?:0[1-9]|1[0-2])-(?:0[1-9]|[12]\d|3[01])/,
    numero_tarjeta: /^(?:4[0-9]{3}(?:\s?[0-9]{4}){3}|5[1-5][0-9]{2}(?:\s?[0-9]{4}){3}|6(?:011|5[0-9]{2})(?:\s?[0-9]{4}){2}|3[47][0-9]{2}(?:\s?[0-9]{4}){2}|3(?:0[0-5]|[68][0-9])[0-9](?:\s?[0-9]{4}){2})$/,
    url_youtube: /^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/,
}
const campos = {
    nombre: false,
    fecha_nacimiento: false,
    numero_tarjeta: false,
    url_youtube: false,
}

// valida los campos segun la expresion regular 
const validarForm = (e) => {
    // toma el valor del target por el name del input
    switch (e.target.name) {
        case "nombre":
            validarCampo(expresiones.nombre, e.target, 'nombre');
            break;
        case "fecha_nacimiento":
            validarCampo(expresiones.fecha_nacimiento, e.target, 'fecha_nacimiento');
            break;
        case "numero_tarjeta":
            validarCampo(expresiones.numero_tarjeta, e.target, 'numero_tarjeta');
            break;
        case "url_youtube":
            validarCampo(expresiones.url_youtube, e.target, 'url_youtube');
            break;
    }
}
inputs.forEach((input) => {
    input.addEventListener('keyup', validarForm);
    input.addEventListener('blur', validarForm);
});
const validarCampo = (expresion, input, campo) => {
    if (expresion.test(input.value)) {
        // correcto
        document.getElementById(`${campo}`).classList.remove('is-invalid');
        document.getElementById(`${campo}`).classList.add('is-valid');
        //mensaje
        document.getElementById(`mesaje_${campo}`).classList.add('d-none');
        campos[campo] = true;
    } else {
        // incorrecto
        document.getElementById(`${campo}`).classList.remove('is-valid');
        document.getElementById(`${campo}`).classList.add('is-invalid');
        //mensaje
        document.getElementById(`mesaje_${campo}`).classList.remove('d-none');
        campos[campo] = false;
    }

}

// registro de cliente
function registrar(event) {
    event.preventDefault();
    // Validar que los campos sean correctos
    if (campos.nombre && campos.numero_tarjeta && campos.url_youtube && campos.fecha_nacimiento) {
        fetch("databases/registrar.php", {
            method: "POST",
            body: new FormData(formulario)
        }).then(response => response.json()).then(response => {
            // Guardar los datos en el LocalStorage 
            // Obtener los valores ingresados por el usuario
            var nombre = document.getElementById('nombre').value;
            var fechaNacimiento = document.getElementById('fecha_nacimiento').value;
            var numeroTarjeta = document.getElementById('numero_tarjeta').value;
            var urlYoutube = document.getElementById('url_youtube').value;

            // Crear un objeto con los valores del registro
            var registro = {
                nombre: nombre,
                fechaNacimiento: fechaNacimiento,
                numeroTarjeta: numeroTarjeta,
                urlYoutube: urlYoutube
            };
            // Convertir el objeto a formato de cadena
            var registroString = JSON.stringify(registro);
            // Almacenar el registro en el LocalStorage
            localStorage.setItem('registroCliente', registroString);
            // Si los datos son correctos se remueven los iconos de correcto y se resetea el formulario 
            if (response.success === true) {
                alerta('success', response.message);
                document.getElementById("nombre").classList.remove('is-valid');
                document.getElementById("fecha_nacimiento").classList.remove('is-valid');
                document.getElementById("numero_tarjeta").classList.remove('is-valid');
                document.getElementById("url_youtube").classList.remove('is-valid');
                document.getElementById('formulario').reset();
            } else {
                // en caso de error 
                alerta('error', response.message);
                document.getElementById('formulario').reset();
            }
        })
    } else {
        // Si los datos no cumplen con el formato requerido 
        alerta('warning', "Debes completar los datos del formulario correctamente");
    }
}
// Función para alerta de sweetalert2 
function alerta(tipo, titulo) {
    Swal.fire({
        icon: tipo,
        title: titulo,
        showConfirmButton: false,
        timer: 1500
    })
}