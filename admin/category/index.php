<?php
    include_once "../include/header-admin.php";
    include_once "../../app/controllers/category.php";
?>

    <div class="container">
        <div class="row">
            <?php include_once "../include/sidebar-admin.php"?>
            <div class="post col-9">
                <div class="button row m-3">
                    <a href="<?php echo BASE_URL . 'admin/category/create.php'?>" class="col-4 btn btn-success">Add Category</a>
                    <span class="col-1"></span>
                    <a href="<?php echo BASE_URL . 'admin/category/create.php'?>" class="col-4 btn btn-warning">Manage Category</a>
                </div>
                <div class="row title-table">
                    <h2>Керування категоріями</h2>
                    <div class="col-1">ID</div>
                    <div class="col-5">Title</div>
                    <div class="col-4">Edit Category</div>
                </div>
                <?php
                    foreach ($getAllCategory as $key => $category) {?>
                        <div class="row post">
                            <div class="id col-1"><?=$key + 1?></div>
                            <div class="title col-5"><?=$category['name']?></div>
                            <div class="edit col-2">
                                <a href="edit.php?id=<?=$category['id']?>">Change</a>
                            </div>
                            <div class="delete col-2">
                                <a href="edit.php?delete_id=<?=$category['id']?>">Delete</a>
                            </div>
                        </div>
                <?php }?>
            </div>
        </div>
    </div>

<?php include_once "../include/footer-admin.php"; ?>