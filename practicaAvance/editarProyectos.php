<?php
require 'partials/header.php'; ?>
<div id="containerEditar">
    <form id="fichaProyecto" action="actualizarProyecto.php" name="formulario2" method="post">
        <div class="title">Informacion Proyecto</div>
        <div id="alerts" class="alerts" style="display: none">Existen errores en el formulario</div>
        <input type="hidden" value="control">
        <div class="content">
             <div class="row">
                <div class="label" style="width:25%;"><label for="proyectoId">ID</label></div>
                <div class="field" style="width:25%;">
                    <span id="proyectoId" name="proyectoId"><?php echo $arrayProyects[0] ?></span>
                    <span id="proyectoId_help" class="proyectoId"></span>
                </div>
            </div>
            <div class="row">
                <div class="label" style="width:25%;"><label for="proyectoNombre">Título del Proyecto</label></div>
                <div class="field" style="width:25%;">
                    <input style="width:85%; margin-right:4px;" type="text" id="proyectoNombre2" name="proyectoNombre2" disabled value=<?php echo $arrayProyects[1] ?> placeholder=<?php echo $arrayProyects[1] ?> /><img style="width:8%;" id="editarDescripcion" width="100%" heigth="100%" src="assets/editar.png">
                    <span id="nombreProyecto_help" class="help"></span>
                </div>
            </div>
            <div class="row">
                <div class="label" style="width:25%;"><label for="proyectoDescripcion">Descripcion</label></div>
                <div class="field" style="width:25%;">
                    <input style="width:85%; margin-right:4px;" type="text" id="proyectoDescripcion2" name="proyectoDescripcion2" disabled value=<?php echo $arrayProyects[2] ?> placeholder=<?php echo $arrayProyects[2] ?> /><img style="width:8%;" id="editarEmail" width="100%" heigth="100%" src="assets/editar.png">
                    <span id="email_help" class="help"></span>
                </div>
            </div>
            <div class="row">
                <div class="label" style="width:25%;"><label for="proyectoResponsable">Responsable</label></div>
                <div class="field" style="width:25%;">
                    <input style="width:85%; margin-right:4px;" type="text" id="proyectoResponsable2" name="proyectoResponsable2" disabled value=<?php echo $arrayProyects[3] ?> placeholder=<?php echo $arrayProyects[3] ?> /><img style="width:8%;" id="editarNombre" width="100%" heigth="100%" src="assets/editar.png">
                    <span id="nombre_help" class="help"></span>
                </div>
            </div>
            <div class="row">
                <div class="label" style="width:25%;"><label for="proyectoInicio">Fecha de Inicio</label></div>
                <div class="field" style="width:25%;">
                    <input style="width:85%; margin-right:4px;" type="date" id="proyectoInicio2" name="proyectoInicio2" disabled value=<?php echo $arrayProyects[4] ?> placeholder=<?php echo $arrayProyects[4] ?> /><img style="width:8%;" id="editarApellidos" width="100%" heigth="100%" src="assets/editar.png">
                    <span id="apellidos_help" class="help"></span>
                </div>
            </div>
            <div class="row">
                <div class="label" style="width:25%;"><label for="proyectoFin">Fecha de Fin</label></div>
                <div class="field" style="width:25%;">
                    <input style="width:85%; margin-right:4px;" type="date" id="proyectoFin2" name="proyectoFin2" disabled value=<?php echo $arrayProyects[5] ?> placeholder=<?php echo $arrayProyects[5] ?> /><img style="width:8%;" id="editarApellidos" width="100%" heigth="100%" src="assets/editar.png">
                    <span id="apellidos_help" class="help"></span>
                </div>
            </div>
            <div class="row">
                <div class="label" style="width:25%;"><label for="proyectoEstado">Estado del Proyecto</label></div>
                <div class="field" style="width:25%;">
                    <select id="proyectoEstado" name="proyectoEstado">
                        <option value="activo" <?php if ($arrayProyects[6] == 'activo') {echo 'selected';} ?>>Activo</option>
                        <option value="inactivo" <?php if ($arrayProyects[6] == 'inactivo') {echo 'selected';} ?>>Inactivo</option>
                    </select><img style="width:8%;" id="editarPassword" width="100%" heigth="100%" src="assets/editar.png">
                </div>
            </div>
        </div>
        <div class="row">
            <button type="submit" id="btEnviar2" name="btEnviar">Enviar</button>
            <button type="reset" id="btClear" name="btClear">Borrar</button>
            <button id="btEditarProyecto" name="btEditarProyecto">Editar</button>
        </div>
    </form>
</div>
<?php require 'partials/footer.php' ?>