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

    $query = "SELECT posts.*, GROUP_CONCAT(midia.media_url SEPARATOR ':') AS img_urls, users.name AS user_name, users.profile_pic AS user_pic FROM posts LEFT JOIN midia ON posts.id = midia.post_id LEFT JOIN users ON posts.user_id = users.id GROUP BY posts.id ORDER BY posts.create_at DESC LIMIT 30;";
    $consulta =  $pdo->prepare($query);
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
    <link rel="stylesheet" href="../css/posts.css">

</head>
<body>
    
    <header class="top-bar">
        <div class="logo">
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-handshake h-8 w-8 text-blue-500" data-id="5"><path d="m11 17 2 2a1 1 0 1 0 3-3"></path><path d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4"></path><path d="m21 3 1 11h-2"></path><path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3"></path><path d="M3 4h8"></path></svg>
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
            <a href="perfil.php">
                <img alt="User Image" height="40"
                    src="<?php echo $_SESSION["profile_pic"]; ?>"
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
        <form action="../posts/new.php" method="post" enctype="multipart/form-data" class="ADDPost" id="ADDPost">
                <div class="post-header">
                    <img alt="User Image" height="50"
                    src="<?php echo $_SESSION["profile_pic"]; ?>"
                    style="border-radius: 50%; margin-right: 10px;" width="50" />
                    <div class="post-info">
                        <span>
                            <?php echo $_SESSION["Name"]?>
                        </span>
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
                    <div class="hashtag" id="hashtag" >
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
                <?php foreach($posts as $post) {?>
                    <div class="post" id="post">
                        <div class="header">
                            <img alt="User Image" height="50"
                            src="<?php echo $post->user_pic ?>"
                            style="border-radius: 50%; margin-right: 10px;" width="50" />
                            <div class="post-info">
                                <div class="title">
                                    <span>
                                        <?php echo $post->user_name?>
                                    </span>
                                    <span class="time"><?php echo tempoPassado($post->create_at);?></span>
                                </div>
                                <div class="menu">
                                    <i class="fas fa-ellipsis-h"></i>
                                    <div class="menu-content">
                                        <?php if ($post->user_id != $_SESSION["ID"]) {?>
                                            <a href="perfil.php?fuy=<?php echo $post->user_id?>">
                                                Acessar Perfil do Usuário
                                            </a>
                                        <?php } else {?>
                                            <a href="../posts/delete.php?fuy=<?php echo $post->id?>" id="removePost" style="color: red;">
                                                Deletar post
                                            </a>
                                        <?php }?>
                                    </div>
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
    <div class="confirm" id="caixa">
        <div class="caixinha">
            <header>
                <h1>Excluir Post</h1>
            </header>
            <main>
                <p>Deseja realmente excluir este post?</p>
            </main>
            <footer>
                <button id="cancel">Cancelar</button>
                <button id="confirm">Confirmar</button>
            </footer>
        </div>
    </div>

    <script src="../responsive/post-img.js"></script>
    <script src="../posts/fetch.js"></script>
    <script>

        function scrollToTop() {
            const main = document.getElementById("main");
            main.scrollTo({top: 0, behavior: "smooth"});
        }

        const menuButton =document.getElementById("hashtag");
        const menu = document.getElementById("hashtag-content");

        function toggleMenu(e) {
            if (menu.style.display == "none" || menu.style.display == "") {
                menu.style.display = "block";
                
            } else {
                menu.style.display = "none";
            }
            e.stopPropagation();
        }

        menuButton.addEventListener("click", toggleMenu);

        document.addEventListener("click", () => {
            if (menu.style.display == "block") {
                menu.style.display = "none";
            }
        })

        menu.addEventListener("click", (e) => {
            e.stopPropagation();
        });
    </script>
</body>
</html>