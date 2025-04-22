<?php
require 'partials/header.php';
require 'config/conn.php';
require 'bootstrap.php';

use App\Repository\UserRepository;
use App\Repository\ProyectRepository;
use App\Repository\SolicitudesRepository;
use Model\Entity\bentatecnologies_solicitudes;

$entityManager = $em;
$solicitudesRepository = $entityManager->getRepository(bentatecnologies_solicitudes::class);

$solicitudesPendientes = $solicitudesRepository->getSolicitudesGestor($_SESSION['idUsuario']);

if (!empty($_SESSION['errores'])) : ?>
    <h2> <?= $_SESSION['errores'] ?></h2>
<?php endif;
unset($_SESSION['errores']) ?>

<span style="color:grey">Mis Solicitudes</span>
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
    .button {
        background-color: pink;
    }
</style>

<div class="InformesUser">
    <div class="Apps2">
        <div class="navApps2">
        </div>
        <div class="bodyApps2">
            <div class="topApps2">
                <br></br>
                <table>
                    <caption>
                        <h2>Solicitudes Pendientes</h2></caption>
                    <thead>
                        <tr>
                            <th>ID USER</th>
                            <th>NOMBRE</th>
                            <th>ACCION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($solicitudesPendientes as $solicitud) : ?>
                            <tr>
                                <td><?= $solicitud->getn_idusuario()->getid_Usuario() ?></td>
                                <td><?= $solicitud->getn_idusuario()->getc_nickname() ?></td>
                                <td>
                                    <form name='nameForm' action='aceptarProyectoGestor.php' method='post'>
                                        <button type='submit' id='btEnviar' name='btAceptar'>Aceptar</button>
                                        <input type='hidden' name='idProyecto' value="<?php echo $solicitud->getn_idproyecto()->getid_Proyecto() ?>"/>
                                        <input type='hidden' name='idUsuario' value="<?php echo $solicitud->getn_idusuario()->getid_Usuario() ?>"/>
                                    </form>
                                </td>
                            </tr>
                            
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require 'partials/footer.php'; ?>