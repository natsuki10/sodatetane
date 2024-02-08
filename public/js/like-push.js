document.addEventListener('DOMContentLoaded', function() {
    var likeButton = document.queryALL('.like-button');
    likeButton.addEventListener('click', function() {
        this.classList.toggle('liked'); // 'liked'クラスがある場合はそれを削除し、ない場合は追加する処理
    });
});