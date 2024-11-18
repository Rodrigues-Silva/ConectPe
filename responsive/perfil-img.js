const input = document.getElementById("perfilPic");
const perfil = document.getElementById("picPerfil");

input.addEventListener("input", ()=>{
    let file = Array.from(input.files);
    if (file.length == 1) {
        const formate = ["image/jpeg", "image/png", "image/jpg"];
        let erros = [];
        file.forEach(pic => {
            if (!formate.includes(pic.type) || pic.size > 2097152) {
                erros.push(pic.name);
            } else {
                perfil.src = URL.createObjectURL(pic)
            }
        })
        if (erros.length > 0) {
            alert(`Arquivos com o formato incompativel: ${erros}
As extenções compativeis são:
        image/jpg
        image/png`)
        }
    }
})