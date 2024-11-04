<?php 
    require_once "connection.php"; 
    // Inclui a canexão ao banco de dados

    print_r($_POST);

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

    function validateData ($PostData, &$erros) //Verificar se os campos foram preenchidos corretamente
    {
        $Data = [];

        if (isset($PostData["NameSignup"]) && !empty($PostData["NameSignup"])) 
        {
            $Data["Name"] = filter_var($PostData["NameSignup"], FILTER_SANITIZE_SPECIAL_CHARS);
            echo "OK";
        }
        else
        {
            $erros[] = "NameSignup - Campo de Nome vazio";
        }
        //
        if (isset($PostData["EmailSignup"]) && !empty($PostData["EmailSignup"])) 
        {
            $Data["Email"] = filter_var($PostData["EmailSignup"], FILTER_SANITIZE_EMAIL);
            echo "OK";
        }
        else
        {
            $erros[] = "EmailSignup - Campo de Email vazio";
        }
        //
        if (isset($PostData["PassSignup"]) && !empty($PostData["PassSignup"]))
        {
            $Data["Pass"] = filter_var($PostData["PassSignup"], FILTER_SANITIZE_SPECIAL_CHARS);
            echo "OK";
        }
        else
        {
            $erros[] = "PassSignup - Campo de senha vazio";
        }
        //
        if (isset($PostData["ConfirmSignup"]) && !empty($PostData["ConfirmSignup"]))
        {
            $Data["Confirm"] = filter_var($PostData["ConfirmSignup"], FILTER_SANITIZE_SPECIAL_CHARS);
            echo "OK";
        }
        else
        {
            $erros[] = "ConfirmSignup - Preencha este Campo";
        }
        //
        print_r($Data);
        return $Data;
    }

$MetaData = validateData($_POST, $ErrosS);
print_r($MetaData);
print_r($ErrosS);

$ExistMail = ExistEmail($pdo, $MetaData["Email"]);
if ($ExistMail) {
    header("Location: ../user/formLogin.php?errosRegister=" . urlencode("EmailSignup"));
    exit();
}

if (ExistName($pdo, $MetaData["Name"])) {
    header("Location: ../user/formLogin.php?errosRegister=" . urlencode("NameSignup"));
    exit();
}

if (count($ErrosS) === 0)
{
    if ($MetaData["Pass"] !== $MetaData["Confirm"]) {
        $erros_json = json_encode("ConfirmSignup");
        header("Location: ../user/formLogin.php?errosRegister=" . urlencode($erros_json));
        exit();
    } else {
        header("Location: ../user/insert.php");
        exit();
    }
}
else
{
    echo "Erro";
    // $erros_json = json_encode($ErrosS);
    // header("Location: ../user/formLogin.php?errosRegister=" . urlencode($erros_json));
    // exit();
}