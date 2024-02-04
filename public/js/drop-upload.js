document.addEventListener('DOMContentLoaded', function() {
    var dropArea = document.getElementById('drop-area');

    // 'dragover' イベントのデフォルト動作をキャンセルし、ドラッグ中のスタイルを適用
    dropArea.addEventListener('dragover', function(event) {
        event.preventDefault();
        event.stopPropagation(); // バブリングを防ぐ
        dropArea.classList.add('is-dragover');
    });

    // 'dragleave' イベントでドラッグ中のスタイルを解除
    dropArea.addEventListener('dragleave', function(event) {
        event.preventDefault();
        event.stopPropagation(); // バブリングを防ぐ
        dropArea.classList.remove('is-dragover');
    });

    // 'drop' イベントのデフォルト動作をキャンセルし、ファイルを処理し、ドラッグ中のスタイルを解除
    dropArea.addEventListener('drop', function(event) {
        event.preventDefault();
        event.stopPropagation(); // バブリングを防ぐ
        dropArea.classList.remove('is-dragover'); // ドラッグ中のスタイルを解除

        // プレビューを表示する
        var reader = new FileReader();
        reader.onload = function(e) {
            // プレビュー用の要素が存在するか確認し、なければ作成する
            var imgPreview = document.getElementById('image-preview');
            if (!imgPreview) {
                imgPreview = document.createElement('img');
                imgPreview.id = 'image-preview';
                imgPreview.style.maxWidth = '200px'; // プレビュー画像の最大幅を設定
                imgPreview.style.maxHeight = '200px'; // プレビュー画像の最大高さを設定
                dropArea.appendChild(imgPreview); // ドロップエリア内にプレビュー画像を追加
            }
            imgPreview.src = e.target.result;
        };
        reader.readAsDataURL(event.dataTransfer.files[0]); // 最初にドロップされたファイルのデータURLを読み込む
    });

    // 「選択」リンクをクリックしたときにファイル選択ダイアログを表示
    var fileUploadLink = document.querySelector('.file-upload-link');
    if (fileUploadLink) {
        fileUploadLink.addEventListener('click', function() {
            document.getElementById('image').click();
        });
    }
});
