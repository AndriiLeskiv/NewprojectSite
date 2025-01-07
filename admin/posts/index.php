<?php
    include_once "../include/header-admin.php";
    include_once "../../app/controllers/post.php";
?>

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
                <h2>Керування постами</h2>
                <div class="col-1">ID</div>
                <div class="col-3">Title</div>
                <div class="col-2">Author</div>
                <div class="col-6">Edit Post</div>
            </div>
            <?php foreach ($getAllPostsAdmin as $key => $post) {?>
                <div class="row post">
                    <div class="id col-1"><?=$key + 1?></div>
                    <div class="title col-3"><?=$post['title'];?></div>
                    <div class="author col-2"><?=$post['user_name'];?></div>
                    <div class="edit col-2">
                        <a href="edit.php?id=<?=$post['id'];?>">Change</a>
                    </div>
                    <div class="delete col-2">
                        <a href="edit.php?id_delete=<?=$post['id'];?>">Delete</a>
                    </div>
                    <div class="status col-2">
                        <?php if ($post['status']){?>
                            <a href="edit.php?publish=0&pub_id=<?=$post['id'];?>">Unpublish</a>
                        <?php }else{ ?>
                            <a href="edit.php?publish=1&pub_id=<?=$post['id'];?>">Publish</a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php include_once "../include/footer-admin.php"; ?>