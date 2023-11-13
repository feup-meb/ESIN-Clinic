<?php

    function addIntervention($params){
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
			$stmt=$dbh->prepare("INSERT INTO intervencoes ($names) VALUES ($query_values)");
			$stmt->execute($values);
            $intervencao = $dbh->lastInsertId();
		} catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
		}
		
		return $intervencao;
    }
    
    function updateIntervention($id, $params){
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
			$stmt=$dbh->prepare("UPDATE intervencoes SET $names WHERE id = $id"); 
			$stmt->execute($values);
		} catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
		}
		
		return $id;
    }
	
	function deleteIntervention($id){
        global $dbh;

		try{
			$stmt=$dbh->prepare('DELETE FROM intervencoes WHERE id = ?');
			$stmt->execute(array($id));
		} catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
		}
		
		return $id;
	}

    function listIntervention(){
        global $dbh;

        try{
            $stmt=$dbh->prepare('SELECT * FROM intervencoes');
            $stmt->execute();
            $intervencoes = $stmt->fetchAll();
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }
        
        return $intervencoes;
	}

	function getInterventionById($id){
		global $dbh;

		$intervention = '';

        try{
            $stmt=$dbh->prepare('SELECT * FROM intervencoes WHERE id = ?');
            $stmt->execute(array($id));
            $intervention = $stmt->fetch();
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }
		
		return $intervention;
	}
	
?>