<?php 
    //Arquivos necessarios para a inserção
    require_once "../core/connection.php";

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

    function getID($PDO, $Name)
    {
        $SearchQuery = "SELECT id FROM users WHERE name = :SearchName LIMIT 1";
        $Query = $PDO->prepare($SearchQuery);
        //
        $Query->bindParam(":SearchName", $Name, PDO::PARAM_STR);
        $Query->execute();
        //
        $id = $Query->fetchColumn();
        return $id;
    }

    function GetToken ($postData) {
        return $postData["txtToken1"] . $postData["txtToken2"] . $postData["txtToken3"] . $postData["txtToken4"] . $postData["txtToken5"] . $postData["txtToken6"];
    }

    $token = GetToken($_POST);

    if ($_SESSION["token"] === $token)
    {
        $_SESSION["Salt"] = generateSalt();

        $sql = "INSERT INTO users (name, email, password, salt, profile_pic) VALUES (:nome, :email, :senha, :salt, :pic)";
        $query = $pdo->prepare($sql);

        $query->bindValue(":nome", $_SESSION["Name"]);
        $query->bindValue(":email", $_SESSION['Email']);
        $query->bindValue(":senha", generatePass($_SESSION["Pass"], $_SESSION["Salt"]));
        $query->bindValue(":salt", $_SESSION["Salt"]);
        $query->bindValue(":pic", "../Midia/perfil.png");

        if($query->execute()) 
        {   
            $_SESSION["ID"] = getID($pdo, $_SESSION["Name"]);
            $_SESSION["profile_pic"] = "../Midia/perfil.png";
            header("Location: index.php");
        }
    }
    else
    {

    }
?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    <title>Document</title>
</head>
<body>
    
</body>
</html>