<?php require 'partials/header.php';

$activeUsers = getUsersOrderActives();
$proyects = getAllProyects();
$downloads = getInformesDescargas();
$tarea = getAllTareas();
//$downloads = getInformesDescargas();
$arrayUsers = getDatosUsuario($_SESSION['username']);
?>
<?php if (!empty($_SESSION['errores'])) : ?>
    <h2> <?= $_SESSION['errores'] ?></h2>
<?php endif;
unset($_SESSION['errores']) ?>
<span style="color:grey">Informes</span>
</div>
<div class="catalogo">
    <div class="Apps2">
        <div class="navApps2">
            <div class="tituloCatalogo">Informes de Administrador</div>
        </div>
        <div class="bodyApps3">
            <div class="topApps3">
                <br></br>
                <table class='informes'>
                    <caption>
                        <h2>Informe usuarios por actividad</h2>
                    </caption>
                    <?php echo "<thead>
                        <tr>
                          <th>ID USUARIO</th>
                          <th>NICKNAME</th>
                          <th>EMAIL</th>
                          <th>NOMBRE</th>
                          <th>APELLIDOS</th>                          
                          <th>PASSWORD</th>
                          <th>ACTIVO</th>
                          <th>Nº CONEXIONES</th>
                          <th>ROL USUARIO</th>
                        </tr>
                      </thead>
                      <tbody>";
                    foreach ($activeUsers as $activeUser) {

                        echo "<tr>
                          <td>" . $activeUser['id_usuario'] . "</td>
                          <td>" . $activeUser['c_nickname'] . "</td>
                          <td>" . $activeUser['c_email'] . "</td>
                          <td>" . $activeUser['c_nombre'] . "</td>
                          <td>" . $activeUser['c_apellidos'] . "</td>
                          <td>" . $activeUser['c_password'] . "</td>";
                        $userOn = usuarioActivo($activeUser['l_activo']);
                        echo "<td>" . $userOn . "</td>
                          <td>" . $activeUser['t_conexiones'] . "</td>";
                        $userTipe = tipoUsuario($activeUser['n_idtipo_usuario']);
                        echo " <td>" .  $userTipe . "</td>
                          <td> <div class='btnComprarTOP2'>
                          <form name='nameForm' action='desactivarUser.php' method='post'>                                   
                              <input type='hidden' name='idUsuario' value=" . $activeUser["id_usuario"] . "/>                                        
                              <button type='submit' id='btEnviar' name='btDesactivar'>Activar/Desactivar</button>
                          </form>                                
                      </div></td>
                        </tr>";
                    } ?>
                </table>
                <table class='informesDescarga'>
                    <caption>
                        <h2>Informe descarga de proyectos</h2>
                    </caption>
                    <?php echo "<thead>
                        <tr>
                          <th>ID INFORME</th>
                          <th>FECHA DE CREACION</th>
                          <th>ERRORES</th>
                          <th>DESCARGAS</th>                          
                          <th>EXPORTACIONES</th>
                          <th>ID PROYECTO</th>                          
                          <th>ID USUARIO</th>                          
                        </tr>
                      </thead>
                      <tbody>";
                    foreach ($downloads as $dowload) {

                        echo "<tr>
                          <td>" . $dowload['id_informe'] . "</td>
                          <td>" . $dowload['f_fecha'] . "</td>
                          <td>" . $dowload['c_errores'] . "</td>
                          <td>" . $dowload['t_descargas'] . "</td>
                          <td>" . $dowload['t_exportaciones'] . "</td>
                          <td>" . $dowload['n_idproyecto'] . "</td>
                          <td>" . $dowload['n_idusuario'] . "</td>                                               
                        </tr>";
                    } ?>
                </table>
                
            </div>
        </div>
    </div>
</div>
<?php require 'partials/footer.php'; ?>