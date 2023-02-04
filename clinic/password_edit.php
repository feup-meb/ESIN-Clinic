<?php
    require_once('support/init.php');           // Adiciona configurações gerais
    require_once('support/sessionControl.php'); // Adiciona configurações de sessão
    require_once('support/dbConfig.php');       // Conecta com a base de dados
    require_once('database/db_user.php');       // Adiciona funções relacionadas ao utilizador
    require_once('database/db_equipment.php');      // Adiciona funções relacionadas ao equipamento

    // Verifica se há utilizador
    $nomeUtilizador = getUserNameByRegistry($_SESSION['utilizadorLogado']);

    // Consultas necessárias
    $userId = getUserIdByRegistry($_SESSION['utilizadorLogado']);
    $listaEquipamentos = listAllowedEquipment($userId);
    
    // Monta página
    $titulo_pagina = "Alteração de palavra-passe";
    include('templates/tpl_head.php');
    include('templates/tpl_header.php');
    include('templates/tpl_password_edit.php');
    include('templates/tpl_footer.php');
?>