<?php
    require_once('../support/init.php');            // Adiciona configurações gerais
	require_once('../support/dbConfig.php');        // Conecta com a base de dados
    require_once('../support/sessionControl.php');  // Adiciona configurações de sessão
    require_once('../database/db_user.php');        // Adiciona funções relacionadas ao utilizador
    require_once('../database/db_unit.php');        // Adiciona funções relacionadas a unidade
    require_once('../database/db_userType.php');    // Adiciona funções relacionadas ao tipo de utilizador
    require_once('../support/functions.php');       // Adiciona funções gerais

    $userId = $_POST['delete'];
    if (isset($_POST['delete'])){
        $resultAccess = deleteUserAccessEquip($userId);
        if($resultAccess > 0){
            $result = deleteUser($userId);
        }else{
            $resultAccess = addUserAccessEquip($userId);
        }
        setMessage($result);
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }

    // Carrega informações da nova unidade
    $params['nome']             = empty($_POST['nome'])             ? $fail=true : $_POST['nome'];
	$params['matricula']        = empty($_POST['utilizador'])       ? $fail=true : $_POST['utilizador'];
    $params['data_nascimento']  = $_POST['data_nascimento'];
    $params['morada']           = $_POST['morada'];
    $params['id_unidade']       = empty($_POST['id_unidade'])       ? $fail=true : $_POST['id_unidade'];
	$params['tipo_utilizador']  = empty($_POST['tipo_utilizador'])  ? $fail=true : $_POST['tipo_utilizador'];
    
    $utilizador = getUserById($_POST['edit']);
    $matriculaAtual = $utilizador['matricula'];
    $palavraPasseAtual = $utilizador['palavra_passe'];

    $changePassword = false;
    if ($palavraPasseAtual == sha1($matriculaAtual)){
        $changePassword = true;
    }

    if(!$fail){
        
        // Atualiza utilizador no banco de dados
        if(!empty($_POST['edit'])){
            if($changePassword)
                $params['palavra_passe'] = sha1($params['matricula']);

            $result = updateUser($_POST['edit'], $params);
            if($result>0){
                $resultAccess = updateUserAccessEquip($result, $params['id_unidade']);
            }
            $location = 'Location: ' . SITE_ROOT . 'user.php';
        }else{
            // Cria palavra passe que será modificada no 1º acesso
            $params['palavra_passe'] = sha1($params['matricula']);

            // Cria utilizador no banco de dados
            $result = addUser($params);
            if($result>0){
                $resultAccess = addUserAccessEquip($result, $params['id_unidade']);
            }
            $location = 'Location: ' . SITE_ROOT;
        }
        
        if(isset($_POST['continue'])){
            $location = 'Location: ' . $_SERVER['HTTP_REFERER'];
        }
    }else{
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
    
    setMessage($result);
    
    $_SESSION['isManager'] 		  = getUserTypeByName($utilizador);
    
    header($location);

?>