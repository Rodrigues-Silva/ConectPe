<?php 
    session_start();
    //Prepara o arquivo para trabalhar com a variavel GLOBAL $_SESSION
    
    session_destroy();
    //Destroi a sessão atual
    
    header("Location: ../index.php");
    exit();