<?php
session_start(); // Inicia a sessão para poder destruí-la
session_destroy(); // Destrói todas as informações salvas (desloga)
header("Location: login.php"); // Manda de volta para a tela de login
exit();
?>