<form id="registro" action="actualizarUsuario.php" name="formulario" method="post">
        <div class="title">Registro de usuarios</div>
        <div id="alerts" class="alerts" style="display: none">Existen errores en el formulario</div>
        <input type="hidden" value="control">
        <div class="content">
            <div class="row">
                <div class="label"><label for="username">Username</label></div>
                <div class="field">
                    <input type="text" id="username" name="username" placeholder="Introduce un username valido" />
                    <span id="username_help" class="username"></span>
                </div>
            </div>
            <div class="row">
                <div class="label"><label for="email">Email</label></div>
                <div class="field">
                    <input type="text" id="email" name="email" placeholder="Introduce un email valido" />
                    <span id="email_help" class="help"></span>
                </div>
            </div>
            <div class="row">
                <div class="label"><label for="nombre">Nombre</label></div>
                <div class="field">
                    <input type="text" id="nombre" name="nombre" placeholder="Introduce un nombre valido" />
                    <span id="nombre_help" class="help"></span>
                </div>
            </div>
            <div class="row">
                <div class="label"><label for="apellidos">Apellidos</label></div>
                <div class="field">
                    <input type="text" id="apellidos" name="apellidos" placeholder="Introduce aqui tus apellidos" />
                    <span id="apellidos_help" class="help"></span>
                </div>
            </div>
            <div class="row">
                <div class="label"><label for="password">Contraseña</label></div>
                <div class="field"><input class="field" type="password" id="password" name="password" placeholder="Introduce aqui tu contraseña" />
                </div>
                <span id="password_help" class="help"></span>
            </div>
            <div class="row">
                <div class="label"><label for="password1">Repite contraseña</label></div>
                <div class="field"><input type="password" id="password1" name="password1" placeholder="Introduce de nuevo tu contraseña" />
                    <span id="password1_help" class="help"></span>
                </div>
            </div>

            <div id="vipPane" class="vipPane" style="display: block; background-color: #ccc">
                <div class="row field">
                    <label for="tipo">Tipo de rango</label>
                    <input type="radio" id="tipo_0" name="tipo" value="Participante" />Participante
                    <input type="radio" id="tipo_1" name="tipo" value="Gestor" />Gestor Proyectos
                    <input type="radio" id="tipo_2" name="tipo" value="Administrador" />Administrador
                </div>


                
            </div>
            <div class="row">
                <button type="submit" id="btEnviar" name="btEnviar">Enviar</button>
                <button type="reset" id="btClear" name="btClear">Borrar</button>
            </div>
        </div>
    </form>