<?php
    require_once('../support/init.php');                // Adiciona configurações gerais
    require_once('../support/sessionControl.php');      // Adiciona configurações de sessão
	require_once('../support/dbConfig.php');            // Conecta com a base de dados
    require_once('../database/db_manufacturer.php');    // Adiciona funções relacionadas ao fabricante
    require_once('../support/functions.php');           // Adiciona funções gerais

    if (isset($_POST['delete'])){
        $result = deleteManufacturer($_POST['delete']);
        setMessage($result);
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }

	// Carrega informações do novo fabricante
	$params['nome']      = empty($_POST['nome'])      ? $fail=true : $_POST['nome'];
	$params['email']     = empty($_POST['email'])     ? $fail=true : $_POST['email'];
	$params['telefone']  = empty($_POST['telefone'])  ? $fail=true : $_POST['telefone'];
	$params['telemovel'] = empty($_POST['telemovel']) ? $fail=true : $_POST['telemovel'];
	$params['morada']    = empty($_POST['morada'])    ? $fail=true : $_POST['morada'];
    
    if(!$fail){
        
        // Atualiza unidade no banco de dados
        if(!empty($_POST['edit'])){
            $result = updateManufacturer($_POST['edit'], $params);
            $location = 'Location: ' . SITE_ROOT . 'manufacturer.php';
        }else{
            // Cria unidade no banco de dados
            $result = addManufacturer($params);
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