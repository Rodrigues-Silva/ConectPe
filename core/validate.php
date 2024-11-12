<?php 
    require_once "../src/PHPMailer.php";
    require_once "../src/SMTP.php";
    require_once "../src/Exception.php";
    // Inclui Arquivos necessarios para o envio de emails

    session_start();

    require_once "connection.php"; 
    // Inclui a canexão ao banco de dados

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    // Dizemos quais classes usaremos no nosso projeto

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
            $ErrosS = array();
            // Variavel que guardará os erros ocorridos durante o cadastro

            function ExistEmail ($pdo, $Email)  //Verifica se já existe o email cadastrado no banco de dados
            {
                $query = "SELECT * FROM Users WHERE email = :Email";
                $sql = $pdo->prepare($query);
                $sql->bindValue(":Email", $Email);
                $sql->execute();

                return $sql->rowCount() > 0;
            }

            function ExistName ($pdo, $Name)  //Verifica se já existe o Nome de usuario cadastrado no banco de dados
            {
                $query = "SELECT * FROM Users WHERE name = :Name";
                $sql = $pdo->prepare($query);
                $sql->bindValue(":Name", $Name);
                $sql->execute();

                return $sql->rowCount() > 0;
            }

            function gerarToken() {
                return bin2hex(random_bytes(3));
            }

            function validateData ($PostData, &$erros) //Verificar se os campos foram preenchidos corretamente
            {

                if (isset($PostData["NameSignup"]) && !empty($PostData["NameSignup"])) 
                {
                    $_SESSION["Name"] = filter_var($PostData["NameSignup"], FILTER_SANITIZE_SPECIAL_CHARS);
                }
                else
                {
                    $erros[] = "NameSignup - Campo de Nome vazio";
                }
                //
                if (isset($PostData["EmailSignup"]) && !empty($PostData["EmailSignup"])) 
                {
                    $_SESSION["Email"] = filter_var($PostData["EmailSignup"], FILTER_SANITIZE_EMAIL);
                }
                else
                {
                    $erros[] = "EmailSignup - Campo de Email vazio";
                }
                //
                if (isset($PostData["PassSignup"]) && !empty($PostData["PassSignup"]))
                {
                    $_SESSION["Pass"] = filter_var($PostData["PassSignup"], FILTER_SANITIZE_SPECIAL_CHARS);
                }
                else
                {
                    $erros[] = "PassSignup - Campo de senha vazio";
                }
                //
                if (isset($PostData["ConfirmSignup"]) && !empty($PostData["ConfirmSignup"]))
                {
                    $_SESSION["Confirm"] = filter_var($PostData["ConfirmSignup"], FILTER_SANITIZE_SPECIAL_CHARS);
                }
                else
                {
                    $erros[] = "ConfirmSignup - Os campos de senha deve ser preenchidos com a mesma senha";
                }
                //
            }

        validateData($_POST, $ErrosS);

        $ExistMail = ExistEmail($pdo, $_SESSION["Email"]);
        if ($ExistMail) {
            header("Location: ../user/formLogin.php?errosRegister=" . urlencode("EmailSignup - Email já está cadastrado"));
            exit();
        }

        if (ExistName($pdo, $_SESSION["Name"])) {
            header("Location: ../user/formLogin.php?errosRegister=" . urlencode("NameSignup - Nome de usuario já está sendo usado"));
            exit();
        }

        if (count($ErrosS) === 0)
        {
            if ($_SESSION["Pass"] !== $_SESSION["Confirm"]) 
            {
                $erros_json = json_encode("ConfirmSignup - Os dois campos de senha devem ser preenchidos com a senha criada");
                header("Location: ../user/formLogin.php?errosRegister=" . urlencode($erros_json));
                exit();
            }
            else
            {
                $_SESSION["token"] = gerarToken();
            
                $mail = new PHPMailer(true);
            
                try{
            
                    $mail->isSMTP();
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPAuth = true;
                    $mail->Username = "ConectPe0@gmail.com";
                    $mail->Password = "engg kaxz ylyi denu";
                    $mail->Port = 587;
                    $mail->SMTPOptions = [
                        'ssl' => [
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true,
                        ]
                    ];
            
                    $mail->setFrom("ConectPe0@gmail.com");
                    $mail->addAddress($_SESSION["Email"]);
            
                    $mail->isHTML(true);
                    $mail->Subject = "Teste de E-mail";
                    $mail->Body = "Chegou o Email Token:" . $_SESSION["token"];
            
                    if ($mail->send()) {
                        print_r($_SESSION);
                    } else {
                        $erro[] =  " Email não enviado";
                    }
                } catch (Exception $e) {
                    $erros_json = json_encode("Erro ao enviar menssagem: {$mail->ErrorInfo}");
                    header("Location: ../user/formLogin.php?errosRegister=" . urlencode($erros_json));
                    exit();
                }
            }
        }
        else
        {
            $erros_json = json_encode($ErrosS);
            header("Location: ../user/formLogin.php?errosRegister=" . urlencode($erros_json));
            exit();
        }
    }
    else
    {
        $erros_json = json_encode("Dados enviados incorretamente");
        header("Location: ../user/formLogin.php?errosRegister=" . urlencode($erros_json));
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validar E-Mail</title>

    <link rel="stylesheet" href="../css/validarEmail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    
    <div class="container">
        <form action="../user/insert.php" method="POST" class="card">
            <div class="logo">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-handshake h-8 w-8 text-blue-500" data-id="5"><path d="m11 17 2 2a1 1 0 1 0 3-3"></path><path d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4"></path><path d="m21 3 1 11h-2"></path><path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3"></path><path d="M3 4h8"></path></svg>
                <h1>Conect<span>Pe</span></h1>
            </div>
            <i class="fa-solid fa-envelope-circle-check"></i>
            <h2>Token de Autenticação</h2>
            <p class="title">Enviado para <?php echo $_SESSION["Email"]?></p>
            <h4>Insira o token para finalizar</h4>
                <div class="inputs">
                    <input type="text" name="txtToken1" id="txtToken">
                    <input type="text" name="txtToken2" id="txtToken">
                    <input type="text" name="txtToken3" id="txtToken">
                    <input type="text" name="txtToken4" id="txtToken">
                    <input type="text" name="txtToken5" id="txtToken">
                    <input type="text" name="txtToken6" id="txtToken">            
                </div>
                <div class="finally">
                    <a href="javascript:location.reload();">
                        <i class="fa-solid fa-arrow-left"></i>
                        Reenviar Token
                    </a>
                    <button type="submit">
                        Confirmar
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            <p class="terms">Ao clicar em Confirmar, você concorda com os <a href="">Termos de Uso</a> e <a href="#">Politica de Privacidade</a> da ConectPe</p>
            <p class="garaty"><i class="fa-solid fa-lock"></i>Ambiente seguro ConectPe</p>
        </form>
    </div>

</body>
</html>
    