let conteudo = document.getElementById("content-post");
const postar = document.getElementById("publicar");

conteudo.addEventListener("input", () => {
    postar.style.pointerEvents = "auto"
    postar.style.color = "#2d88ff"
})

postar.addEventListener("click", (e) => {
  e.preventDefault();
  const local = document.getElementById("post-box");

  local.insertAdjacentHTML(
    "afterend",
    `
    <div class="post-box post">
                    <div class="post-header">
                        <img alt="Profile Picture" height="40" onclick="expandImage(this)"
                            src="https://storage.googleapis.com/a1aa/image/bRrQ9zygscLmOR0DWJc40gRkNjAeLVSnAifQhyC3W9eAHXQnA.jpg"
                            width="40" />
                        <div class="post-info">
                            <span>
                                Nome de Usuário
                            </span>
                            <div class="menu">
                                <i class="fas fa-ellipsis-h" onclick="toggleMenu(this)">
                                </i>
                                <div class="menu-content">
                                    <a href="#">
                                        Acessar Perfil do Usuário
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post-content">
                        ${conteudo.value}
                    </div>
                    <div class="post-actions">
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
                    <div class="post-comments">
                        <div class="comments" >
                            <div class="post-comment" >
                                <img class="img-input" alt="Profile Picture"
                                    src="https://storage.googleapis.com/a1aa/image/bRrQ9zygscLmOR0DWJc40gRkNjAeLVSnAifQhyC3W9eAHXQnA.jpg"
                                    width="40" />
                                <input class="MyComment" placeholder="Responder a Nome"
                                    style="width: 95%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; transition: background-color 0.3s, box-shadow 0.3s, transform 0.3s;"
                                    type="text" onblur="this.style.transform='scale(1)'" />
                            </div>
                            <div class="post-actions">
                                <button onclick="addPhoto()">
                                    <i class="fas fa-image">
                                    </i>
                                    Adicionar Fotos
                                </button>
                                <button>
                                    <i class="fas fa-hashtag">
                                    </i>
                                    Hashtags
                                </button>
                                <button class = "publi_comment">
                                    <i class="fas fa-paper-plane">
                                    </i>
                                    Comentar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        `
  );
  conteudo.value = "";
  postar.style.pointerEvents = "none"
  postar.style.color = "#575757"
});
