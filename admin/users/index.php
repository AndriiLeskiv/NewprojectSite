<?php
    include_once "../include/header-admin.php";
    include_once "../../app/controllers/users.php";
?>

    <div class="container">
        <div class="row">
            <?php include_once "../include/sidebar-admin.php"?>
            <div class="post col-9">
                <div class="button row m-3">
                    <a href="<?php echo BASE_URL . 'admin/users/create.php'?>" class="col-3 btn btn-success">Add User</a>
                    <span class="col-1"></span>
                    <a href="<?php echo BASE_URL . 'admin/users/index.php'?>" class="col-3 btn btn-warning">Manage User</a>
                </div>
                <div class="row title-table">
                    <h2>Керування користувачами</h2>
                    <div class="col-1">ID</div>
                    <div class="col-2">Логін</div>
                    <div class="col-3">Email</div>
                    <div class="col-2">Роль</div>
                    <div class="col-4">Edit User</div>
                </div>
                <?php foreach ($getAllUsers as $user) {?>
                    <div class="row post">
                        <div class="id col-1"><?=$user['id'];?></div>
                        <div class="title col-2"><?=$user['user_name'];?></div>
                        <div class="email col-3"><?=$user['email'];?></div>
                        <div class="author col-2">
                            <?php if ($user['admin'] == 1){?>
                                Admin
                            <?php }else{ ?>
                                User
                            <?php } ?>
                        </div>
                        <div class="edit col-2">
                            <a href="edit.php?edit_id=<?=$user['id']?>">Edit</a>
                        </div>
                        <div class="delete col-2">
                            <a href="index.php?delete_id=<?=$user['id']?>">Delete</a>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>

<?php include_once "../include/footer-admin.php"; ?>