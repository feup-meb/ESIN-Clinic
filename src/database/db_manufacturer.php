<?php

    function addManufacturer($params){
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
			$stmt=$dbh->prepare("INSERT INTO fabricantes ($names) VALUES ($query_values)");
			$stmt->execute($values);
            $fabricante = $dbh->lastInsertId();
		} catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
		}
		
        return $fabricante;
    }
    
    function updateManufacturer($id, $params){
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
			$stmt=$dbh->prepare("UPDATE fabricantes SET $names WHERE id = $id"); 
			$stmt->execute($values);
			$fabricante = $stmt->fetch();
		} catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
		}
		
		return $id;
	}
	
	function deleteManufacturer($id){
        global $dbh;

		try{
			$stmt=$dbh->prepare('DELETE FROM fabricantes WHERE id = ?');
			$stmt->execute(array($id));
		} catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
		}
		
		return $id;
	}

    function listManufacturer(){
        global $dbh;

        try{
            $stmt=$dbh->prepare('SELECT * FROM fabricantes');
            $stmt->execute();
            $fabricantes = $stmt->fetchAll();
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }
        
        return $fabricantes;
	}
	
	function getManufacturerById($id){
		global $dbh;

		$manufacturer = '';

        try{
            $stmt=$dbh->prepare('SELECT * FROM fabricantes WHERE id = ?');
            $stmt->execute(array($id));
            $manufacturer = $stmt->fetch();
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }

		return $manufacturer;
	}
	
	function getManufacturerNameById($id){
		global $dbh;

		$manufacturer = '';

        try{
            $stmt=$dbh->prepare('SELECT nome FROM fabricantes WHERE id = ?');
            $stmt->execute(array($id));
            $manufacturer = $stmt->fetch()['nome'];
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }

		return $manufacturer;
	}
	
?>