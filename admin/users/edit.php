<?php
    include_once "../../app/controllers/users.php";
    include_once "../include/header-admin.php";
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
                    <h2>Додавання користувачів</h2>
                </div>
                <div class="row add-post">
                    <form action="edit.php" method="post">
                        <div class="mb-3 col-12 error">
                            <?php include_once "../../app/helps/errorInfo.php";?>
                        </div>
                        <input type="hidden" name="id" value="<?=$id;?>">
                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">Логін</label>
                            <input type="text" name="login" value="<?=$userName;?>" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder">
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" name="email" value="<?=$email;?>" class="form-control" id="exampleInputEmail1" disabled>
                        </div>
                        <div class="col">
                            <label for="exampleInputPassword1" class="form-label">Скинути пароль</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="col">
                            <label for="exampleInputPassword2" class="form-label">Повторіть пароль</label>
                            <input type="password" name="password2" class="form-control" id="exampleInputPassword2">
                        </div>
                        <select class="form-select" name="user_roll" aria-label="Select roll">
                            <option value="0" <?=(isset($admin) && $admin == 0) ? 'selected' : '' ?>>User</option>
                            <option value="1" <?=(isset($admin) && $admin == 1) ? 'selected' : '' ?>>Admin</option>
                        </select>
                        <div class="col">
                            <button class="btn btn-primary" type="submit" name="update-user">Update user</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include_once "../include/footer-admin.php"; ?>