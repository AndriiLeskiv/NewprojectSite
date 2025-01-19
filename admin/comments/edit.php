<?php
    include_once "../include/header-admin.php";
    include_once "../../app/controllers/comment.php";
?>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.css">
    <div class="container">
        <div class="row">
            <?php include_once "../include/sidebar-admin.php"?>
            <div class="post col-9">
                <div class="row title-table">
                    <h2>Редагування коментаря</h2>
                </div>
                <div class="row add-post">
                    <form action="edit.php" method="post">
                        <div class="mb-3 col-12 error">
                            <?php include_once "../../app/helps/errorInfo.php";?>
                        </div>
                        <input type="hidden" name="id" value="<?=$id;?>">
                        <div class="col">
                            <input type="email" class="form-control" disabled value="<?=$commentTitle;?>" name="email" id="email" placeholder="Заголовок поста" aria-label="Заголовок поста">
                        </div>
                        <div class="col notThis">
                            <label for="comment" class="form-label">Вміст поста</label>
                            <textarea class="form-control" name="comment" id="comment" rows="3"><?=$description;?></textarea>
                        </div>
                        <div class="form-check">
                            <?php if (empty($status) && $status == 0){?>
                                <input class="form-check-input" type="checkbox" name="status" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Publish
                                </label>
                            <?php } else { ?>
                                <input class="form-check-input" type="checkbox" name="status" id="flexCheckDefault" checked>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Publish
                                </label>
                            <?php } ?>
                        </div>
                        <div class="col">
                            <button class="btn btn-primary" type="submit" name="update-comment">Update comments</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.umd.js"></script>
    <script>
        const {
            ClassicEditor,
            Essentials,
            Paragraph,
            Bold,
            Italic,
            Font
        } = CKEDITOR;
        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3Njc0ODQ3OTksImp0aSI6IjBiMjY1MDJjLTNmZWMtNGFiOS04MzAwLWRjYTEwN2ExYjJhOCIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiXSwiZmVhdHVyZXMiOlsiRFJVUCJdLCJ2YyI6IjU2N2IwZTBkIn0.35z6RUYBaHABEDW-KKprCA_HSHv-DSsQ91-Ye5gSWFOXUfALB23IUFGHyn0s6yG3CO1DSKULoAc02ahwDZcrjQ',
                plugins: [ Essentials, Paragraph, Bold, Italic, Font ],
                toolbar: [
                    'undo', 'redo', '|', 'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                ]
            } )
            .then( editor => {
                window.editor = editor;
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
<?php include_once "../include/footer-admin.php"; ?>