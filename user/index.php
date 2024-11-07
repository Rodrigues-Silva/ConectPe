<?php 
    require_once "../core/connection.php";
    session_start();

    if (!isset($_SESSION["ID"]) && empty($_SESSION["ID"]))
    {
        header("Location: formLogin.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConectPe</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/main.css">

</head>
<body>
    
    <header class="top-bar">
        <div class="logo">
            <img src="../Midia/Logo.png" alt="logo">
            <span><span class="conect">Conect</span>Pe</span>
        </div>
        <form class="search">
            <input type="text" placeholder="Pesquisar..." name="search-input" id="search-input">
            <button>
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
        <div class="tools">
            <i class="fa-solid fa-envelope"></i>
            <i class="fa-solid fa-bell"></i>
            <div class="menu">
                <i class="fa-solid fa-bars"></i>
                <div class="menu-content">
                    <a href="#">
                        <i class="fa-solid fa-user"></i>
                        perfil
                    </a>
                    <a href="#">
                        <i class="fa-solid fa-gear"></i>    
                        configurações
                    </a>
                    <a href="#">
                        <i class="fa-solid fa-users"></i>
                        gerenciar contas
                    </a>
                    <a href="#">
                        <i class="fa-solid fa-circle-question"></i>
                        suporte
                    </a>
                    <a href="logout.php">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        sair da conta
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <aside class="sidebar-left">
            <a href="#">
                <img alt="User Image" height="40"
                    src="https://storage.googleapis.com/a1aa/image/viFtVqbgIa5BFdHfpdfkXVXFzPfoJGVxuqaL739G5I4TnXQnA.jpg"
                    style="border-radius: 50%; margin-right: 10px;" width="40" />
                <?php echo $_SESSION["Name"]?>
            </a>
            <a href="#">
                <i class="fas fa-user-friends">
                </i>
                Amigos
            </a>
            <a href="#">
                <i class="fas fa-users">
                </i>
                Grupos
            </a>
            <a href="#">
                <i class="fas fa-bookmark">
                </i>
                Salvos
            </a>
            <a href="#">
                <i class="fas fa-bullhorn">
                </i>
                Anúncio
            </a>
            <div class="ad-space">
                <p>
                    Espaço para Anúncios
                </p>
            </div>
        </aside>
        
        <main class="main-content" id="main">
            <form action="" method="post" enctype="multipart/form-data" class="ADDPost">
                <div class="post-header">
                    <img alt="Profile Picture" height="40" src="https://storage.googleapis.com/a1aa/image/bRrQ9zygscLmOR0DWJc40gRkNjAeLVSnAifQhyC3W9eAHXQnA.jpg" width="40" />
                    <div class="post-info">
                        <span>
                            <?php echo $_SESSION["Name"]?>
                        </span>
                        <div class="menu">
                            <i class="fas fa-ellipsis-h"></i>
                            <div class="menu-content">
                                <a href="#">
                                    Acessar Perfil do Usuário
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="post-content">
                    <input type="text" name="content-txt" id="content-txt" required placeholder="O que você está pensando agora?">
                    <div id="zone-img" class="zone-img">
                    </div>
                </div>
                <div class="post-actions">
                    <label class="entryFile" for="input-File">
                        <i class="fas fa-image"></i>
                        Adicionar Fotos
                        <input style="display: none;" type="file" multiple name="File[]" id="input-File">
                    </label>
                    <div class="hashtag" onclick = "toggleMenu()">
                        <i class="fas fa-hashtag"></i>
                        Hashtag
                        <div style="display: none;" class="hashtag-content" id="hashtag-content">
                            <p>#numero1</p>
                            <p>#numero2</p>
                        </div>
                    </div>
                    <button type="submit">
                        <i class="fas fa-paper-plane"></i>
                        publicar
                    </button>
                </div>
            </form>
            <div class="content">
                
            </div>
        </main>
        
        <aside class="sidebar-right">
                <div class="recommended">
                    <h3>
                        Recomendados
                    </h3>
                    <a href="#">
                        <i class="fas fa-star">
                        </i>
                        Item Recomendado 1
                    </a>
                    <a href="#">
                        <i class="fas fa-star">
                        </i>
                        Item Recomendado 2
                    </a>
                </div>
                <div class="hashtags">
                    <h3>
                        Hashtags Populares
                    </h3>
                    <a href="#">
                        <i class="fas fa-hashtag">
                        </i>
                        #Hashtag1
                    </a>
                    <a href="#">
                        <i class="fas fa-hashtag">
                        </i>
                        #Hashtag2
                    </a>
                </div>
                <div class="terms">
                    <h3>
                        Termos de Uso
                    </h3>
                    <a href="#">
                        Leia nossos termos de uso
                    </a>
                </div>
        <button class="fixed-button" onclick="scrollToTop()">
            <i class="fas fa-arrow-up">
            </i>
        </button>
        </aside>
    </div>

    <script src="../responsive/post-img.js"></script>
    <script>

        function scrollToTop() {
            const main = document.getElementById("main");
            main.scrollTo({top: 0, behavior: "smooth"});
        }

        function toggleMenu() {
            const menu = document.getElementById("hashtag-content");

            if (menu.style.display == "none" || menu.style.display == "") {
                menu.style.display = "block";
            } else {
                menu.style.display = "none";
            }
        }
    </script>
</body>
</html>