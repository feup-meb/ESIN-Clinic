<?php
    require_once('../support/init.php');            // Adiciona configurações gerais
    require_once('../support/sessionControl.php');  // Adiciona configurações de sessão
	require_once('../support/dbConfig.php');        // Conecta com a base de dados
    require_once('../database/db_userType.php');    // Adiciona funções relacionadas ao tipo de utilizador
    require_once('../support/functions.php');       // Adiciona funções gerais

    if (isset($_POST['delete'])){
        $result = deleteUserType($_POST['delete']);
        setMessage($result);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    // Carrega informações do novo tipo de utilizador
    $tipoUtilizador = empty($_POST['tipoUtilizador']) ? $fail=true : $_POST['tipoUtilizador'];
    
    if(!$fail){
        
        // Atualiza tipo de utilizador no banco de dados
        if(!empty($_POST['edit'])){
            $result = updateUserType($_POST['edit'], $tipoUtilizador);
            $location = 'Location: ' . SITE_ROOT . 'userType.php';
        }else{
            // Cria tipo de utilizador no banco de dados
            $result = addUserType($tipoUtilizador);
            $location = 'Location: ' . SITE_ROOT;
        }

        if(isset($_POST['continue'])){
            $location = 'Location: ' . $_SERVER['HTTP_REFERER'];
        }
    }else{
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
    
    setMessage($result);

    header($location);
    
?>