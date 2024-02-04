document.addEventListener('DOMContentLoaded', function() {
    var likeButton = document.querySelector('.like-button');
    likeButton.addEventListener('click', function() {
        this.classList.toggle('liked');
    });
});