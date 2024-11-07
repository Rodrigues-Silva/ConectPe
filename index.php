<?php 

    if($_SESSION) 
    {
        header("Location: user/index.php");
    }
    else
    {
        header("Location: user/formLogin.php");
    }
