<?php require 'partials/header.php';?>



<form id="searchForm" method="post" action="">
    <center>
        <input type="text" name="searchNickname" id="searchNickname" placeholder="Buscar por nickname">
        <button type="submit" name="search" value="Buscar">Buscar</button>
    </center>
</form>

<form id="filtroPorRol" method="post" action="">
    <center>
        <input type="hidden" name="filtroRol" id="filtroRol">
        <button type="button" class="botonesInformes" name="filtro" value="gestor" onclick="filtrarPorRol('gestor')">Gestor</button>
        <button type="button" class="botonesInformes" name="filtro" value="cliente" onclick="filtrarPorRol('cliente')">Clientes</button>
        <button type="button" class="botonesInformes" name="filtro" value="administrador" onclick="filtrarPorRol('administrador')">Administradores</button>
        <button type="button" name="filtro" value="" onclick="filtrarPorRol('')">Sin filtro</button>
    </center>
</form>

<?php
$filtroRol = isset($_POST['filtroRol'])? $_POST['filtroRol'] : '';
$searchNickname = isset($_POST['searchNickname'])? $_POST['searchNickname'] : '';

$activeUsers = getUsersOrderActives($filtroRol, $searchNickname);
$arrayUsers = getDatosUsuario($_SESSION['username']);
?>

<?php if (!empty($_SESSION['errores'])) :?>
    <h2> <?= $_SESSION['errores']?></h2>
<?php endif;
unset($_SESSION['errores'])?>
<span style="color:grey">Informes</span>
</div>
<style>
   .InformesUser {
    display: flex;
    justify-content: center;
    align-items: center;
    border: solid 1px white;
    background-color: #9999FF;
    border-radius: 5px;
    margin-left: 10%;
    margin-right: 10%;
    margin-top: 20px;
    margin-bottom: 20px;
    }
   .EditarUsuario {
    background-color: #9999FF;
    display: flex;
    justify-content: center;
    align-items: center;
    }
    #editUserModalContainer {
        display: none;
    }
    .botonesInformes {
    display: inline;
    text-decoration: none;
    background-color: #9999FF;
    border-color: white;
    margin-bottom: 5px;
    float: center;
    margin-right: 8px;
    }

    .botonesInformes:hover {
        text-decoration: none;
        background-color: #CDCDFF;
        margin-bottom: 5px;
        margin-right: 8px;
    }
</style>
<div class="InformesUser">
    <div>
        
        <div>
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
                      <tbody id='usersBody'>";
                    foreach ($activeUsers as $activeUser) {

                        echo "<tr>
                          <td>". $activeUser['id_usuario']. "</td>
                          <td>". $activeUser['c_nickname']. "</td>
                          <td>". $activeUser['c_email']. "</td>
                          <td>". $activeUser['c_nombre']. "</td>
                          <td>". $activeUser['c_apellidos']. "</td>
                          <td>". $activeUser['c_password']. "</td>";
                        $userOn = usuarioActivo($activeUser['l_activo']);
                        echo"<td>". $userOn. "</td>
                          <td>". $activeUser['t_conexiones']. "</td>";
                        $userTipe = tipoUsuario($activeUser['n_idtipo_usuario']);
                        echo " <td>".  $userTipe. "</td>
                          <td> <div class='btnComprarTOP2'>
                          <form name='nameForm' action='desactivarUser.php' method='post'>                                   
                              <input type='hidden' name='idUsuario' value=". $activeUser["id_usuario"]. "/>                                        
                              <button type='submit' id='btEnviar' name='btDesactivar'>Activar/Desactivar</button>
                          </form>
                          <button type='button' id='btEditar' class='btn btn-primary' data-toggle='modal' data-target='#editUserModalContainer' onclick='setUserData(". $activeUser["id_usuario"]. ")'>Edit</button>   
                      </div></td>   
                        </tr>";
                    }?>
                </table>
            </div>
        </div>
    </div>
</div>
<center><div id="editUserModalContainer" tabindex="-1" role="dialog" aria-labelledby="InformesUserLabel" aria-hidden="true">
  <div class="EditarUsuario" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="InformesUserLabel">Editar User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#editUserModalContainer').hide();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editUserForm" method="post" action="actualizarUsuarioAdministrador.php">
            <input type="hidden" id="userId" name="userId" value="<?php echo $activeUser['id_usuario'];?>">
            <div class="form-group">
                <label for="editEmail">Email</label>
                <input type="email" class="form-control" id="editEmail" name="editEmail" required>
            </div>
            <div class="form-group">
                <label for="editName">Nombre</label>
                <input type="text" class="form-control" id="editName" name="editName" required>
            </div>
            <div class="form-group">
                <label for="editLastname">Apellidos</label>
                <input type="text" class="form-control" id="editLastname" name="editLastname" required>
            </div>
            <div class="form-group">
                <label for="editPassword">Password</label>
                <input type="password" class="form-control" id="editPassword" name="editPassword" required>
            </div>
            <div class="form-group">
                <label for="editRole">Rol</label>
                <select class="form-control" id="editRole" name="editRole">
                    <option value="1" >Admin</option>
                    <option value="2">Gestor</option>
                    <option value="3">Cliente</option>
                </select>
            </div>
            <button type="submit" id="btEnviar" class="btn btn-primary" name="btEnviar">Aplicar Cambios</button>
        </form>
      </div>
    </div>
  </div>
</div></center>
    <script>
            function filtrarPorRol(rol) {
                document.getElementById('filtroRol').value= rol;
                document.getElementById('filtroPorRol').submit();
            }
            function setUserData(idUsuario) {
              $.ajax({
                url: 'getUserData.php',
                type: 'POST',
                data: { idUsuario: idUsuario },
                success: function(response) {
                  // Parse the JSON response
                  const userData = JSON.parse(response);

                  // Set the user data in the edit user modal
                  $('#userId').val(userData.id_usuario);
                  $('#editNickname').val(userData.c_nickname);
                  $('#editEmail').val(userData.c_email);
                  $('#editName').val(userData.c_nombre);
                  $('#editLastname').val(userData.c_apellidos);
                  $('#editPassword').val(userData.c_password);
                  $('#editActive').val(userData.l_activo);
                  $('#editRole').val(userData.n_idtipo_usuario);

                  // Add a hidden input field for the user ID
                  $('<input>').attr('type', 'hidden').attr('name', 'idUsuario').attr('value', idUsuario).appendTo('#editUserForm');

                  // Show the modal
                  $('#editUserModalContainer').show();
                }
            });
          }

            $('#searchForm').submit(function(e) {
                e.preventDefault();
                const searchNickname = $('#searchNickname').val();
                $.ajax({
                    url: 'getUsersOrderActives.php',
                    type: 'POST',
                    data: { searchNickname: searchNickname },
                    success: function(response) {
                        const users = JSON.parse(response);
                        let html = '';
                        if (users.length > 0) {
                            users.forEach(user => {
                                html += `<tr>
                                          <td>${user.id_usuario}</td>
                                          <td>${user.c_nickname}</td>
                                          <td>${user.c_email}</td>
                                          <td>${user.c_nombre}</td>
                                          <td>${user.c_apellidos}</td>
                                          <td>${user.c_password}</td>
                                          <td>${user.l_activo}</td>
                                          <td>${user.t_conexiones}</td>
                                          <td>${user.n_idtipo_usuario}</td>
                                          <td>
                                            <div class='btnComprarTOP2'>
                                              <form name='nameForm' action='desactivarUser.php' method='post'>                                   
                                                  <input type='hidden' name='idUsuario' value="${user.id_usuario}"/>                                        
                                                  <button type='submit' id='btEnviar' name='btDesactivar'>Activar/Desactivar</button>
                                              </form>
                                              <button type='button' id='btEditar' class='btn btn-primary' data-toggle='modal' data-target='#editUserModalContainer' onclick="setUserData(${user.id_usuario})">Edit</button>   
                                          </div>
                                          </td>
                                        </tr>`;
                            });
                        } else {
                            html += `<tr>
                                      <td colspan="9">No se encontraron usuarios con el nickname "${searchNickname}".</td>
                                    </tr>`;
                        }
                        $('#usersBody').html(html);
                    }
                });
            });
    </script>
<?php require 'partials/footer.php'; ?>


<?php
function getUsersOrderActives($filtroRol = '', $searchNickname = '')
{
    require 'config/conn.php';
    $query = "SELECT * FROM bentatecnologies_usuarios ";
    $query.= "INNER JOIN bentatecnologies_tipo_usuarios ON bentatecnologies_usuarios.n_idtipo_usuario = bentatecnologies_tipo_usuarios.id_tipo_usuario ";
    if (!empty($filtroRol)) {
        $query.= "WHERE bentatecnologies_tipo_usuarios.c_descripcion = :filtroRol ";
    }
    if (!empty($searchNickname)) {
        $query.= "AND bentatecnologies_usuarios.c_nickname LIKE :searchNickname ";
    }
    $query.= "ORDER BY bentatecnologies_usuarios.c_nickname";
    $datos = $conn->prepare($query);
    if (!empty($filtroRol)) {
        $datos->execute(['filtroRol' => $filtroRol]);
    }
    if (!empty($searchNickname)) {
        $datos->execute(['searchNickname' => '%'. $searchNickname. '%']);
    } else {
        $datos->execute();
    }
    $actives = $datos->fetchAll(PDO::FETCH_ASSOC);
    return $actives;
}
?>