<?php

    function addEquipment($params){
        global $dbh;

		$names = '';
		$query_values = '';
		$values = array();
		$i = 0;
		foreach ($params as $key => $param) {
			if ($param !== ''){
				$names .= ($i == 0) ? $key : ' ,' . $key;
				$query_values .= ($i == 0) ? '?' : ', ?';
				$query_values2 .= ($i == 0) ? $param : ', '.$param;
				$values[] = $param;
			}
			$i++;
		}
		
		try{
			$stmt=$dbh->prepare("INSERT INTO equipamentos ($names) VALUES ($query_values)");
			$stmt->execute($values);
            $equipamento = $dbh->lastInsertId();
		} catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
		}
		
		return $equipamento;
    }
    
	function updateEquipment($id, $params){
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
			 $stmt=$dbh->prepare("UPDATE equipamentos SET $names WHERE id = $id"); 
			 $stmt->execute($values);
		 } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
		 }
		 
		 return $id;
	}
	
	function deleteEquipment($id){
        global $dbh;

		try{
			$stmt=$dbh->prepare('DELETE FROM equipamentos WHERE id = ?');
			$stmt->execute(array($id));
		} catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
		}
		
		return $id;
	}

    function listEquipment(){
        global $dbh;

        try{
            $stmt=$dbh->prepare('SELECT * FROM equipamentos');
            $stmt->execute();
            $equipamentos = $stmt->fetchAll();
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }
        
        return $equipamentos;
	}
	
    function listAllowedEquipment($userId){
        global $dbh;

        try{
			$query = "SELECT equipamentos.* FROM equipamentos ";
			$query .= " LEFT JOIN acessos_equip ";
			$query .= "   ON equipamentos.id = acessos_equip.id_equipamento ";
			$query .= " JOIN empregados ";
			$query .= "   ON empregados.id = acessos_equip.id_empregado ";
			$query .= "WHERE acessos_equip.id_empregado = $userId";

            $stmt=$dbh->prepare($query);
            $stmt->execute();
            $equipamentos = $stmt->fetchAll();
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }
        
        return $equipamentos;
	}
	
	function getEquipmentById($id){
		global $dbh;

		$equipment = '';

        try{
            $stmt=$dbh->prepare('SELECT * FROM equipamentos WHERE id = ?');
            $stmt->execute(array($id));
            $equipment = $stmt->fetch();
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }

		return $equipment;
	}
	
	function getEquipmentNameById($id){
		global $dbh;

		$equipmentName = '';

        try{
            $stmt=$dbh->prepare('SELECT * FROM equipamentos WHERE id = ?');
            $stmt->execute(array($id));
            $equipmentName = $stmt->fetch()['nome'];
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }
		
		return $equipmentName;
	}
	
?>