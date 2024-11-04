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
                    <div class="sep">
                        <h2>Log-In</h2>
                        <p class="p-form">Entre com suas credenciais para acessar sua conta</p>
                    </div>
                    <form action="session.php" class="login" method="post">
                        <div class="formGroup">
                            <label for="EmailLogin">Email</label>
                            <input  placeholder="Example@email.com" type="email" name="EmailLogin" id="EmailLogin">
                        </div>
                        <div class="formGroup">
                            <label for="PassLogin">Senha</label>
                            <input  placeholder="Digite sua senha" type="password" name="PassLogin" id="PassLogin">
                        </div>
                        <button type="submit">Entrar</button>
                    </form>
                </div>
                <div id="formSign" class="form-container hidden">
                    <h2>Sign-In</h2>
                    <p class="p-form">Crie sua conta e conecte-se</p>
                    <form action="../core/validate.php" class="Sign" method="post">
                        <div class="formGroup">
                            <label for="NameSignup">Nome de usuário</label>
                            <input  placeholder="Henrique" type="text" name="NameSignup" id="NameSignup">
                        </div>
                        <div class="formGroup">
                            <label for="EmailSignup">Email</label>
                            <input  placeholder="Exemple@email.com" type="email" name="EmailSignup" id="EmailSignup">
                        </div>
                        <div class="formGroup">
                            <label for="PassSignup">Senha</label>
                            <input  placeholder="Crie a sua senha (Example23@)" type="text" name="PassSignup" id="PassSignup">
                            <div class="erros">
                                <p class="verify">Senha deve ter 8 caracteres no minimo</p>
                                <p class="verify">Senha deve ter letras maiusculas</p>
                                <p class="verify">Senha deve ter numeros</p>
                                <p class="verify">Senha deve ter caracteres especiais</p>
                            </div>
                        </div>
                        <div class="formGroup">
                            <label for="ConfirmSignup">Confirme sua senha</label>
                            <input  placeholder="Confirme a senha" type="text" name="ConfirmSignup" id="ConfirmSignup">
                            <div id="confirmError" style="display: none">
                                <p class="ErroConfirm">Digite a mesma senha criada acima</p>
                            </div>
                        </div>
                        <button id="register" type="submit">Cadastrar-se</button>
                    </form>
                </div>
            </div>
            <div class="change">
                <button id="changeButton">Não tem uma conta? Cadastre-se</button>
            </div>
        </div>
    </div>

    <script>
        const card = document.getElementsByClassName(".card")
        const formLogin = document.getElementById("formLogin");
        const formSignin = document.getElementById("formSign");
        const Button = document.getElementById("changeButton");
        let isLoginForm = true;

        Button.addEventListener("click", () => {
            isLoginForm = !isLoginForm;
            if (isLoginForm) {
                formLogin.classList.remove("hidden");
                formSignin.classList.add("hidden");
                card.classList.add("IN")
                card.classList.remove("UP")
                Button.textContent = "Não tem uma conta? Cadastre-se"
            } else {
                formLogin.classList.add("hidden");
                formSignin.classList.remove("hidden");
                card.classList.add("UP")
                card.classList.remove("IN")
                Button.textContent = "Já tem uma conta? Entre";
                console.log(formLogin.classList, formSignin.classList);
            }
        })

        const senhaVerify = document.getElementById("PassSignup");
        let verify = false 

        senhaVerify.addEventListener("input", () => {
            let parag = document.querySelectorAll(".verify");

            if (senhaVerify.value.length >= 8) {
                parag[0].style.color = "green";
            } else {
                parag[0].style.color = "rgb(255, 6, 6)";
            }
            //
            if (/[A-Z]/.test(senhaVerify.value)) {
                parag[1].style.color = "green";
            } else {
                parag[1].style.color = "rgb(255, 6, 6)";
            }
            //
            if (/[0-9]/.test(senhaVerify.value)) {
                parag[2].style.color = "green";
            } else {
                parag[2].style.color = "rgb(255, 6, 6)";
            }
            //
            if (/[^a-zA-Z0-9]/.test(senhaVerify.value)) {
                parag[3].style.color = "green";
            } else {
                parag[3].style.color = "rgb(255, 6, 6)";
            }
            //
            if (senhaVerify.value.length >= 8 && /[A-Z]/.test(senhaVerify.value) && /[0-9]/.test(senhaVerify.value) && /[^a-zA-Z0-9]/.test(senhaVerify.value)) {
                verify = true;
            } else {
                verify =false
            }
            //
            const ButtonR = document.getElementById("register");
            if (verify === false) {
                ButtonR.style.pointerEvents = "none"
                ButtonR.style.backgroundColor = "#4B5563"
            } else {
                ButtonR.style.pointerEvents = "auto"
                ButtonR.style.backgroundColor = "#3B82F6"
            }

        })

        document.addEventListener("DOMContentLoaded", ()=> {
            const URL = new URLSearchParams(window.location.search);
            const camposErroS = URL.get("errosRegister");
            
            // console.log(camposErroS)
            if (camposErroS) {
                formLogin.classList.add("hidden");
                formSignin.classList.remove("hidden");

                const campos = JSON.parse(camposErroS);
                let input = document.getElementById(campos);
                if (input) {
                    let erro = document.getElementById("confirmError");
                    erro.style.display = "block";
                    input.style.border = "1px solid rgb(236, 52, 52)";
                    input.style.marginBottom = "0";
                }
            };
    })

    </script>
</body>
</html>