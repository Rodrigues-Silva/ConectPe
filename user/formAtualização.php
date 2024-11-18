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
    <link rel="stylesheet" href="../css/atualizacao.css">

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
            <a href="javascript: history.back();">
                <img alt="User Image" height="40"
                    src="<?php echo "../Midia/perfil.svg"; ?>"
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
                        <div class="profile_pic">
                            <img id="picPerfil" src="<?php echo "../Midia/perfil.svg"; ?>" alt="Foto de perfil" height="250" width="250">
                            <input type="file" name="perfilPic" id="perfilPic" class="perfilPic form-control">
                            <div class="menuPic" id="cp">
                                <label for="perfilPic">
                                    Alterar Foto 
                                </label>
                                <p>
                                    Remover Foto Atual
                                </p>
                            </div>
                            <div class="menuPic" id="sp">
                                <label for="perfilPic">
                                    Carregar Foto
                                </label>
                            </div>
                        </div>

                    <div class="info">
                        <input type="text" name="perfilName" id="perfilName" class="perfilName" placeholder="Nome de Usuario" value="<?php echo $_SESSION["Name"] ?>">
                        <textarea placeholder="Bio" name="perfilBio" id="perfilBio" class="perfilBio" value="<?php echo  $_SESSION["Bio"] ?>"></textarea>
                        <input placeholder="link" type="text" name="perfilLink" id="perfilLink" class="perfilLink" value="<?php echo $_SESSION["Link"]?>">
                        <div class="functions">
                            <a href="javascript: history.back();"><button type="reset">Voltar</button></a>
                            <button type="submit">Salvar</button>
                        </div>
                    </div>
                </div>
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

    <script src="../responsive/perfil-img.js"></script>
    <script>

        function scrollToTop() {
            const main = document.getElementById("main");
            main.scrollTo({top: 0, behavior: "smooth"});
        }

        const pictureProf =document.getElementById("picPerfil");

        pictureProf.addEventListener("click", (e)=>{
            if (pictureProf.src == "http://localhost/ConectPE/Midia/perfil.svg") {
                const menuPic = document.getElementById("sp")
                if (menuPic.style.display == "") {
                    menuPic.style.display = "flex"
                } else {
                    menuPic.style.display = ""
                }
                e.stopPropagation();

                menuPic.addEventListener("click", (e) => {
                    e.stopPropagation();
                });

                document.addEventListener("click", () => {
                    if (menuPic.style.display == "flex") {
                        menuPic.style.display = "";
                    }
                })

            } else {
                const menuPic =document.getElementById("cp")
                if (menuPic.style.display == "") {
                    menuPic.style.display = "flex"
                } else {
                    menuPic.style.display = ""
                }
                e.stopPropagation();

                menuPic.addEventListener("click", (e) => {
                    e.stopPropagation();
                });

                document.addEventListener("click", () => {
                    if (menuPic.style.display == "flex") {
                        menuPic.style.display = "";
                    }
                })

            }
        })
    </script>
</body>
</html>