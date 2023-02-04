<?php
    try{
        // Connect do database
        $dbh = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', 'postgres', 'postgres');
        // $dbh = new PDO('pgsql:host=dbm.fe.up.pt;port=5432;dbname=esin1818', 'esin1818', 'esin2018');
        $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        die( 'Falha na conexão à Base de Dados: ' . $e->getMessage());
    }
?>