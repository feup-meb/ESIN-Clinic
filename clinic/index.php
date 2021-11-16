<?php
    require_once('support/init.php');           // Adiciona configurações gerais
    require_once('support/sessionControl.php'); // Adiciona configurações de sessão
    require_once('support/dbConfig.php');       // Conecta com a base de dados
    require_once('database/db_user.php');       // Adiciona funções relacionadas ao utilizador
    
	if(isset($_SESSION['changePass']))
		die(header('location: ' . SITE_ROOT . 'password_edit.php'));
    
    // Direciona para a página de intervenções
    header('Location: ' . SITE_ROOT . 'intervention.php');
?>