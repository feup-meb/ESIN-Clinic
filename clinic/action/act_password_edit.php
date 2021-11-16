<?php
	require_once('../support/init.php');          	// Adiciona configurações gerais
	if(empty($_SESSION['changePass'])){
		require_once('../support/sessionControl.php');	// Adiciona configurações de sessão
	}
	require_once('../support/dbConfig.php');      	// Conecta com a base de dados
    require_once('../database/db_user.php');   		// Adiciona funções relacionadas ao utilizador
    require_once('../support/functions.php');       // Adiciona funções gerais
	
	// Carrega informações da nova palavra passe
	$fail = false;
	$oldPass 	 = empty($_POST['palavra_passe_antiga'])   ? $fail=true : $_POST['palavra_passe_antiga'];
	$newPass	 = empty($_POST['palavra_passe_nova'])     ? $fail=true : $_POST['palavra_passe_nova'];
	$newPassConf = empty($_POST['palavra_passe_confirma']) ? $fail=true : $_POST['palavra_passe_confirma'];
	
	$user = $_SESSION['utilizadorLogado'];
	if(!isUser($user, $oldPass)){
		$result = -1;
		$_SESSION['message']['text']  = "Palavra-passe atual incorreta.";
		$_SESSION['message']['class'] = "danger";
		$fail=true;
	}
	
    if(!$fail){
		if($oldPass == $newPass){
			$result = -1;
			$_SESSION['message']['text']  = "Nova palavra-passe deve ser diferente da atual.";
            $_SESSION['message']['class'] = "danger";
			$location = 'Location: ' . $_SERVER['HTTP_REFERER'];
			
		}elseif($user == $newPass){
			$result = -1;
			$_SESSION['message']['text']  = "Nova palavra-passe não pode ser a matrícula do utilizador.";
            $_SESSION['message']['class'] = "danger";
			$location = 'Location: ' . $_SERVER['HTTP_REFERER'];
			
		}elseif($newPass != $newPassConf){
			$result = -1;
			$_SESSION['message']['text']  = "Nova palavra-passe não conrresponde à palavra-passe de confirmação.";
            $_SESSION['message']['class'] = "danger";
			$location = 'Location: ' . $_SERVER['HTTP_REFERER'];
		}else{
			// Atualiza palavra passe no banco de dados
			$result = updatePassword($user, $newPass);
			if(!empty($_SESSION['changePass'])){
				unset($_SESSION['changePass']);
			}
			$location = 'Location: ' . SITE_ROOT;
		}
    }else{
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
	}
	
    setMessage($result);
    
    header($location);

?>