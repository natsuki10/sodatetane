document.addEventListener('DOMContentLoaded', function() {
    var fileInput = document.getElementById('image');
    var dropArea = document.getElementById('drop-area');

    // ファイルのプレビュー表示のコード
    function displayImagePreview(file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var imgPreview = document.getElementById('image-preview');
            if (!imgPreview) {
                imgPreview = document.createElement('img');
                imgPreview.id = 'image-preview';
                imgPreview.style.maxWidth = '200px';
                imgPreview.style.maxHeight = '200px';
                dropArea.appendChild(imgPreview);
            }
            imgPreview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }

    fileInput.addEventListener('change', function(event) {
        var files = event.target.files;
        if (files.length > 0) {
            displayImagePreview(files[0]);
        }
    });

    dropArea.addEventListener('dragover', function(event) {
        event.preventDefault();
        event.stopPropagation();
        dropArea.classList.add('is-dragover');
    });

    dropArea.addEventListener('dragleave', function(event) {
        event.preventDefault();
        event.stopPropagation();
        dropArea.classList.remove('is-dragover');
    });

    dropArea.addEventListener('drop', function(event) {
        event.preventDefault();
        event.stopPropagation();
        dropArea.classList.remove('is-dragover');
        var files = event.dataTransfer.files;
        if (files.length > 0) {
            var dataTransfer = new DataTransfer();
            dataTransfer.items.add(files[0]);
            fileInput.files = dataTransfer.files;
            displayImagePreview(files[0]);
        }
    });

    var fileUploadLink = document.querySelector('.file-upload-link');
    if (fileUploadLink) {
        fileUploadLink.addEventListener('click', function() {
            document.getElementById('image').click();
        });
    }
});
