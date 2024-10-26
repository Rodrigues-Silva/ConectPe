<?php 
require 'conxeão.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conteudo = $_POST['conteudo'];
    $imagem = $_FILES['imagem'];

    if ($imagem && $iamgem['tmp_name']) {
        $imgPath = 'uploads/'. basename ($imagem['name']);
        move_uploaded_file($imagem['tmp_name'], $imgPath);
    }

    $sql = "INSERT INTO posts(conteudo, imagem) VALUES (?, ?)";
    $stmt = $pdo ->prepare($sql);
    $stmt->execute([$conteudo, $imgPath]);

    header("Location: index.php");
    exit;

}
?>