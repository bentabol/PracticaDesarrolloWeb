<?php require 'partials/header.php' ?>
<?php if (!empty($_SESSION['errores'])) : ?>
    <h2> <?= $_SESSION['errores'] ?></h2>
<?php endif;
unset($_SESSION['errores']) ?>
<header>
</header>
<div id="containerRegistrar">
    <form id="tareaForm" action="tareas.php" name="tareaForm" method="post">
        <div class="title"><FONT COLOR="white">Registro de Tareas</FONT></div>
        <div id="alerts" class="alerts" style="display: none">Existen errores en el formulario</div>
        <input type="hidden" value="control">
        <!-- Campo oculto para almacenar el ID de la tarea en modo de edición -->
        <input type="hidden" id="tareaId" name="tareaId" value="0" />

        <div>
            <label for="tareaNombre">Nombre de la Tarea</label>
            <input type="text" id="tareaNombre" name="tareaNombre" placeholder="Introduce el nombre de la tarea" maxlength="100" required>
        </div>

        <div>
            <label for="tareaDescripcion">Descripción de la Tarea</label>
            <textarea id="tareaDescripcion" name="tareaDescripcion" placeholder="Introduce la descripción de la tarea"></textarea>
        </div>

        <div>
            <label for="tareaResponsable">Responsable de la Tarea</label>
            <input type="text" id="tareaResponsable" name="tareaResponsable" placeholder="Introduce el nombre del responsable" maxlength="100" required>
        </div>

        <div>
            <label for="tareaInicio">Fecha de Inicio</label>
            <input type="date" id="tareaInicio" name="tareaInicio" required>
        </div>

        <div>
            <label for="tareaFin">Fecha de Fin (no puede ser antes que la Fecha de Inicio)</label>
            <input type="date" id="tareaFin" name="tareaFin" required>
        </div>

        <div>
            <label for="tareaEstado">Estado de la Tarea</label>
            <select id="tareaEstado" name="tareaEstado">
                <option value="Pendiente">Pendiente</option>
                <option value="Progreso">En Progreso</option>
                <option value="Completa">Completa</option>
            </select>
        </div>

         <div class="row">
                <button type="submit" id="btEnviarTarea" name="btEnviarTarea">Enviar</button>
                <button type="reset" id="btClear" name="btClear">Borrar</button>
        </div>
    </form>
</div>

<script>
    // Función para cargar la información de la tarea en modo de edición
    /*function cargarTareaEnEdicion() {
        var urlParams = new URLSearchParams(window.location.search);
        var tareaId = urlParams.get('id');

        if (tareaId) {
            document.getElementById('tareaId').value = tareaId;

            // Aquí debería cargar la información de la tarea y establecer los valores de los campos del formulario
            // Se podría hacer una llamada al servidor para obtener los datos de la tarea con el ID proporcionado
            // Ejemplo:
            document.getElementById('nombre').value = "Nombre de la Tarea";
            document.getElementById('descripcion').value = "Descripción de la Tarea";
            document.getElementById('responsable').value = "Nombre del Responsable";
            document.getElementById('fechaInicio').value = "2022-01-01";
            document.getElementById('fechaFin').value = "2022-12-31";
            document.getElementById('estado').value = "pendiente";
        }
    }

    // Función para redirigir a LandingPage.html al cancelar el formulario
    function cancelarFormulario() {
        window.location.href = "LandingPage.html";
    }

    // Función para validar el formulario antes de redirigir
    function validarFormulario() {
        // Validar aquí los campos del formulario
        var nombre = document.getElementById('nombre').value;
        var responsable = document.getElementById('responsable').value;
        var fechaInicio = document.getElementById('fechaInicio').value;
        var fechaFin = document.getElementById('fechaFin').value;

        // Validar que la Fecha de Fin no sea antes que la Fecha de Inicio
        if (new Date(fechaFin) < new Date(fechaInicio)) {
            alert("La Fecha de Fin no puede ser antes que la Fecha de Inicio");
            return false;
        }

        // Si la validación es exitosa, redirige a LandingPage.html
        window.location.href = "LandingPage.html";

        // Devuelve false para evitar que el formulario se envíe normalmente
        return false;
    }

    // Cargar información de la tarea al cargar la página
    window.onload = cargarTareaEnEdicion;
    */
</script>
    
<?php require 'partials/footer.php' ?>
