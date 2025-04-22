<?php
require 'partials/header.php';
require 'config/conn.php';
require 'bootstrap.php';

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use model\Repository\UserRepository;
use model\Repository\InformesRepository;
use model\Repository\ProyectRepository;

$UserRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_usuarios");
$InformesRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_informes");
$ProyectRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_proyectos");

$searchNickname = isset($_POST['searchNickname']) ? $_POST['searchNickname'] : '';
$filtroRol = 'cliente'; // Filtramos por el rol de cliente

$activeUsers = $UserRepository->getUsersOrderActives($filtroRol, $searchNickname);
$arrayUsers = $UserRepository->getDatosUsuario($_SESSION['username']);
?>

<form id="searchForm" method="post" action="">
    <center>
        <input type="text" name="searchNickname" id="searchNickname" placeholder="Buscar por nickname">
        <button type="submit" name="search" value="Buscar">Buscar</button>
    </center>
</form>

<form id="filtroPorRol" method="post" action="">
    <center>
        <input type="hidden" name="filtroRol" id="filtroRol" value="cliente">
        <button type="submit" class="botonesInformes" name="filtro" value="cliente">Clientes</button>
    </center>
</form>

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
                <table id="tblUsuarios" class='informes'>
                    <caption>
                        <h2>Informe usuarios por actividad</h2>
                    </caption>
                    <thead>
                        <tr>
                            <th>ID USUARIO</th>
                            <th>NICKNAME</th>
                            <th>EMAIL</th>
                            <th>NOMBRE</th>
                            <th>APELLIDOS</th>
                            <th>ROL USUARIO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($activeUsers as $activeUser): ?>
                        <tr>
                            <td><?= $activeUser->getid_usuario() ?></td>
                            <td><?= $activeUser->getc_nickname() ?></td>
                            <td><?= $activeUser->getc_email() ?></td>
                            <td><?= $activeUser->getc_nombre() ?></td>
                            <td><?= $activeUser->getc_apellidos() ?></td>
                            <td><?= $activeUser->getn_idtipo_usuario()->getc_descripcion() ?></td>
                            <td>
                                <div class='btnComprarTOP2'>
                                    <form name='nameForm' action='unirseProyectosGestor.php' method='post'>
                                        <input type='hidden' name='idUsuario' value="<?= $activeUser->getid_usuario() ?>"/>                                        
                                        <button type='submit' id='btEnviar' name='btUnirseGestor'>Solicitar Unirse</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function filtrarPorRol(rol) {
    document.getElementById('filtroRol').value = rol;
    return true;
}

$('#searchForm').submit(function(e) {
    e.preventDefault();
    const searchNickname = $('#searchNickname').val();

    $.ajax({
        url: 'getUsersOrderActives.php',
        type: 'POST',
        data: { searchNickname: searchNickname, filtroRol: 'cliente' },
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
                        <td>${user.n_idtipo_usuario}</td>
                        <td>
                            <div class='btnComprarTOP2'>
                                <form name='nameForm' action='unirseProyecto.php' method='post'>
                                    <input type='hidden' name='idUsuario' value="${user.id_usuario}"/>
                                    <button type='submit' id='btEnviar' name='btUnirse'>Solicitar Unirse</button>
                                </form>
                            </div>
                        </td>
                    </tr>`;
                });
            } else {
                html = '<tr><td colspan="9" align="center">No se encontraron usuarios.</td></tr>';
            }

            $('#tblUsuarios tbody').html(html);
        }
    });
});
</script>
</body>
</html>
