<?php
//Si el usuario pulsa el botón de salir, destruirá la sesión y lo redirigirá al index donde está el login
session_start();

session_unset();

session_destroy();

header('Location: index.php');