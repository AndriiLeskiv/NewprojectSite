<?php
    include_once "../include/header-admin.php";
    include_once "../../app/controllers/category.php"
?>

    <div class="container">
        <div class="row">
            <?php include_once "../include/sidebar-admin.php"?>
            <div class="post col-9">
                <div class="button row m-3">
                    <a href="<?php echo BASE_URL . 'admin/category/create.php'?>" class="col-4 btn btn-success">Add Category</a>
                    <span class="col-1"></span>
                    <a href="<?php echo BASE_URL . 'admin/category/index.php'?>" class="col-4 btn btn-warning">Manage Category</a>
                </div>
                <div class="row title-table">
                    <h2>Додавання категорії</h2>
                </div>
                <div class="row add-post">
                    <form action="create.php" method="post">
                        <div class="mb-3 col-12 error">
                            <p><?=$errorMessage?></p>
                        </div>
                        <div class="col">
                            <input type="text" value="<?=$nameCategory?>" class="form-control" name="nameCategory" id="title" placeholder="Заголовок категорії" aria-label="Заголовок категорії">
                        </div>
                        <div class="col">
                            <label for="textarea" class="form-label">Опис категорії</label>
                            <textarea class="form-control" name="textarea" id="textarea" rows="3"><?=$textarea?></textarea>
                        </div>
                        <div class="col">
                            <button class="btn btn-primary" type="submit" name="add-category">Add category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include_once "../include/footer-admin.php"; ?>