<?php
    include_once "../include/header-admin.php";
    include_once "../../app/controllers/comment.php";
?>

<div class="container">
    <div class="row">
        <?php include_once "../include/sidebar-admin.php"?>
        <div class="post col-9">
            <div class="row title-table">
                <h2>Керування коментарями</h2>
                <div class="col-1">ID</div>
                <div class="col-3">Text</div>
                <div class="col-2">Author</div>
                <div class="col-6">Edit Comments</div>
            </div>
            <?php foreach ($commentsForAdmin as $key => $comment) {?>
                <div class="row post">
                    <div class="id col-1"><?=$comment['id'];?></div>
                    <div class="title col-3">
                        <?=strlen($comment['comment']) > 50 ? mb_substr($comment['comment'], 0, 50, 'UTF-8') . '...' : $comment['comment']; ?>
                    </div>
                    <div class="author col-2"><?=$comment['email'];?></div>
                    <div class="edit col-2">
                        <a href="edit.php?id=<?=$comment['id'];?>">Change</a>
                    </div>
                    <div class="delete col-2">
                        <a href="edit.php?id_delete=<?=$comment['id'];?>">Delete</a>
                    </div>
                    <div class="status col-2">
                        <?php if ($comment['status']){?>
                            <a href="edit.php?publish=0&pub_id=<?=$comment['id'];?>">Unpublish</a>
                        <?php }else{ ?>
                            <a href="edit.php?publish=1&pub_id=<?=$comment['id'];?>">Publish</a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php include_once "../include/footer-admin.php"; ?>