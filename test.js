function toggleComments() {
    const commentsSection = document.getElementById("comments")

    if (commentsSection.style.display == "none" || commentsSection.style.display == "") {
        commentsSection.style.display = "block";
    } else {
        commentsSection.style.display = "none";
    }
}