<?php 
    require_once "../core/connection.php";

    $query = "DELETE FROM posts WHERE id = :id";
    $delete = $pdo->prepare($query);

    $delete->bindParam(":id", $_GET["fuy"], PDO::PARAM_STR);

    if ($delete->execute())
    {
        header("Location: ../");
        exit();
    }
?>