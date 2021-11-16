<?php
    session_start();
    require_once('../support/init.php');            // Adiciona configurações gerais
    session_unset();                                // Limpa variável de sessão
    session_destroy();                              // Destrói sessão
    header('Location: ' . SITE_ROOT . 'login.php'); // Redireciona para a página de loogin
?>