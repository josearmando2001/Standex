<!-- Menu de la derecha -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link" href="home" class="active">
                <i class="bi bi-grid"></i>
                <span>Registro</span>
            </a>
        </li>
    </ul>
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link" href="consulta-clientes" target="_blank"  class="active">
                <i class="bi bi-grid"></i>
                <span>Consulta</span>
            </a>
        </li>
    </ul>
</aside>
<!-- Termina menu -->

<script>
    // Función para agregar la clase para mostrar activo la pestaña donde te encuentres
    // Obtener todos los elementos con la clase "nav-link"
    var navLinks = document.querySelectorAll('.nav-link');
    // Iterar sobre los elementos y agregar o quitar la clase "collapsed" según corresponda
    navLinks.forEach(function (navLink) {
        // Verificar si el href del enlace coincide con la página actual
        if (navLink.href === window.location.href) {
            navLink.classList.remove('collapsed');
        } else {
            navLink.classList.add('collapsed');
        }
    });
</script>