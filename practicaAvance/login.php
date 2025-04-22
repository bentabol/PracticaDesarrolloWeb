
<?php $evitaRedireccion = true;
require 'partials/header.php' ?>
<?php if (!empty($_SESSION['errores'])) : ?>
    <h2> <?= $_SESSION['errores'] ?></h2>
<?php endif;
unset($_SESSION['errores']) ?>
<?php if (!empty($_SESSION['password'])) : ?>
    <h2> <?= $_SESSION['password'] ?></h2>
<?php endif;
unset($_SESSION['password']) ?>
<div id="containerLogin">
    <form id="login" action="loguearse.php" name="formulario" method="post">
        <div class="title"><FONT COLOR="white">Login de usuarios</FONT></div>
        <div id="alerts" class="alerts" style="display: none">Existen errores en el formulario</div>
        <input type="hidden" value="control">
        <div class="content">
            <div class="row">
                <div class="label"><label for="username"><FONT COLOR="white">Username</FONT></label></div>
                <div class="field">
                    <input type="text" id="username" name="username" placeholder="Introduce tu nombre de usuario" />
                    <span id="username_help" class="help"></span>
                </div>
            </div>
            <div class="row">
                <div class="label"><label for="password"><FONT COLOR="white">Contraseña</FONT></label></div>
                <div class="field"><input class="field" type="password" id="password" name="password" placeholder="Introduce tu contraseña" />
                </div>
                <span id="password_help" class="help"></span>
            </div>
            <a href="recuperarPassword.php" id="olvidoPassword" class="olvido">He olvidado mi contraseña</a>
            <div class="row">
                <button type="submit" id="btEnviar" name="btEnviar">Enviar</button>
                <button type="reset" id="btClear" name="btClear">Borrar</button>
            </div>
        </div>
    </form>
</div>
<?php require 'partials/footer.php' ?>