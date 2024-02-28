document.addEventListener('DOMContentLoaded', function() {
    var fileInput = document.getElementById('image');
    var dropArea = document.getElementById('drop-area');
    var fileUploadButton = document.getElementById('file-upload-button'); // 「選択」ボタンのID

    // ファイルのプレビュー表示の関数
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

    // ファイルが選択されたときのイベント
    fileInput.addEventListener('change', function(event) {
        var files = event.target.files;
        if (files.length > 0) {
            displayImagePreview(files[0]);
        }
    });

    // ドラッグ&ドロップイベント
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

    // 「選択」ボタンのイベント
    if (fileUploadButton) {
        fileUploadButton.addEventListener('click', function(e) {
            console.log('File upload button clicked');
            e.preventDefault(); // フォーム送信を防ぐ
            e.stopPropagation(); // イベントの伝播を停止
            fileInput.click(); // ファイル選択ダイアログを開く
        });
    }
});
