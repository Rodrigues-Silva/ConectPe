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
    <link rel="stylesheet" href="../css/perfil.css">

</head>
<body>
    
    <header class="top-bar">
        <a class="returnMain" href="index.php">
            <div class="logo">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-handshake h-8 w-8 text-blue-500" data-id="5"><path d="m11 17 2 2a1 1 0 1 0 3-3"></path><path d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4"></path><path d="m21 3 1 11h-2"></path><path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3"></path><path d="M3 4h8"></path></svg>
                <span><span class="conect">Conect</span>Pe</span>
            </div>
        </a>
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
                    <a href="config.html">
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
            <a class="pointer">
                <img alt="User Image" height="40"
                    src="../Midia/perfil.svg"
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
                <div class="perfil">
                    <img src="../Midia/perfil.svg" alt="Foto de perfil" height="250" width="250">
                    <div class="info">
                        <h2><?php echo $_SESSION["Name"]?></h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi voluptate, totam, recusandae laboriosam libero vitae ipsam voluptatibus fuga, porro fugit velit ipsum architecto magnam veniam labore quae earum tempora voluptatem?</p>
                        <a href="#"><i class="fa-solid fa-link"></i> link:https://exemplo.com</a>
                        <a href="formAtualização.php" class="editButton">Editar Perfil</a>
                    </div>
                </div>
                <nav>
                    <div class="campNav">Posts</div>
                    <div class="campNav">Republicados</div>
                </nav>
                <div class="posts">
                    <div class="post-box post">
                        <div class="post-header">
                            <img alt="Profile Picture" height="40" onclick="expandImage(this)"
                                src="../Midia/perfil.svg"
                                width="40" />
                            <div class="post-info-perfil">
                                <div class="info">
                                    <span class="name">
                                        Nome de Usuário
                                    </span>
                                    <span class="creat_at">
                                        data e hora
                                    </span>
                                </div>
                                <div class="menu">
                                    <i class="fas fa-ellipsis-h" onclick="toggleMenu(this)">
                                    </i>
                                    <div class="menu-content">
                                        <a href="#">
                                            Excluir post
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-content-publi">
                            Conteúdo do post...
                        </div>
                        <div class="post-actions-perfil">
                            <button class="like-button" onclick="toggleLike(this)">
                                <i class="fas fa-heart">
                                </i>
                                Like
                            </button>
                            <button>
                                <i class="fas fa-retweet">
                                </i>
                                Retweet
                            </button>
                            <button class="button-comment">
                                <i class="fas fa-comment">
                                </i>
                                Comentários
                            </button>
                            <button>
                                <i class="fas fa-share">
                                </i>
                                Compartilhar
                            </button>
                        </div>
                        <div class="post-comments" style="display: none">
                            <div class="comments" >
                                <div class="post-comment" >
                                    <img class="img-input" alt="Profile Picture"
                                        src="../Midia/perfil.svg"
                                        width="40" />
                                    <input class="MyComment" placeholder="Responder a Nome"
                                        style="width: 95%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; transition: background-color 0.3s, box-shadow 0.3s, transform 0.3s;"
                                        type="text" onblur="this.style.transform='scale(1)'" />
                                </div>
                                <div class="post-actions">
                                    <button onclick="addPhoto()">
                                        <i class="fas fa-image">
                                        </i>
                                        Adicionar Fotos
                                    </button>
                                    <button>
                                        <i class="fas fa-hashtag">
                                        </i>
                                        Hashtags
                                    </button>
                                    <button class="publi_comment">
                                        <i class="fas fa-paper-plane">
                                        </i>
                                        Comentar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="post-box post">
                        <div class="post-header">
                            <img alt="Profile Picture" height="40" onclick="expandImage(this)"
                                src="../Midia/perfil.svg"
                                width="40" />
                            <div class="post-info-perfil">
                                <div class="info">
                                    <span class="name">
                                        Nome de Usuário
                                    </span>
                                    <span class="creat_at">
                                        data e hora
                                    </span>
                                </div>
                                <div class="menu">
                                    <i class="fas fa-ellipsis-h" onclick="toggleMenu(this)">
                                    </i>
                                    <div class="menu-content">
                                        <a href="#">
                                            Excluir post
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-content-publi">
                            Conteúdo do post...
                        </div>
                        <div class="post-actions-perfil">
                            <button class="like-button" onclick="toggleLike(this)">
                                <i class="fas fa-heart">
                                </i>
                                Like
                            </button>
                            <button>
                                <i class="fas fa-retweet">
                                </i>
                                Retweet
                            </button>
                            <button class="button-comment">
                                <i class="fas fa-comment">
                                </i>
                                Comentários
                            </button>
                            <button>
                                <i class="fas fa-share">
                                </i>
                                Compartilhar
                            </button>
                        </div>
                        <div class="post-comments" style="display: none">
                            <div class="comments" >
                                <div class="post-comment" >
                                    <img class="img-input" alt="Profile Picture"
                                        src="../Midia/perfil.svg"
                                        width="40" />
                                    <input class="MyComment" placeholder="Responder a Nome"
                                        style="width: 95%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; transition: background-color 0.3s, box-shadow 0.3s, transform 0.3s;"
                                        type="text" onblur="this.style.transform='scale(1)'" />
                                </div>
                                <div class="post-actions">
                                    <button onclick="addPhoto()">
                                        <i class="fas fa-image">
                                        </i>
                                        Adicionar Fotos
                                    </button>
                                    <button>
                                        <i class="fas fa-hashtag">
                                        </i>
                                        Hashtags
                                    </button>
                                    <button class="publi_comment">
                                        <i class="fas fa-paper-plane">
                                        </i>
                                        Comentar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="post-box post">
                        <div class="post-header">
                            <img alt="Profile Picture" height="40" onclick="expandImage(this)"
                                src="../Midia/perfil.svg"
                                width="40" />
                            <div class="post-info-perfil">
                                <div class="info">
                                    <span class="name">
                                        Nome de Usuário
                                    </span>
                                    <span class="creat_at">
                                        data e hora
                                    </span>
                                </div>
                                <div class="menu">
                                    <i class="fas fa-ellipsis-h" onclick="toggleMenu(this)">
                                    </i>
                                    <div class="menu-content">
                                        <a href="#">
                                            Excluir post
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-content-publi">
                            Conteúdo do post...
                        </div>
                        <div class="post-actions-perfil">
                            <button class="like-button" onclick="toggleLike(this)">
                                <i class="fas fa-heart">
                                </i>
                                Like
                            </button>
                            <button>
                                <i class="fas fa-retweet">
                                </i>
                                Retweet
                            </button>
                            <button class="button-comment">
                                <i class="fas fa-comment">
                                </i>
                                Comentários
                            </button>
                            <button>
                                <i class="fas fa-share">
                                </i>
                                Compartilhar
                            </button>
                        </div>
                        <div class="post-comments" style="display: none">
                            <div class="comments" >
                                <div class="post-comment" >
                                    <img class="img-input" alt="Profile Picture"
                                        src="../Midia/perfil.svg"
                                        width="40" />
                                    <input class="MyComment" placeholder="Responder a Nome"
                                        style="width: 95%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; transition: background-color 0.3s, box-shadow 0.3s, transform 0.3s;"
                                        type="text" onblur="this.style.transform='scale(1)'" />
                                </div>
                                <div class="post-actions">
                                    <button onclick="addPhoto()">
                                        <i class="fas fa-image">
                                        </i>
                                        Adicionar Fotos
                                    </button>
                                    <button>
                                        <i class="fas fa-hashtag">
                                        </i>
                                        Hashtags
                                    </button>
                                    <button class="publi_comment">
                                        <i class="fas fa-paper-plane">
                                        </i>
                                        Comentar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="post-box post">
                        <div class="post-header">
                            <img alt="Profile Picture" height="40" onclick="expandImage(this)"
                                src="../Midia/perfil.svg"
                                width="40" />
                            <div class="post-info-perfil">
                                <div class="info">
                                    <span class="name">
                                        Nome de Usuário
                                    </span>
                                    <span class="creat_at">
                                        data e hora
                                    </span>
                                </div>
                                <div class="menu">
                                    <i class="fas fa-ellipsis-h" onclick="toggleMenu(this)">
                                    </i>
                                    <div class="menu-content">
                                        <a href="#">
                                            Excluir post
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-content-publi">
                            Conteúdo do post...
                        </div>
                        <div class="post-actions-perfil">
                            <button class="like-button" onclick="toggleLike(this)">
                                <i class="fas fa-heart">
                                </i>
                                Like
                            </button>
                            <button>
                                <i class="fas fa-retweet">
                                </i>
                                Retweet
                            </button>
                            <button class="button-comment">
                                <i class="fas fa-comment">
                                </i>
                                Comentários
                            </button>
                            <button>
                                <i class="fas fa-share">
                                </i>
                                Compartilhar
                            </button>
                        </div>
                        <div class="post-comments" style="display: none">
                            <div class="comments" >
                                <div class="post-comment" >
                                    <img class="img-input" alt="Profile Picture"
                                        src="../Midia/perfil.svg"
                                        width="40" />
                                    <input class="MyComment" placeholder="Responder a Nome"
                                        style="width: 95%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; transition: background-color 0.3s, box-shadow 0.3s, transform 0.3s;"
                                        type="text" onblur="this.style.transform='scale(1)'" />
                                </div>
                                <div class="post-actions">
                                    <button onclick="addPhoto()">
                                        <i class="fas fa-image">
                                        </i>
                                        Adicionar Fotos
                                    </button>
                                    <button>
                                        <i class="fas fa-hashtag">
                                        </i>
                                        Hashtags
                                    </button>
                                    <button class="publi_comment">
                                        <i class="fas fa-paper-plane">
                                        </i>
                                        Comentar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="post-box post">
                        <div class="post-header">
                            <img alt="Profile Picture" height="40" onclick="expandImage(this)"
                                src="../Midia/perfil.svg"
                                width="40" />
                            <div class="post-info-perfil">
                                <div class="info">
                                    <span class="name">
                                        Nome de Usuário
                                    </span>
                                    <span class="creat_at">
                                        data e hora
                                    </span>
                                </div>
                                <div class="menu">
                                    <i class="fas fa-ellipsis-h" onclick="toggleMenu(this)">
                                    </i>
                                    <div class="menu-content">
                                        <a href="#">
                                            Excluir post
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-content-publi">
                            Conteúdo do post...
                        </div>
                        <div class="post-actions-perfil">
                            <button class="like-button" onclick="toggleLike(this)">
                                <i class="fas fa-heart">
                                </i>
                                Like
                            </button>
                            <button>
                                <i class="fas fa-retweet">
                                </i>
                                Retweet
                            </button>
                            <button class="button-comment">
                                <i class="fas fa-comment">
                                </i>
                                Comentários
                            </button>
                            <button>
                                <i class="fas fa-share">
                                </i>
                                Compartilhar
                            </button>
                        </div>
                        <div class="post-comments" style="display: none">
                            <div class="comments" >
                                <div class="post-comment" >
                                    <img class="img-input" alt="Profile Picture"
                                        src="../Midia/perfil.svg"
                                        width="40" />
                                    <input class="MyComment" placeholder="Responder a Nome"
                                        style="width: 95%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; transition: background-color 0.3s, box-shadow 0.3s, transform 0.3s;"
                                        type="text" onblur="this.style.transform='scale(1)'" />
                                </div>
                                <div class="post-actions">
                                    <button onclick="addPhoto()">
                                        <i class="fas fa-image">
                                        </i>
                                        Adicionar Fotos
                                    </button>
                                    <button>
                                        <i class="fas fa-hashtag">
                                        </i>
                                        Hashtags
                                    </button>
                                    <button class="publi_comment">
                                        <i class="fas fa-paper-plane">
                                        </i>
                                        Comentar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="post-box post">
                        <div class="post-header">
                            <img alt="Profile Picture" height="40" onclick="expandImage(this)"
                                src="../Midia/perfil.svg"
                                width="40" />
                            <div class="post-info-perfil">
                                <div class="info">
                                    <span class="name">
                                        Nome de Usuário
                                    </span>
                                    <span class="creat_at">
                                        data e hora
                                    </span>
                                </div>
                                <div class="menu">
                                    <i class="fas fa-ellipsis-h" onclick="toggleMenu(this)">
                                    </i>
                                    <div class="menu-content">
                                        <a href="#">
                                            Excluir post
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-content-publi">
                            Conteúdo do post...
                        </div>
                        <div class="post-actions-perfil">
                            <button class="like-button" onclick="toggleLike(this)">
                                <i class="fas fa-heart">
                                </i>
                                Like
                            </button>
                            <button>
                                <i class="fas fa-retweet">
                                </i>
                                Retweet
                            </button>
                            <button class="button-comment">
                                <i class="fas fa-comment">
                                </i>
                                Comentários
                            </button>
                            <button>
                                <i class="fas fa-share">
                                </i>
                                Compartilhar
                            </button>
                        </div>
                        <div class="post-comments" style="display: none">
                            <div class="comments" >
                                <div class="post-comment" >
                                    <img class="img-input" alt="Profile Picture"
                                        src="../Midia/perfil.svg"
                                        width="40" />
                                    <input class="MyComment" placeholder="Responder a Nome"
                                        style="width: 95%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; transition: background-color 0.3s, box-shadow 0.3s, transform 0.3s;"
                                        type="text" onblur="this.style.transform='scale(1)'" />
                                </div>
                                <div class="post-actions">
                                    <button onclick="addPhoto()">
                                        <i class="fas fa-image">
                                        </i>
                                        Adicionar Fotos
                                    </button>
                                    <button>
                                        <i class="fas fa-hashtag">
                                        </i>
                                        Hashtags
                                    </button>
                                    <button class="publi_comment">
                                        <i class="fas fa-paper-plane">
                                        </i>
                                        Comentar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                <div class="republi"></div>
            </form>
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