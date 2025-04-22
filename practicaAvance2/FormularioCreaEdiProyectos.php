<?php require 'partials/header.php' ?>
<?php if (!empty($_SESSION['errores'])) : ?>
    <h2> <?= $_SESSION['errores'] ?></h2>
<?php endif;
unset($_SESSION['errores']) ?>
<header>
</header>
<div id="containerRegistrar">
    <form id="creaProyecto" action="importarProyecto.php" name="formulario" method="post" enctype="multipart/form-data">
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
                <div class="label"><label for="proyectoArchive">Archivo del proyecto</label></div>
                <div class="field">
                    <input type="file" id="proyectoArchive" name="proyectoArchive" required>
                </div>
            </div>

        <div class="row">
                <button type="submit" id="btEnviarProyecto" name="btEnviarProyecto">Enviar</button>
                <button type="reset" id="btClear" name="btClear">Borrar</button>
        </div>
    </form>
</div>


    
<?php require 'partials/footer.php' ?>
