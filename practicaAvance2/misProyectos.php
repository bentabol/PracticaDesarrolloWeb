<?php require 'partials/header.php';
$arrayUsers = getDatosUsuario($_SESSION['username']);
$misProyect = getMyProyects($arrayUsers[0]['id_usuario']); ?>
<?php if (!empty($_SESSION['errores'])) : ?>
    <h2> <?= $_SESSION['errores'] ?></h2>
<?php endif;
unset($_SESSION['errores']) ?>
<span style="color:grey">Mis Aplicaciones</span>
</div>
<div class="catalogo">
    <div class="Apps2">
        <div class="navApps2">
            <div class="tituloCatalogo">Mis Plugins</div>
        </div>
        <div class="bodyApps2">
            <div class="topApps2">
                Mis Plugins
                <br></br>
                <table>
                    <?php foreach ($misProyect as $misProyects) {
                        echo "<tr>                    
                        <td>
                            <table>
                                <tr>
                                    <div class='nombreTopApp'>" . $misProyects['c_nombreProyecto'] . "</div>
                                </tr>
                                <tr>              
                                </div>                                    
                                    <td>
                                        <div class='descripcionDesarrollo'>" . $misProyects['c_descripcionProyecto'] . "</div>
                                    </td>
                                </tr>
                            </table>
                        </td>";
                        if (isset($arrayUsers)) {
                            if ($arrayUsers[0]["n_idtipo_usuario"] == 3) {
                                echo "<td>
                            <div class='btnComprarTOP2'>
                                <form name='nameForm' action='descargarProyecto.php' method='post'>
                                    <input type='hidden' name='idProyecto' value=" . $misProyects['id_proyecto'] . "/>
                                    <input type='hidden' name='idUsuario' value=" . $arrayUsers[0]["id_usuario"] . "/>                                        
                                    <button type='submit' id='btEnviar' name='btDescargar'>Descargar</button>
                                </form>                                
                            </div>
                            <div class='btnComprarTOP2'>
                                <form name='nameForm' action='reportarError.php' method='post'>
                                    <input type='hidden' name='idProyecto' value=" . $misProyects['id_proyecto'] . " />
                                    <input type='hidden' name='idUsuario' value=" . $arrayUsers[0]["id_usuario"] . " />                                        
                                    <button type='submit' id='btEnviar' name='btReportar'>ReporarError</button>
                                </form>                                
                            </div>
                        </td>";
                            }
                        };
                        echo " </tr>";
                    } ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require 'partials/footer.php'; ?>