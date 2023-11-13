<?php
    require_once('support/init.php');               // Adiciona configurações gerais
    require_once('support/sessionControl.php');     // Adiciona configurações de sessão
	require_once('support/dbConfig.php');           // Conecta com a base de dados
    require_once('database/db_intervention.php');   // Adiciona funções relacionadas à intervenção
    require_once('database/db_user.php');           // Adiciona funções relacionadas ao utilizador
    require_once('database/db_equipment.php');      // Adiciona funções relacionadas ao equipamento
    
    if(isset($_SESSION['changePass']))
		die(header('location: ' . SITE_ROOT . 'password_edit.php'));
    
    // Consultas necessárias
    $userId = getUserIdByRegistry($_SESSION['utilizadorLogado']);
    $nomeUtilizador = getUserNameByRegistry($_SESSION['utilizadorLogado']);
    $listaUtilizadores = listUser();
    $listaEquipamentos = listAllowedEquipment($userId);

    // Monta página
    $titulo_pagina  = "Intervenções";
    include('templates/tpl_head.php');
    include('templates/tpl_header.php');
    include('templates/tpl_intervention_edit.php');
    include('templates/tpl_footer.php');
?>