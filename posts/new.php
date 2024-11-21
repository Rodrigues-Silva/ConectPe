<?php 
    require_once "../core/connection.php";
    session_start();

    $file = $_FILES["File"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $txtContent = trim($_POST["content-txt"]);
        if (isset($txtContent) && !empty($txtContent))
        {
            $txtpost = filter_var($txtContent, FILTER_SANITIZE_SPECIAL_CHARS);

            $query = "INSERT INTO posts (user_id, content) VALUES (:id_user, :text);";
            $savePOst = $pdo->prepare($query);
            $savePOst->bindParam(":id_user", $_SESSION["ID"]);
            $savePOst->bindParam(":text", $txtpost, PDO::PARAM_STR);

            $savePOst->execute();

            $id_post = $pdo->lastInsertId();

        }
        if ($file["name"][0] != "")
        {

            foreach ($file["name"] as $index => $value) {
                if ($file['error'][$index])
                {
                    die(`Falha ao salvar arquivo: ` . $file["name"][$index]);
                }

                if ($file["size"][$index] > 2097152)
                {
                    die(`Arquivo muito grande: ` . $file["name"][$index]);
                }

                $formate = ["jpg", "jpeg", "png"];

                $newName = uniqid();
                $oldName = $file['name'][$index];
                $ext = strtolower(pathinfo($oldName, PATHINFO_EXTENSION));

                if (!in_array($ext, $formate))
                {
                    die("Tipo de arquivo não compativel");
                }

                $way = "post-img/" . $newName . "." . $ext;

                $ok = move_uploaded_file($file['tmp_name'][$index], $way);

                if ($ok) 
                {
                    $query = "INSERT INTO midia (post_id, media_url) VALUES (:id_post, :url)";
                    $saveImg = $pdo->prepare($query);
                    $saveImg->bindParam("id_post", $id_post, PDO::PARAM_STR);
                    $saveImg->bindParam(":url", $way, PDO::PARAM_STR);

                    $saveImg->execute();
                }
            }

        }

    }
?>