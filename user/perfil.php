<?php 
    require_once "../core/connection.php";
    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    function tempoPassado($dataCriacao) {
        $agora = new DateTime(); 
        $criacao = new DateTime($dataCriacao); 
        $diferenca = $agora->diff($criacao);   
        // print_r($diferenca);
        if ($diferenca->d > 0) {
            return $diferenca->d . ' dia' . ($diferenca->d > 1 ? 's' : '') . ' atrás';
        } elseif ($diferenca->h > 0) {
            return $diferenca->h . ' hora' . ($diferenca->h > 1 ? 's' : '') . ' atrás';
        } elseif ($diferenca->i > 0) {
            return $diferenca->i . ' minuto' . ($diferenca->i > 1 ? 's' : '') . ' atrás';
        } else {
            return 'Agora mesmo';
        }
    }

    if (!isset($_SESSION["ID"]) && empty($_SESSION["ID"]))
    {
        header("Location: formLogin.php");
        exit();
    }

    $query = "SELECT posts.*, GROUP_CONCAT(midia.media_url SEPARATOR ':') AS img_urls FROM posts LEFT JOIN midia ON posts.id = midia.post_id WHERE user_id = :id_user GROUP BY posts.id ORDER BY posts.create_at DESC";
    $consulta = $pdo->prepare($query);
    $consulta->bindParam(":id_user", $_SESSION["ID"], PDO::PARAM_STR);
    $consulta->execute();

    $posts = $consulta->fetchAll();
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
    <link rel="stylesheet" href="../css/posts.css">

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
                    src="<?php echo $_SESSION["profile_pic"]; ?>"
                    style="border-radius: 50%; margin-right: 10px;" width="40" />
                <?php echo $_SESSION["Name"]; ?>
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
            <button class="anun" type="button">
                <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                Anunciar
            </button>
        </aside>
        
        <main class="main-content" id="main">
        <form action="" method="post" enctype="multipart/form-data" class="ADDPost">
                <div class="perfil">
                    <img src="<?php echo $_SESSION["profile_pic"]; ?>" alt="Foto de perfil">
                    <div class="info">
                        <h2><?php echo $_SESSION["Name"]; ?></h2>
                        <p><?php echo $_SESSION["Bio"];?></p>
                        <a href="<?php echo $_SESSION["Link"]?>" target="_blank"><i class="fa-solid fa-link"></i><?php echo $_SESSION["Link"]?></a>
                        <a href="formAtualização.php" class="editButton">Editar Perfil</a>
                    </div>
                </div>
                <nav>
                    <div class="campNav" id="publi">Posts</div>
                    <div class="campNav" id="retw">Republicados</div>
                </nav>
            </form>
            <div class="posts">
            <?php foreach($posts as $post) {?>
                    <div class="post" id="post" data-id="<?php echo $post->$id?>">
                        <div class="header">
                            <img alt="User Image" height="50"
                            src="<?php echo $_SESSION["profile_pic"] ?>"
                            style="border-radius: 50%; margin-right: 10px;" width="50" />
                            <div class="post-info">
                                <div class="title">
                                    <span>
                                        <?php echo $_SESSION["Name"]?>
                                    </span>
                                    <span class="time"><?php echo tempoPassado($post->create_at);?></span>
                                </div>
                            </div>
                        </div>
                        <div class="content-publi">
                            <?php echo $post->content;?>
                            <div class="zone-img">
                                <?php 
                                    if ($post->img_urls !== null)
                                    {
                                        $imagens = explode(":", $post->img_urls);

                                        foreach ($imagens as $img) {
                                ?>

                                    <div class="picture">
                                        <img draggable="false" class="postImg" src="<?php echo "../posts/" . $img?>">
                                    </div>

                                <?php }} ?>
                            </div>
                        </div>
                        <div class="actions">
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
                    </div>
                <?php }?>
            </div>
            <div class="republi"></div>
        </main>
        
        <aside class="sidebar-right">
            <h3>
                Recomendados
            </h3>
                <div class="recommended">
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
                <h3>
                    Hashtags Populares
                </h3>
                <div class="hashtags">
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
                    <p id="p_term"><a id="term" href="../terms.html" target="_blank">Termos de Uso</a> - <a id="term" class="term" href="../policy.html" target="_blank">Politica de privacidade</a></p>
                    <p id="p_term">Versão do App 1.0.0</p>
                    <p id="p_term">© 2024 ConectPE - Todos os direitos reservados.</p>
                </div>
        <button class="fixed-button" onclick="scrollToTop()">
            <i class="fas fa-arrow-up">
            </i>
        </button>
        </aside>
    </div>

    <script src="../responsive/post-img.js"></script>
    <script src="../responsive/posts-perfil.js"></script>
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