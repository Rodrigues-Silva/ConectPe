const input = document.getElementById("input-File");
const local = document.getElementById("zone-img");

let salvos = []

input.addEventListener("input", () => {
    let files = Array.from(input.files);
    if (files.length > 0) {
        const formate = ["image/jpeg", "image/png", "image/jpg"];
        let erros = [];
        let post_files = 0
        files.forEach(file => {
            if (!formate.includes(file.type) || file.size > 2097152) {
                erros.push(file.name);
            } else {
                const picture = document.createElement("div");
                picture.setAttribute("class", "picture");

                picture.innerHTML = 
                `
                    <img draggable="false" class="img-post" src="${URL.createObjectURL(file)}">
                    <div class="die-img" data-id="${salvos.length}">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                `

                picture.querySelector(".die-img").addEventListener("click", (event) => {
                    const indexToRemove = event.currentTarget.getAttribute("data-index");
                    salvos.splice(indexToRemove, 1); 
                    picture.remove(); 
                });

                local.appendChild(picture);
                salvos.push(file)
                post_files += 1;
            }   
        });
        if (erros.length > 0 ) {
            alert(`Arquivos com o formato incopativel: ${erros}`)
        }
    }
})
//
