<?php include_once "../include/header-admin.php"; ?>

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
                    <div class="col-5">Логін</div>
                    <div class="col-2">Роль</div>
                    <div class="col-4">Edit User</div>
                </div>
                <div class="row post">
                    <div class="id col-1">1</div>
                    <div class="title col-5">Андрій</div>
                    <div class="author col-2">Admin</div>
                    <div class="edit col-2">
                        <a href="#">Change</a>
                    </div>
                    <div class="delete col-2">
                        <a href="#">Delete</a>
                    </div>
                </div>
                <div class="row post">
                    <div class="id col-1">1</div>
                    <div class="title col-5">Запис яка не будь</div>
                    <div class="author col-2">Admin</div>
                    <div class="edit col-2">
                        <a href="#">Change</a>
                    </div>
                    <div class="delete col-2">
                        <a href="#">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include_once "../include/footer-admin.php"; ?>