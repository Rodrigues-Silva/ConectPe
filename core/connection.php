<?php 
    
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "conectpe";

    try {
        
        $pdo = new PDO("mysql:host=$host;dbname=$db;", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    } catch (PDOException $e) {
        echo "Erro ao conectarao Banco de Dados".$e->getMessage();
    }
?>