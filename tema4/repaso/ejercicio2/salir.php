<?php
    session_start();
    $_SESSION['usuario'] = '';
    $_SESSION['psw'] = '';
    $_SESSION['perfil'] = '';
    header('Location: index.php');
?>