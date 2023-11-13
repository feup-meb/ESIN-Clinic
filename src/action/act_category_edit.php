<?php
    require_once('../support/init.php');            // Adiciona configurações gerais
    require_once('../support/sessionControl.php');  // Adiciona configurações de sessão
	require_once('../support/dbConfig.php');        // Conecta com a base de dados
    require_once('../database/db_category.php');    // Adiciona funções relacionadas a categoria do equipamento
    require_once('../support/functions.php');       // Adiciona funções gerais
        
    // Remove categoria do banco de dados
    if (isset($_POST['delete'])){
        $result = deleteCategory($_POST['delete']);
        setMessage($result);
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }

	// Carrega informações da nova categoria
	$params['nome']       = empty($_POST['nome'])      ? $fail=true : $_POST['nome'];
	$params['descricao']  = empty($_POST['descricao']) ? $fail=true : $_POST['descricao'];
    if(!$fail){
        
        // Atualiza categoria no banco de dados
        if(!empty($_POST['edit'])){
            $result = updateCategory($_POST['edit'], $params);
            $location = 'Location: ' . SITE_ROOT . 'category.php';
        }else{
            // Cria categoria no banco de dados
            $result = addCategory($params);
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