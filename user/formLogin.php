<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-in - ConectPe</title>

    <link rel="stylesheet" href="../css/logIn.css">

</head>
<body>
    
    <div class="container">
        <div class="logo">
            <div class="log">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-handshake h-8 w-8 text-blue-500" data-id="5"><path d="m11 17 2 2a1 1 0 1 0 3-3"></path><path d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4"></path><path d="m21 3 1 11h-2"></path><path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3"></path><path d="M3 4h8"></path></svg>
                <h1>Conect<span class="Pe">Pe</span></h1>
            </div>
            <p> Conecte-se às melhores oportunidades</p>
        </div>
        <div class="card">
            <div class="form-docker">
                <div id="formLogin" class="form-container" >
                    <h2>Log-In</h2>
                    <p>Entre com suas credenciais para acessar sua conta</p>
                    <form action="" class="login">
                        <div class="formGroup">
                            <label for="txtEmail">Email</label>
                            <input placeholder="Example@email.com" type="email" name="txtEmail" id="txtEmail">
                        </div>
                        <div class="formGroup">
                            <label for="txtPass">Senha</label>
                            <input placeholder="Digite sua senha" type="password" name="txtPass" id="txtPass">
                        </div>
                        <button type="submit">Entrar</button>
                    </form>
                </div>
                <div id="formSign" class="form-container hidden">
                    <h2>Sign-In</h2>
                    <p>Crie sua conta e conecte-se</p>
                    <form action="" class="Sign">
                        <div class="formGroup">
                            <label for="txtName">Nome de usuário</label>
                            <input placeholder="Henrique" type="text" name="txtName" id="txtName">
                        </div>
                        <div class="formGroup">
                            <label for="txtEmail">Email</label>
                            <input placeholder="Exemple@email.com" type="email" name="txtEmail" id="txtEmail">
                        </div>
                        <div class="formGroup">
                            <label for="txtPass">Senha</label>
                            <input placeholder="Crie a sua senha" type="password" name="txtPass" id="txtPass">
                        </div>
                        <div class="formGroup">
                            <label for="txtConfirm">Confirme sua senha</label>
                            <input placeholder="Confirme a senha" type="password" name="txtConfirm" id="txtConfirm">
                        </div>
                        <button type="submit">Cadastrar-se</button>
                    </form>
                </div>
            </div>
            <div class="change">
                <button id="changeButton">Não tem uma conta? Cadastre-se</button>
            </div>
        </div>
    </div>

    <script>
        const formLogin = document.getElementById("formLogin");
        const formSignin = document.getElementById("formSign");
        const Button = document.getElementById("changeButton");
        let isLoginForm = true;

        Button.addEventListener("click", () => {
            isLoginForm = !isLoginForm;
            if (isLoginForm) {
                formLogin.classList.remove("hidden");
                formSignin.classList.add("hidden");
                Button.textContent = "Não tem uma conta? Cadastre-se"
            } else {
                formLogin.classList.add("hidden");
                formSignin.classList.remove("hidden");
                Button.textContent = "Já tem uma conta? Entre";
                console.log(formLogin.classList, formSignin.classList);
            }
        })

    </script>
</body>
</html>