<?php
    require_once('../support/init.php');          	// Adiciona configurações gerais
    require_once('../support/sessionControl.php');	// Adiciona configurações de sessão
	require_once('../support/dbConfig.php');      	// Conecta com a base de dados
    require_once('../database/db_user.php');   		// Adiciona funções relacionadas ao utilizador
	
	$loggedUser = false;

	// Loading login info
	$utilizador = isset($_POST['utilizador']) ? $_POST['utilizador'] : die(header("Location: " . SITE_ROOT));
	$palavra_passe = isset($_POST['palavra_passe']) ? $_POST['palavra_passe'] : die(header("Location: " . SITE_ROOT));
	
	$_SESSION['validLogin'] = false;
	if(isUser($utilizador, $palavra_passe)){
		$_SESSION['validLogin'] 	  = true;
		$_SESSION['utilizadorLogado'] = $utilizador;
		$_SESSION['isManager'] 		  = getUserTypeByName($utilizador);
		$_SESSION['timeout'] 		  = time();
		if(checkFirstLogin($utilizador) > 0){
			$_SESSION['changePass']   =  1 ;
		}
		die(header("Location: " . SITE_ROOT));
	}else{
		header('Location: ' . SITE_ROOT . 'login.php');
	}
?>