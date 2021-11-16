<?php

    function addUserType($tipoUtilizador){
        global $dbh;

        try{
            $stmt=$dbh->prepare('INSERT INTO tipo_utilizador (tipo) VALUES (?)');
            $stmt->execute(array($tipoUtilizador));
            $tipoUtilizador = $dbh->lastInsertId();
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }
        
        return $tipoUtilizador;
    }
    
    function updateUserType($id, $tipo){
        global $dbh;
		
		try{
			$stmt=$dbh->prepare("UPDATE tipo_utilizador SET tipo = ? WHERE id = ?"); 
			$stmt->execute(array($tipo, $id));
		} catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
		}
		
		return $id;
    }
	
	function deleteUserType($id){
        global $dbh;

		try{
			$stmt=$dbh->prepare('DELETE FROM tipo_utilizador WHERE id = ?');
			$stmt->execute(array($id));
		} catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
		}
		
		return $id;
	}

    function listUserType(){
        global $dbh;

        try{
            $stmt=$dbh->prepare('SELECT * FROM tipo_utilizador');
            $stmt->execute();
            $tiposUtilizador = $stmt->fetchAll();
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }
        
        return $tiposUtilizador;
    }

    function getTypeById($id){
        global $dbh;
        
        try{
            $stmt=$dbh->prepare('SELECT tipo FROM tipo_utilizador WHERE id = ?');
            $stmt->execute(array($id));
            $tipoUtilizador = $stmt->fetch()['tipo'];
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }
        
        return $tipoUtilizador;
    }

?>