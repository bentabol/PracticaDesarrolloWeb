<?php require 'partials/header.php' ?>
<?php if (!empty($_SESSION['errores'])) : ?>
    <h2> <?= $_SESSION['errores'] ?></h2>
<?php endif;
unset($_SESSION['errores']) ?>
<header>
    <h1>Convocatoria de Reunión</h1>
</header>
<div id="containerRegistrar">
    <form id="convocatoriaReunionForm" name="convocatoriaReunionForm" method="post" onsubmit="return validarFormulario()">
        <div class="form-group">
            <label for="titulo">Título de la Reunión</label>
            <input type="text" id="tituloReunion" name="tituloReunion" placeholder="Introduce el título de la reunión" required>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha de la Reunión</label>
            <input type="date" id="fechaReunion" name="fechaReunion" required>
        </div>

        <div class="form-group">
            <label for="hora">Hora de la Reunión</label>
            <input type="time" id="horaReunion" name="horaReunion" required>
        </div>

        <div class="form-group">
            <label for="lugar">Lugar de la Reunión</label>
            <input type="text" id="lugarReunion" name="lugarReunion" placeholder="Introduce el lugar de la reunión" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción de la Reunión</label>
            <textarea id="descripcionReunion" name="descripcionReunion" placeholder="Introduce la descripción de la reunión" required></textarea>
        </div>

         <div class="row">
                <button type="submit" id="btEnviarReunion" name="btEnviarReunion">Enviar</button>
                <button type="reset" id="btClear" name="btClear">Borrar</button>
        </div>
    </form>
</div>


    
<?php require 'partials/footer.php' ?>

