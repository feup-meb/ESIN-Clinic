<?php
    require_once('../support/init.php');               // Adiciona configurações gerais
    require_once('../support/sessionControl.php');     // Adiciona configurações de sessão
	require_once('../support/dbConfig.php');           // Conecta com a base de dados
    require_once('../database/db_intervention.php');   // Adiciona funções relacionadas ao equipamento
    require_once('../database/db_user.php');           // Adiciona funções relacionadas ao utilizador
    require_once('../database/db_equipment.php');      // Adiciona funções relacionadas ao equipamento
    require_once('../support/functions.php');          // Adiciona funções gerais

    if (isset($_POST['delete'])){
        $result = deleteIntervention($_POST['delete']);
        setMessage($result);
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
    
    // Carrega informações do novo utilizador
    $params['data_detetado']    = empty($_POST['data_detetado'])  ? $fail=true : $_POST['data_detetado'];
	$params['observacoes']      = $_POST['observacoes'];
    $params['data_avaliacao']   = $_POST['data_avaliacao'];
    $params['orcamento']        = $_POST['orcamento'];
    $params['tipo']             = empty($_POST['tipo'])           ? $fail=true : $_POST['tipo'];
	$params['data_inicio']      = $_POST['data_inicio'];
	$params['data_fim']         = $_POST['data_fim'];
    $params['id_empregado']     = empty($_POST['id_utilizador'])  ? $fail=true : $_POST['id_utilizador'];
    $params['id_equipamento']   = empty($_POST['id_equipamento']) ? $fail=true : $_POST['id_equipamento'];
    
    if(!$fail){
        
        if(!empty($_POST['edit'])){
            // Modifica Intervenção no banco de dados
            $result = updateIntervention($_POST['edit'], $params);
            $location = 'Location: ' . SITE_ROOT . 'intervention.php';
        }else{
            // Cria Intervenção no banco de dados
            $result = addIntervention($params);
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