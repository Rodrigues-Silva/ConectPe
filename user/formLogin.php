<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-in - ConectPe</title>

    <link rel="stylesheet" href="../css/logIn.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
        <div class="card" id="card">
            <div class="form-docker">
                <div id="formLogin" class="form-container" >
                        <h2>Log-In</h2>
                        <p class="p-form">Entre com suas credenciais para acessar sua conta</p>
                    <form action="Login.php" class="login" method="post">
                        <div class="formGroup">
                            <label for="EmailLogin">Email</label>
                            <input required placeholder="Example@email.com" type="email" name="EmailLogin" id="EmailLogin">
                        </div>
                        <div class="formGroup">
                            <label for="PassLogin">Senha</label>
                            <div class="input"><input required placeholder="Digite sua senha" type="password" name="PassLogin" id="PassLogin"></div>
                        </div>
                        <button type="submit">Entrar</button>
                    </form>
                </div>
                <div id="formSign" class="form-container hidden">
                        <h2>Sign-In</h2>
                        <p class="p-form">Crie sua conta e conecte-se</p>
                    <div class="errosG" id="errosG">
                    </div>
                    <form action="../core/validate.php" class="Sign" method="POST">
                        <div class="formGroup">
                            <label for="NameSignup">Nome de usuário</label>
                            <input required placeholder="Henrique" type="text" name="NameSignup" id="NameSignup">
                        </div>
                        <div class="formGroup">
                            <label for="EmailSignup">Email</label>
                            <input required placeholder="Exemple@email.com" type="email" name="EmailSignup" id="EmailSignup">
                        </div>
                        <div class="campoSenha">
                            <div class="formGroup">
                                <label for="PassSignup">Senha</label>
                                <input required class="inputPass" placeholder="Crie a sua senha (Example23@)" type="password" name="PassSignup" id="PassSignup">
                                <div class="erros">
                                    <p class="verify">Senha deve ter 8 caracteres no minimo</p>
                                    <p class="verify">Senha deve ter letras maiusculas</p>
                                    <p class="verify">Senha deve ter numeros</p>
                                    <p class="verify">Senha deve ter caracteres especiais</p>
                                </div>
                            </div>
                            <div class="formGroup">
                                <label for="ConfirmSignup">Confirme sua senha</label>
                                <input required class="inputPass" placeholder="Confirme a senha" type="text" name="ConfirmSignup" id="ConfirmSignup">
                                <div id="confirmError" style="display: none">
                                    <p class="ErroConfirm">Digite a mesma senha criada acima</p>
                                </div>
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
        const card = document.getElementById("card");
        const formLogin = document.getElementById("formLogin");
        const formSignin = document.getElementById("formSign");
        const Button = document.getElementById("changeButton");
        let isLoginForm = true;

        function transForm () {
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
        }

        Button.addEventListener("click", transForm);

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
            const campoDeErro = document.getElementById("errosG")
            
            // console.log(camposErroS)
            if (camposErroS) {
                campoDeErro.style.display = "block"
                isLoginForm = true;
                transForm();

                const campos = JSON.parse(camposErroS);
                if (Array.isArray(campos)) {
                    campos.forEach(campo => {
                        const twoFase = campo.split(" - ");
                        const input =document.getElementById(twoFase[0]);

                        if (input) {
                            input.classList.add("inputErro");

                            let parag =document.createElement("p");
                            parag.classList.add("verifyG");
                            parag.innerHTML =twoFase[1];

                            campoDeErro.appendChild(parag);
                        }
                    })
                }
                else
                {
                    const twoFase = campos.split(" - ");
                    const input =document.getElementById(twoFase[0]);

                    if (input) {
                        input.classList.add("inputErro");

                        let parag =document.createElement("p");
                        parag.classList.add("verifyG");
                        parag.innerHTML =twoFase[1];

                        campoDeErro.appendChild(parag);
                    }
                }
            };
    })

    </script>
</body>
</html>