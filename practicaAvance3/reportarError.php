<?php require 'partials/header.php'; ?>
<?php if (!empty($_SESSION['errores'])) : ?>
    <h2> <?= $_SESSION['errores'] ?></h2>
<?php endif;
unset($_SESSION['errores']);
?>
?>
<div id="container">
    <form id="registro" action="actualizarError.php" name="formulario" method="post">
        <div class="title">Reportar Error</div>
        <div class="content">
            <div class="row">
                <input type='hidden' name='idProyecto' value="<?php echo $_POST['idProyecto']; ?>  " />
                <input type='hidden' name='idUsuario' value="<?php echo $_POST['idUsuario']; ?> " />
                <div class=" label"><label for="errorName">Describa el error</label>
                </div>
                <input type="textarea" name="errores" rows="10" cols="40" id="username" placeholder="Describa el error" required />
            </div>
            <div class="row">
                <button type="submit" id="btEnviar" name="btValorar">Reportar</button>
                <button type="reset" id="btClear" name="btClear">Borrar</button>
            </div>
        </div>
    </form>
</div>
<?php require 'partials/footer.php' ?>