<?php

    function addUnit($params){
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
			$stmt=$dbh->prepare("INSERT INTO unidades ($names) VALUES ($query_values)");
			$stmt->execute($values);
            $unit = $dbh->lastInsertId();
		} catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
		}
		
		return $unit;
    }
    
    function updateUnit($id, $params){
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
			$stmt=$dbh->prepare("UPDATE unidades SET $names WHERE id = $id"); 
			$stmt->execute($values);
			$unidade = $stmt->fetch();
		} catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
		}
		
		return $id;

    }
	
	function deleteUnit($id){
        global $dbh;

		try{
			$stmt=$dbh->prepare('DELETE FROM unidades WHERE id = ?');
			$stmt->execute(array($id));
		} catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
		}
		
		return $id;
	}

    function listUnit(){
        global $dbh;

        try{
            $stmt=$dbh->prepare('SELECT * FROM unidades');
            $stmt->execute();
            $unidades = $stmt->fetchAll();
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }
        
        return $unidades;
	}
	
	function getUnitById($id){
		global $dbh;

		$unit = '';

        try{
            $stmt=$dbh->prepare('SELECT * FROM unidades WHERE id = ?');
            $stmt->execute(array($id));
            $unit = $stmt->fetch();
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }

		return $unit;
	}
	
	function getUnitNameById($id){
		global $dbh;

		$unit = '';

        try{
            $stmt=$dbh->prepare('SELECT nome FROM unidades WHERE id = ?');
            $stmt->execute(array($id));
            $unit = $stmt->fetch()['nome'];
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }

		return $unit;
	}
	
?>