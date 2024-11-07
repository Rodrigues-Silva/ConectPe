<?php 
    // "Criação da sessão e direcionamento para a pagina principal";
    require_once "../core/connection.php";
    
    session_start();
    //
    
    $consulta = "SELECT * FROM users WHERE email = :email";
    $query = $pdo->prepare($consulta);
        //
    $query->bindParam(":email", $_POST["EmailLogin"], PDO::PARAM_STR);
    $query->execute();
        //
    if ($query->rowCount() > 0)
    {
        $user = $query->fetch();

        if (password_verify($_POST["PassLogin"] . $user->salt, $user->password))
        {
            $_SESSION["Name"] = $user->name;
            $_SESSION["ID"] = $user->id;
            if ($user->profile_pic)
            {
                $_SESSION["profile_pic"] = $user->profile_pic;
            }
            header("Location: index.php");
            exit();
        }
        else
        {
            $erro = "Senha digitada incorretamente, caso tenha esquecido sua senha utilize nosso sistema de recuperação de senha, mas se apesnas errou algum digitou clique em voltar para a página anterior e será direcionado para o formulario de login";
        }
    }
    else
    {
        $erro = "Nenhuma conta vinculada a este E-mail";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERRO - Log in</title>

    <link rel="stylesheet" href="../css/erroLogin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
        <div class="container">
            <div class="center">
                <div class="logo">
                    <div class="log">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-handshake h-8 w-8 text-blue-500" data-id="5"><path d="m11 17 2 2a1 1 0 1 0 3-3"></path><path d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4"></path><path d="m21 3 1 11h-2"></path><path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3"></path><path d="M3 4h8"></path></svg>
                        <h1>Connect<span class="Pe">Pe</span></h1>
                    </div>
                </div>
                <div class="erro">
                    <?php echo $erro; ?>
                </div>
                <div class="nav">
                    <a href="javascript:history.back();" id="left">
                        <i class="fa-solid fa-arrow-left"></i>
                        Voltar para a página anterior
                    </a>
                    <a href="#" id="right">
                        Esqueceu a senha?
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
</body>
</html>