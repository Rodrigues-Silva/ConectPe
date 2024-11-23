<?php 
    require_once "../core/connection.php";
    session_start();
    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $ThatsOk = false;
        $erro = [];
        
        $name = filter_var($_POST["perfilName"], FILTER_SANITIZE_SPECIAL_CHARS);
        
        $Bio = filter_var($_POST["perfilBio"], FILTER_SANITIZE_SPECIAL_CHARS);
        
        $Link = filter_var($_POST["perfilLink"], FILTER_SANITIZE_SPECIAL_CHARS);
        
        if ($_FILES["perfilPic"]["name"] != "")
        {
            $image = $_FILES["perfilPic"];

            if ($image["type"] != 'image/png' && $image["type"] != 'image/jpg' && $image["type"] != 'image/jpeg')
            {
                $erro[] = "Tipo de imagem para perfil incopativel";
            }
            else
            {
                if ($image["size"] > 2097152)
                {
                    $erro[] = "Tamanho do arquivo muito grande";
                }
                else
                {
                    $local = "../Midia/";
                    $newNameFile = uniqid();
                    $ext = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));

                    $way = $local . $newNameFile . "." . $ext;
                    $ThatsOk = move_uploaded_file($image["tmp_name"], $way);

                    if ($ThatsOk)
                    {
                         
                        $query = "UPDATE users SET name = :name, bios = :bio, link_profile = :link, profile_pic = :image WHERE id = :id";
                        $update = $pdo->prepare($query);

                        $update->bindParam(":name", $name, PDO::PARAM_STR);
                        $update->bindParam(":bio", $Bio, PDO::PARAM_STR);
                        $update->bindParam(":link", $Link, PDO::PARAM_STR);
                        $update->bindParam(":image", $way, PDO::PARAM_STR);
                        $update->bindParam(":id", $_SESSION["ID"], PDO::PARAM_STR);

                    }
                    else 
                    {
                        die("Erro ao criar caminho de imagem de perfil");
                    }
                }
            }
        }
        else
        {
            if ($_SESSION["profile_pic"] != "../Midia/perfil.png") {

                $query = "UPDATE users SET name = :name, bios = :bio, link_profile = :link, profile_pic = :image WHERE id = :id";
                $update = $pdo->prepare($query);

                $update->bindParam(":name", $name, PDO::PARAM_STR);
                $update->bindParam(":bio", $Bio, PDO::PARAM_STR);
                $update->bindParam(":link", $Link, PDO::PARAM_STR);
                $update->bindValue(":image", $_SESSION["profile_pic"], PDO::PARAM_STR);   
                $update->bindParam(":id", $_SESSION["ID"], PDO::PARAM_STR);

            } else {

                $query = "UPDATE users SET name = :name, bios = :bio, link_profile = :link, profile_pic = :image WHERE id = :id";
                $update = $pdo->prepare($query);

                $update->bindParam(":name", $name, PDO::PARAM_STR);
                $update->bindParam(":bio", $Bio, PDO::PARAM_STR);
                $update->bindParam(":link", $Link, PDO::PARAM_STR);
                $update->bindValue(":image", "../Midia/perfil.png");
                $update->bindParam(":id", $_SESSION["ID"], PDO::PARAM_STR);

            }
            

        }

        if ($update->execute())
        {
            $_SESSION["Name"] = $name;
            $_SESSION["Bio"] = $Bio;
            $_SESSION["Link"] = $Link;

            if ($ThatsOk)
            {
                $_SESSION["profile_pic"] = $way;
            }

            header("Location: ../index.php");
            exit();
        }
        else
        {
            echo "Deu Errado";
        }
    }
?>