<?php
    require_once('support/init.php');           // Adiciona configurações gerais
    require_once('support/dbConfig.php');       // Conecta com a base de dados

    // Verifica se há utilizador
    $utilizador = isset($_POST['utilizador']) ? $_POST['utilizador'] : '';
    
    // Monta página
    $titulo_pagina = "Login";
    include('templates/tpl_head.php');
    include('templates/tpl_header.php');
    include('templates/tpl_login.php');
    include('templates/tpl_footer.php');
?>