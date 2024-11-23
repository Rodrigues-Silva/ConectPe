<?php 
    $lifetime = 864000;

    session_set_cookie_params([
        'lifetime' => time() + $lifetime, // Duração inicial do cookie
        'path' => '/',           // Disponível em todo o site
        'domain' => '',          // Domínio atual
        'secure' => false,       // Alterar para true em HTTPS
        'httponly' => true       // Restringe acesso ao cookie via HTTP
    ]);

    session_start();

    if($_SESSION) 
    {
        header("Location: user/index.php");
    }
    else
    {
        header("Location: user/formLogin.php");
    }
    