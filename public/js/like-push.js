document.addEventListener('DOMContentLoaded', function() {
    var likeButton = document.querySelector('#like-button'); 
    likeButton.addEventListener('click', function(event) {
        event.preventDefault(); 
        this.classList.toggle('text-red-500'); 
    });
});
