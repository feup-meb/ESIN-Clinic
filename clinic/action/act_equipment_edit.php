<?php
    require_once('../support/init.php');            // Adiciona configurações gerais
    require_once('../support/sessionControl.php');  // Adiciona configurações de sessão
	require_once('../support/dbConfig.php');        // Conecta com a base de dados
    require_once('../database/db_equipment.php');   // Adiciona funções relacionadas ao fabricante
    require_once('../support/functions.php');       // Adiciona funções gerais

    // Remove equipamento do banco de dados
    if (isset($_POST['delete'])){
        $result = deleteEquipment($_POST['delete']);
        setMessage($result);
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }

    // Carrega informações do novo equipamento
    $params['nome']           = empty($_POST['nome'])           ? $fail=true : $_POST['nome'];
	$params['modelo']         = empty($_POST['modelo'])         ? $fail=true : $_POST['modelo'];
    $params['nr_serie']       = empty($_POST['nr_serie'])       ? $fail=true : $_POST['nr_serie'];
    $params['descricao']      = $_POST['descricao'];
    $params['id_fabricante']  = empty($_POST['id_fabricante'])  ? $fail=true : $_POST['id_fabricante'];
    $params['id_categoria']   = empty($_POST['id_categoria'])   ? $fail=true : $_POST['id_categoria'];
    $params['data_aquisicao'] = empty($_POST['data_aquisicao']) ? $fail=true : $_POST['data_aquisicao'];
    $params['data_garantia']  = empty($_POST['data_garantia'])  ? $fail=true : $_POST['data_garantia'];
    $params['valor_compra']   = $_POST['valor_compra'];
    $params['ativo']          = empty($_POST['ativo']) ? 'f' : 't';
    $params['id_unidade']     = empty($_POST['id_unidade'])     ? $fail=true : $_POST['id_unidade'];
	// $params['ficheiro']       = $_POST['ficheiro'];
    
    if(!$fail){
        
        // Atualiza equipamento no banco de dados
        if(!empty($_POST['edit'])){
            $result = updateEquipment($_POST['edit'], $params);
            $location = 'Location: ' . SITE_ROOT . 'equipment.php';
        }else{
            // Cria equipamento no banco de dados
            $result = addEquipment($params);
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