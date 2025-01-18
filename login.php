<?php
    include_once "app/include/header.php";
    include_once "app/controllers/users.php";
?>

<div class="container reg_form">
    <form class="row justify-content-center" method="post" action="login.php">
        <h2 class="col-12">Форма авторизації</h2>
        <div class="mb-3 col-12 col-md-4 error">
            <?php include_once "app/helps/errorInfo.php";?>
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="formGroupExampleInput" class="form-label">Email</label>
            <input type="email" name="email" value="<?=$email?>" class="form-control" id="formGroupExampleInput" aria-describedby="emailHelp" placeholder="Example input placeholder">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <button type="submit" name="btn-login" class="btn btn-secondary">Увійти</button>
            <a href="<?php echo BASE_URL . 'register.php'?>">Рєстрація</a>
        </div>
    </form>
</div>

<?php include_once "app/include/footer.php"; ?>
