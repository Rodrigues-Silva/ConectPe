const form = document.getElementById("ADDPost");

form.addEventListener("submit", (e)=>{
    e.preventDefault();

    console.log(input.files);

    const formData = new FormData(form);

    if (salvos.length > 0) {

        salvos.forEach((file, index) => {
            formData.append(`File[${index}]`, file);
        })

    }

    fetch(form.action, {
        method: "POST",
        body: formData
    })

    .then(response => response.text())
    .then(result => {
        alert("Postagem publicada com sucesso!");
        location.reload();
    })
    .catch(error => {
        console.error("Erro ao enviar o post:", error);
    });
})
//
const deletePost = document.getElementById("removePost");
const verify = document.getElementById("caixa")

deletePost.addEventListener("click", (e)=>{
    e.preventDefault();
    console.log("foi")
    if (verify.style.display == "none" || verify.style.display == "") {
        verify.style.display = "flex"

        const confirm = document.getElementById("confirm")
        const cancel = document.getElementById("cancel")

        cancel.addEventListener("click", ()=>{
            verify.style.display = "none"
        })

        confirm.addEventListener("click", ()=>{
            window.location.href = deletePost.href
        })
    } else {
        verify.style.display = "none"
    }


})