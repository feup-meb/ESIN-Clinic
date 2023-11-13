<?php
    require_once('../support/init.php');            // Adiciona configurações gerais
    require_once('../support/sessionControl.php');  // Adiciona configurações de sessão
	require_once('../support/dbConfig.php');        // Conecta com a base de dados
    require_once('../database/db_unit.php');        // Adiciona funções relacionadas a unidade
    require_once('../support/functions.php');       // Adiciona funções gerais

    if (isset($_POST['delete'])){
        $result = deleteUnit($_POST['delete']);
        setMessage($result);
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }

	// Carrega informações da nova unidade
	$params['nome'] = empty($_POST['nome']) ? $fail=true : $_POST['nome'];
	$params['sala'] = empty($_POST['sala']) ? $fail=true : $_POST['sala'];

    if(!$fail){
        
        // Atualiza unidade no banco de dados
        if(!empty($_POST['edit'])){
            $result = updateUnit($_POST['edit'], $params);
            $location = 'Location: ' . SITE_ROOT . 'unit.php';
        }else{
            // Cria unidade no banco de dados
            $result = addUnit($params);
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