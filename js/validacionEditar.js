//validacion formulario 
const formEv = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
const expresiones = {
    
    nombre: /^[a-zA-Z0-9À-ÿ\s]{3,50}$/, // Letras, numeros, guion y guion_bajo
    fecha_nacimiento: /^(?=.*\d)\d{4}-(?:0[1-9]|1[0-2])-(?:0[1-9]|[12]\d|3[01])/,
    numero_tarjeta: /^(?:4[0-9]{3}(?:\s?[0-9]{4}){3}|5[1-5][0-9]{2}(?:\s?[0-9]{4}){3}|6(?:011|5[0-9]{2})(?:\s?[0-9]{4}){2}|3[47][0-9]{2}(?:\s?[0-9]{4}){2}|3(?:0[0-5]|[68][0-9])[0-9](?:\s?[0-9]{4}){2})$/,
    url_youtube: /^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/,
}
const campos = {
    // Se inician los campos en false 
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

// edicion de cliente
function editar(event){
    event.preventDefault();
    if (campos.nombre && campos.numero_tarjeta && campos.url_youtube && campos.fecha_nacimiento) {
        fetch("databases/editar.php", {
            method: "POST",
            body: new FormData(formularioeditar)
        }).then(response => response.json()).then(response => {
            console.log(response)
            // Si el formulario es correcto se eliminan las clases y se resetea el formulario 
            if (response.success === true) {
                alerta('success', response.message);
                document.getElementById("nombre").classList.remove('is-valid');
                document.getElementById("fecha_nacimiento").classList.remove('is-valid');
                document.getElementById("numero_tarjeta").classList.remove('is-valid');
                document.getElementById("url_youtube").classList.remove('is-valid');
                document.getElementById('formularioeditar').reset();
            } else {
                alerta('error', response.message);
                document.getElementById('formularioeditar').reset();
            }
        })
    } else {
        // Si el formulario no cumple con el formato requerido
        alerta('warning', "Debes completar los datos del formulario correctamente");
    }
}
// Alerta de sweetalert2
function alerta(tipo,titulo){
    Swal.fire({
        icon: tipo,
        title: titulo,
        showConfirmButton: false,
        timer: 1500
      })
}