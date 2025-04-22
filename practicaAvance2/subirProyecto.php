<?php require 'partials/header.php';
<?php if (!empty($_SESSION['errores'])) : ?>
    <h2> <?= $_SESSION['errores'] ?></h2>
<?php endif;
unset($_SESSION['errores']) ?>
<div id="container">
    <form id="registro" action="importarProyecto.php" name="formulario" method="post" enctype="multipart/form-data">
        <div class="title">Subir proyecto ya creado</div>
        <div id="alerts" class="alerts" style="display: none">Existen errores en el formulario</div>
        <input type="hidden" value="control">
        <div class="content">
            <div class="row">
                <div class="label"><label for="proyectName">Nombre del proyecto</label></div>
                <div class="field">
                    <input type="text" id="username" name="proyectName" placeholder="Introduce el titulo del proyecto" required />
                </div>
            </div>
            <div class="row">
                <div class="label"><label for="proyectDescription">Descripción del Proyecto</label></div>
                <div class="field">
                    <input type="text" id="username" name="pluginDescription" placeholder="Introduce la descripcion del proyecto a importar" required />
                </div>
            </div>
            <div class="row">
                <div class="label"><label for="proyectoArchive">Archivo del proyecto</label></div>
                <div class="field">
                    <input type="file" id="username" name="proyectoArchive" required>
                </div>
            </div>
            <div class="row">
                <button type="submit" id="btEnviar" name="btEnviar">Enviar</button>
                <button type="reset" id="btClear" name="btClear">Borrar</button>
            </div>
        </div>
    </form>
</div>
<?php require 'partials/footer.php' ?>