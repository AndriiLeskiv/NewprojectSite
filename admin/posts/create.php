<?php
    include_once "../include/header-admin.php";
    include_once "../../app/controllers/post.php";
?>
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.css">
    <div class="container">
        <div class="row">
            <?php include_once "../include/sidebar-admin.php"?>
            <div class="post col-9">
                <div class="button row m-3">
                    <a href="<?php echo BASE_URL . 'admin/posts/create.php'?>" class="col-3 btn btn-success">Add Post</a>
                    <span class="col-1"></span>
                    <a href="<?php echo BASE_URL . 'admin/posts/index.php'?>" class="col-3 btn btn-warning">Manage Posts</a>
                </div>
                <div class="row title-table">
                    <h2>Додавання постів</h2>
                </div>
                <div class="row add-post">
                    <form action="create.php" method="post">
                        <div class="mb-3 col-12 error">
                            <p><?=$errorMessage?></p>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" value="<?=$postTitle?>" name="title" id="title" placeholder="Заголовок поста" aria-label="Заголовок поста">
                        </div>
                        <div class="col notThis">
                            <label for="editor" class="form-label">Вміст поста</label>
                            <textarea class="form-control" name="editor" id="editor" rows="3"><?=$description?></textarea>
                        </div>
                        <div class="input-group col">
                            <input type="file" name="img" class="form-control" id="inputGroupFile02">
                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                        </div>
                        <select class="form-select" name="category" aria-label="Select category">
                            <option selected>Категорія поста:</option>
                           <?php foreach ($getAllCategory as $key => $category) {?>
                               <option value="<?=$category['id']?>"><?=$category['name']?></option>
                           <?php } ?>
                        </select>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="status" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Publish
                            </label>
                        </div>
                        <div class="col">
                            <button class="btn btn-primary" type="submit" name="add-post">Add post</button>
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