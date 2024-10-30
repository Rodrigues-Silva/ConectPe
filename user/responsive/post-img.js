const input = document.getElementById("input-File");
const local = document.getElementById("zone-img");

let salvos = []

input.addEventListener("input", () => {
    let files = Array.from(input.files);
    console.log(files);
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
                    <div class="die-img">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                `

                local.appendChild(picture);
                salvos.push(file)
                post_files += 1;
            }   
        });
        console.log(salvos)
        if (erros.length > 0 ) {
            alert(`Arquivos com o formato incopativel: ${erros}`)
        }
    }
})