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
            <input type="text" id="titulo" name="titulo" placeholder="Introduce el título de la reunión" required>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha de la Reunión</label>
            <input type="date" id="fecha" name="fecha" required>
        </div>

        <div class="form-group">
            <label for="hora">Hora de la Reunión</label>
            <input type="time" id="hora" name="hora" required>
        </div>

        <div class="form-group">
            <label for="lugar">Lugar de la Reunión</label>
            <input type="text" id="lugar" name="lugar" placeholder="Introduce el lugar de la reunión" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción de la Reunión</label>
            <textarea id="descripcion" name="descripcion" placeholder="Introduce la descripción de la reunión" required></textarea>
        </div>

         <div class="row">
                <button type="submit" id="btEnviar" name="btEnviar">Enviar</button>
                <button type="reset" id="btClear" name="btClear">Borrar</button>
        </div>
    </form>
</div>

<script>
    function validarFormulario() {
        // Obtener el valor del campo del título
        var titulo = document.getElementById('titulo').value;

        // Verificar si el título supera los 100 caracteres
        if (titulo.length > 100) {
            alert("El título no puede tener más de 100 caracteres.");
            return false; // Evitar que el formulario se envíe
        }


        // Si la validación es exitosa, redirige a LandingPage.html
        window.location.href = "LandingPage.html";
        
        // Devuelve false para evitar que el formulario se envíe normalmente
        return false;
    }

    function cancelarConvocatoria() {
        window.location.href = "LandingPage.html";
    }
</script>
    
<?php require 'partials/footer.php' ?>

