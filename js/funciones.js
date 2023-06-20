// Inicializar el data table 
function InicializarDataTable() {
    // si existe una instacia de data table se destruye
    if ($.fn.DataTable.isDataTable("#tablaClientes")) {
        $("#tablaClientes").DataTable().destroy();
    }
    // Vaciar el contenido de la tabla antes de reconstruir
    $("#tablaClientes").empty();

    $("#tablaClientes").DataTable({
        // Lenguaje español
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-MX.json'
        },
        data: rows, // Pasar los datos actuales al DataTable
        // Cabecera del datable  
        columns: [{
                title: "ID"
            },
            {
                title: "Nombre"
            },
            {
                title: "Fecha de nacimiento"
            },
            {
                title: "Número de tarjeta"
            },
            {
                title: "URL de YouTube"
            },
            {
                title: "Editar"
            },
            {
                title: "Eliminar"
            }
        ]
    });
}
// Ejecuta la funcion listar caunado la pagina se recarga load
$(document).ready(function () {
    ListarClientes();
});
let rows = []; // Declarar rows como una variable global
function ListarClientes() {
    fetch("databases/listar.php", {})
        .then(response => response.json())
        .then(response => {
            $("#resultado").empty(); // Vaciar el contenido actual antes de agregar los nuevos datos
            rows = response.map(cliente => [
                cliente.id,
                cliente.nombre,
                cliente.fecha_nacimiento,
                cliente.numero_tarjeta,
                cliente.url_youtube,
                `<button type='button' class='btn btn-outline-success' onclick='Editar("${cliente.id}")'>Editar</button>`,
                `<button type='button' class='btn btn-outline-danger' onclick='Eliminar("${cliente.id}")'>Eliminar</button>`
            ]);

            InicializarDataTable(); // Llamada a la función para inicializar o reconstruir el DataTable
        });
}
// Función para eliminar 
function Eliminar(id) {
    // Al realizar el evento clic realiza un cuestionamiento para continuar 
    Swal.fire({
        title: '¿Desea eliminar al cliente?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("databases/eliminar.php", {
                    method: "POST",
                    body: id
                })
                .then(response => response.json())
                .then(response => {
                    if (response.success === true) {
                        ListarClientes(); // Refrescar los datos de la tabla DataTable
                        alerta("success", "Eliminado correctamente");
                    } else {
                        alerta("error", "Error al eliminar");
                    }
                });
        }
    });
}
// crea una costante del modal bootstrap para utilizarlo hidden o show
const myModal = new bootstrap.Modal(document.getElementById("exampleModal"));

// Función para editar 
function Editar(id) {
    fetch("databases/datoseditar.php", {
            method: "POST",
            body: id
        })
        .then(response => response.json())
        .then(response => {
            // Iniciar el modal por medio de show 
            myModal.show();
            response.forEach(element => {
                // envia los datos al modal del registro a editar 
                document.getElementById("id_cliente").value = element.id;
                document.getElementById("nombre").value = element.nombre;
                document.getElementById("fecha_nacimiento").value = element.fecha_nacimiento;
                document.getElementById("numero_tarjeta").value = element.numero_tarjeta;
                document.getElementById("url_youtube").value = element.url_youtube;
            });
        });
}

// edicion de cliente
function editardatos(event) {
    event.preventDefault();
    if (campos.nombre && campos.numero_tarjeta && campos.url_youtube && campos.fecha_nacimiento) {
        fetch("databases/editar.php", {
            method: "POST",
            body: new FormData(formulario)
        }).then(response => response.json()).then(response => {
            if (response.success === true) {
                // Si la edición es correcta envia una alerta, remueve las clases y resetea el formulario 
                alerta('success', response.message);
                document.getElementById("nombre").classList.remove('is-valid');
                document.getElementById("fecha_nacimiento").classList.remove('is-valid');
                document.getElementById("numero_tarjeta").classList.remove('is-valid');
                document.getElementById("url_youtube").classList.remove('is-valid');
                document.getElementById('formulario').reset();
                // Cerrar el modal 
                myModal.hide();
                // Actualizar la tabla 
                ListarClientes();
            } else {
                // En caso de error 
                alerta('error', response.message);
                document.getElementById('formulario').reset();
                myModal.hide();
            }
        })
    } else {
        // si no cumples con el formato requerido para los inputs 
        alerta('warning', "Debes completar los datos del formulario correctamente");
    }
}
// Alerta de Sweetalert2
function alerta(tipo, titulo) {
    Swal.fire({
        icon: tipo,
        title: titulo,
        showConfirmButton: false,
        timer: 1500
    })
}