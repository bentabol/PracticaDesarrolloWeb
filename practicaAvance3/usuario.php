<?php
require 'partials/header.php'; ?>
<div id="containerEditar">
  <form id="fichaCliente" action="actualizarUsuario.php" name="formulario2" method="post">
    <div class="title">Perfil de usuario</div>
    <div id="alerts" class="alerts" style="display: none">Existen errores en el formulario</div>
    <input type="hidden" value="control">

    <div class="content">
      <div class="row">
       <input type="hidden" value="<?php echo $arrayUsers->getc_nickname() ?> " name="username3">
        <div class="label" style="width:25%;"><label for="username">Username</label></div>
        <div class="field" style="width:25%;">
          <input style="width:85%; margin-right:4px;" type="text" id="editUsuario" name="editUsuario" value="<?php echo $arrayUsers->getc_nickname() ?>" placeholder="<?php echo $arrayUsers->getc_nickname() ?>" disabled />
          <span id="username_help" class="help"></span>
        </div>
      </div>
      <div class="row">
        <div class="label" style="width:25%;"><label for="email">Email</label></div>
        <div class="field" style="width:25%;">
          <input style="width:85%; margin-right:4px;" type="text" id="email2" name="email2" disabled value=<?php echo $arrayUsers->getc_email()?> placeholder=<?php echo $arrayUsers->getc_email()?> />
          <img style="width:8%;" id="editarEmail" width="100%" heigth="100%" src="assets/editar.png">
          <span id="email_help" class="help"></span>
        </div>
      </div>
      <div class="row">
        <div class="label" style="width:25%;"><label for="nombre">Nombre</label></div>
        <div class="field" style="width:25%;">
          <input style="width:85%; margin-right:4px;" type="text" id="nombre2" name="nombre2" disabled value=<?php echo $arrayUsers->getc_nombre() ?> placeholder=<?php echo $arrayUsers->getc_nombre() ?>  />
          <img style="width:8%;" id="editarNombre" width="100%" heigth="100%" src="assets/editar.png">
          <span id="nombre_help" class="help"></span>
        </div>
      </div>
      <div class="row">
        <div class="label" style="width:25%;"><label for="apellidos">Apellidos</label></div>
        <div class="field" style="width:25%;">
          <input style="width:85%; margin-right:4px;" type="text" id="apellidos2" name="apellidos2" disabled value=<?php echo $arrayUsers->getc_apellidos() ?> placeholder=<?php echo $arrayUsers->getc_apellidos() ?>  />
          <img style="width:8%;" id="editarApellidos" width="100%" heigth="100%" src="assets/editar.png">
          <span id="apellidos_help" class="help"></span>
        </div>
      </div>
      <div class="row">
        <div class="label" style="width:25%;"><label for="password2">Contraseña</label></div>
        <div class="field" style="width:25%;">
          <input style="width:85%; margin-right:4px;" class="field" type="password2" id="password2" name="password2" disabled value=<?php echo $arrayUsers->getc_password() ?> placeholder=<?php echo $arrayUsers->getc_password()?>  />
          <img style="width:8%;" id="editarPassword" width="100%" heigth="100%" src="assets/editar.png">
        </div>
      </div>
    </div>
    <div class="row">
      <button type="submit" id="btEnviar2" name="btEnviar">Enviar</button>
      <button type="reset" id="btClear" name="btClear">Borrar</button>
      <button id="btEditar" name="btEditar">Editar</button>
    </div>
  </form>
</div>
<?php require 'partials/footer.php' ?>