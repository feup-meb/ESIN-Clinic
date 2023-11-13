<?php

    function addCategory($params){
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
			$stmt=$dbh->prepare("INSERT INTO cat_equipamentos ($names) VALUES ($query_values)");
			$stmt->execute($values);
            $category = $dbh->lastInsertId();
		} catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
		}
		
        return $category;
    }
    
    function updateCategory($id, $params){
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
             $stmt=$dbh->prepare("UPDATE cat_equipamentos SET $names WHERE id = $id"); 
             $stmt->execute($values);
         } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
         }
         
         return $id;
    }
    
    function deleteCategory($id){
        global $dbh;

		try{
			$stmt=$dbh->prepare('DELETE FROM cat_equipamentos WHERE id = ?');
			$stmt->execute(array($id));
		} catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
		}
		
		return $id;
	}

    function listCategory(){
        global $dbh;

        try{
            $stmt=$dbh->prepare('SELECT * FROM cat_equipamentos');
            $stmt->execute();
            $categorias = $stmt->fetchAll();
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }
        
        return $categorias;
    }
	
	function getCategoryById($id){
		global $dbh;

		$category = '';

        try{
            $stmt=$dbh->prepare('SELECT * FROM cat_equipamentos WHERE id = ?');
            $stmt->execute(array($id));
            $category = $stmt->fetch();
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }

		return $category;
	}
	
	function getCategoryNameById($id){
		global $dbh;

		$categoryName = '';

        try{
            $stmt=$dbh->prepare('SELECT nome FROM cat_equipamentos WHERE id = ?');
            $stmt->execute(array($id));
            $categoryName = $stmt->fetch()['nome'];
        } catch(PDOException $e) {
            $category = -1;
            $_SESSION['message']['text'] = "Falha na consulta: " . $e->getMessage();
            $_SESSION['message']['class'] = "danger";
        }

		return $categoryName;
	}

?>