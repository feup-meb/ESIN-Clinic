<?php

    function addUser($params){
        global $dbh;

        $names = '';
        $query_values = '';
        $values = array();
        $i = 0;
        foreach ($params as $key => $param) {
            if ($param !== ''){
                $names .= ($i == 0) ? $key : ', ' . $key;
                $query_values .= ($i == 0) ? '?' : ',? ';
                $values[] = $param;
            }
            $i++;
        }

        try{
            $stmt=$dbh->prepare("INSERT INTO empregados ($names) VALUES ($query_values)");
            $stmt->execute($values);
            $userId = $dbh->lastInsertId();
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }

		return $userId;
    }
    
    function addUserAccessEquip($userId, $unitId){
        global $dbh;
    
        try{
            // Verifica equipamentos relacionados à unidade do utilizador
            $stmt=$dbh->prepare('SELECT id FROM equipamentos WHERE id_unidade = ?');
            $stmt->execute(array($unitId));
            $equipments = $stmt->fetchAll();

            // Organiza parâmetros do INSERT em acessos_equip
            $i = 0;
            $accessValues = "";
            foreach ($equipments as $key => $value) {
                $accessValues .= $i == 0 ? "$userId, ".$value['id'] : "), ($userId, ". $value['id'];
                $i++;
            }

            if (count($accessValues) > 0){
                // Adiciona ralação entre utilizador e equipamentos (de acordo com unidade)
                $stmt2 = $dbh->prepare("INSERT INTO acessos_equip (id_empregado, id_equipamento) VALUES ($accessValues)");
                $stmt2->execute();
                $accessId = $dbh->lastInsertId();
            }
            
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }

		return $userId;
    }

    function updateUser($id, $params){
		global $dbh;
 
		 $names = '';
		 $values = array();
		 $i = 0;
		 foreach ($params as $key => $param) {
			 if ($param !== ''){
				 $names .= ($i == 0) ? $key.'=?' : ', ' . $key.'=?';
				 $values[] = $param;
			 }
			 $i++;
		 }
		 
		 try{
			 $stmt=$dbh->prepare("UPDATE empregados SET $names WHERE id = $id"); 
			 $stmt->execute($values);
		 } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
		 }
		 
		 return $id;
	}
    
    function updateUserAccessEquip($userId, $unitId){
        global $dbh;
    
        try{
            // Limpa equipamentos relacionados ao utilizador
            $stmt=$dbh->prepare('DELETE FROM acessos_equip WHERE id_empregado = ?');
            $stmt->execute(array($userId));
            
            // Verifica equipamentos relacionados à unidade do utilizador
            $stmt=$dbh->prepare('SELECT id FROM equipamentos WHERE id_unidade = ?');
            $stmt->execute(array($unitId));
            $equipments = $stmt->fetchAll();

            // Organiza parâmetros do INSERT em acessos_equip
            $i = 0;
            $accessValues = "";
            foreach ($equipments as $key => $value) {
                $accessValues .= $i == 0 ? "$userId, ".$value['id'] : "), ($userId, ". $value['id'];
                $i++;
            }

            if (count($accessValues) > 0){
                // Adiciona ralação entre utilizador e equipamentos (de acordo com unidade)
                $stmt2 = $dbh->prepare("INSERT INTO acessos_equip (id_empregado, id_equipamento) VALUES ($accessValues)");
                $stmt2->execute();
                $accessId = $dbh->lastInsertId();
            }
            
            
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }

		return $userId;
    }
	
	function deleteUser($id){
        global $dbh;

		try{
			$stmt=$dbh->prepare('DELETE FROM empregados WHERE id = ?');
            $stmt->execute(array($id));
		} catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
		}
		
		return $id;
	}
    
    function deleteUserAccessEquip($userId){
        global $dbh;
    
        try{
            // Limpa equipamentos relacionados ao utilizador
            $stmt=$dbh->prepare('DELETE FROM acessos_equip WHERE id_empregado = ?');
            $stmt->execute(array($userId));
            
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }

		return $userId;
    }
    
    function updatePassword($id, $newPass){
		global $dbh;
 
        $newPass = sha1($newPass);

        try{
            $stmt=$dbh->prepare('UPDATE empregados SET palavra_passe = ? WHERE matricula = ?'); 
            $updated = $stmt->execute(array($newPass, $id));
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }
        
        return $updated;
	}

    function listUser(){
        global $dbh;

        try{
            $stmt=$dbh->prepare('SELECT * FROM empregados');
            $stmt->execute();
            $utilizadores = $stmt->fetchAll();
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }
        
        return $utilizadores;
	}
    
    function isUser($utilizador, $palavra_passe){
		global $dbh;
		
		try{
			$stmt=$dbh->prepare('SELECT id FROM empregados WHERE matricula = ? AND palavra_passe = ?');
			$stmt->execute(array($utilizador, sha1($palavra_passe)));
			$user = $stmt->fetch();
		} catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
		}
		
		return $user;
    }

    function checkFirstLogin($utilizador){
		global $dbh;
        
		try{
			$stmt=$dbh->prepare('SELECT id FROM empregados WHERE matricula = ? AND palavra_passe = ?');
			$stmt->execute(array($utilizador, sha1($utilizador)));
			$user = $stmt->fetch()['id'];
		} catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
		}
		
		return $user;
    }

    function getUserIdByRegistry($matricula){
		global $dbh;
		
        try{
            $stmt=$dbh->prepare('SELECT id FROM empregados WHERE matricula = ?');
            $stmt->execute(array($matricula));
            $userId = $stmt->fetch()['id'];
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }
        
        return $userId;
	}

    function getUserNameByRegistry($id){
		global $dbh;
		
        try{
            $stmt=$dbh->prepare('SELECT nome FROM empregados WHERE matricula = ?');
            $stmt->execute(array($id));
            $nomeUtilizador = $stmt->fetch()['nome'];
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }
        
        return $nomeUtilizador;
	}

    function getUserNameById($id){
		global $dbh;
		
        try{
            $stmt=$dbh->prepare('SELECT nome FROM empregados WHERE id = ?');
            $stmt->execute(array($id));
            $nomeUtilizador = $stmt->fetch()['nome'];
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }
        
        return $nomeUtilizador;
	}
	
	function getUserTypeByName($matricula){
		global $dbh;

		$userType = '';

        try{
			$query  = 'SELECT tipo_utilizador FROM empregados JOIN tipo_utilizador ';
			$query .= 'ON empregados.tipo_utilizador = tipo_utilizador.id ';
			$query .= 'WHERE empregados.matricula = ?';
            $stmt=$dbh->prepare($query);
            $stmt->execute(array($matricula));
            $userType = $stmt->fetch()['tipo_utilizador'];
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }
		
        return $userType === 1 ? true : false;
	}
	
	function getUserTypeById($id){
		global $dbh;

		$userType = '';

        try{
			$query  = 'SELECT DISTINCT tipo FROM empregados JOIN tipo_utilizador ';
			$query .= 'ON empregados.tipo_utilizador = tipo_utilizador.id ';
			$query .= 'WHERE empregados.tipo_utilizador = ?';
            $stmt=$dbh->prepare($query);
            $stmt->execute(array($id));
            $userType = $stmt->fetch()['tipo'];
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
		}

        return $userType;
	}
	
	function getUserById($id){
		global $dbh;

		$user = '';

        try{
            $stmt=$dbh->prepare('SELECT * FROM empregados WHERE id = ?');
            $stmt->execute(array($id));
            $user = $stmt->fetch();
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }

		return $user;
	}
	
?>