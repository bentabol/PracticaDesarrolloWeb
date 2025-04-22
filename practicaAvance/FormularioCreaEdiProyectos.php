<?php require 'partials/header.php' ?>
<?php if (!empty($_SESSION['errores'])) : ?>
    <h2> <?= $_SESSION['errores'] ?></h2>
<?php endif;
unset($_SESSION['errores']) ?>
<header>
</header>
<div id="containerRegistrar">
    <form id="creaProyecto" action="proyectos.php" name="formulario" method="post">
        <div class="title"><FONT COLOR="white">Registro de Proyectos</FONT></div>
        <div id="alerts" class="alerts" style="display: none">Existen errores en el formulario</div>
        <input type="hidden" value="control">
        <!-- Campo oculto para almacenar el ID del proyecto en modo de edición -->
        <input type="hidden" id="proyectoId" name="proyectoId" value="0" />

        <div>
            <label for="titulo">Título del Proyecto</label>
            <input type="text" id="proyectoNombre" name="proyectoNombre" placeholder="Introduce el título del proyecto" required>
        </div>

        <div>
            <label for="descripcion">Descripción del Proyecto</label>
            <textarea id="proyectoDescripcion" name="proyectoDescripcion" placeholder="Introduce la descripción del proyecto"></textarea>
        </div>

        <div>
            <label for="responsable">Responsable del Proyecto</label>
            <input type="text" id="proyectoResponsable" name="proyectoResponsable" placeholder="Introduce el nombre del responsable" required>
        </div>

        <div>
            <label for="fechaInicio">Fecha de Inicio</label>
            <input type="date" id="proyectoInicio" name="proyectoInicio" required>
        </div>

        <div>
            <label for="fechaFin">Fecha de Fin (no puede ser antes que la Fecha de Inicio)</label>
            <input type="date" id="proyectoFin" name="proyectoFin" required>
        </div>

        <div>
            <label for="proyectoEstado">Estado del Proyecto</label>
            <select id="proyectoEstado" name="proyectoEstado">
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>
        </div>

        <div class="row">
                <button type="submit" id="btEnviarProyecto" name="btEnviarProyecto">Enviar</button>
                <button type="reset" id="btClear" name="btClear">Borrar</button>
        </div>
    </form>
</div>

<script>
/*    // Función para cargar la información del proyecto en modo de edición
    function cargarProyectoEnEdicion() {
        var urlParams = new URLSearchParams(window.location.search);
        var proyectoId = urlParams.get('id');

        if (proyectoId) {
            document.getElementById('proyectoId').value = proyectoId;
        }
    }

    // Función para redirigir a LandingPage.html al cancelar el formulario
    function cancelarFormulario() {
        window.location.href = "LandingPage.html";
    }

    // Función para validar el formulario antes de redirigir
    function validarFormulario() {
        // Validar aquí los campos del formulario
        var nombre = document.getElementById('proyectoNombre').value;
        var descripcion = document.getElementById('proyectoDescripcion').value;
        var responsable = document.getElementById('proyectoResponsable').value;
        var fechaInicio = document.getElementById('proyectoInicio').value;
        var fechaFin = document.getElementById('proyectoFin').value;
        var estado = document.getElementById('proyectoEstado').value;

        // Validar que la Fecha de Fin no sea antes que la Fecha de Inicio
        if (new Date(fechaFin) < new Date(fechaInicio)) {
            alert("La Fecha de Fin no puede ser antes que la Fecha de Inicio");
            return false;
        }

        // Si la validación es exitosa, redirige a LandingPage.html
        //window.location.href = "LandingPage.html";

        // Devuelve false para evitar que el formulario se envíe normalmente
        return false;
    }

    // Cargar información de la tarea al cargar la página
    window.onload = cargarTareaEnEdicion;
    */
</script>
    
<?php require 'partials/footer.php' ?>
