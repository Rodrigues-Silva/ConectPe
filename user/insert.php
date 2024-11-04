<?php 
    //Arquivos necessarios para a inserção
    require_once "../core/connection.php";
    require_once "../core/validate.php";

    // Inicializar sessão
    session_start();

    function generateSalt() //Cria um id unico e o retorna como salt
    {
        $salt = uniqid();
        return $salt;
    }

    function generatePass($Pass, $salt) //Recebe um id unico e a senha de usuario e cria um hash com as duas
    {
        return password_hash($Pass . $salt, PASSWORD_DEFAULT);
    }


    $Salt = generateSalt();

    $sql = "INSERT INTO users (name, email, keyword, salt) VALUES (:nome, :email, :senha, :salt)";
    $query = $pdo->prepare($sql);

    $query->bindValue(":nome", $MetaData["Name"]);
    $query->bindValue(":email", $MetaData['Email']);
    $query->bindValue(":senha", generatePass($MetaData["Pass"], $Salt));
    $query->bindValue(":salt", $Salt);

    if ($query->execute()) 
    {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>