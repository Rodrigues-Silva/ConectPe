<?php 

    $servidor = 'localhost';
    $banco_dados = ' ';
    $usuario = 'root';
    $senha = '';

    try{
        $pdo = new PDO ("mysql:host=$servidor;db=$banco_dados", $usuario, $senha);

        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);

    } catch (PDOException $e) {
        echo "Erro ao conectar ao Banco de dados." . $e->getMessage();
    }

?>