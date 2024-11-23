const publiButton = document.getElementById("publi");
const retwButton = document.getElementById("retw");

let ThatsOrThats = false

publiButton.addEventListener("click", ()=>{
    if (ThatsOrThats) {
        ThatsOrThats = !ThatsOrThats
        publiButton.style.borderBottom = "1px solid black"
        retwButton.style.borderBottom = "none"
    }
})

retwButton.addEventListener("click", ()=>{
    if (!ThatsOrThats) {
        ThatsOrThats = !ThatsOrThats
        retwButton.style.borderBottom = "1px solid black"
        publiButton.style.borderBottom = "none"
    }
})