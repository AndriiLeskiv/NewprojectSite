<?php
    include_once "app/include/header.php";
    include_once "app/controllers/users.php";
?>

<div class="container reg_form">
    <form class="row justify-content-center" method="post" action="register.php">
        <h2>Форма реєстрації</h2>
        <div class="mb-3 col-12 col-md-4 error">
            <?php include_once "app/helps/errorInfo.php";?>
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="formGroupExampleInput" class="form-label">Логін</label>
            <input type="text" name="login" value="<?=$login?>" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" name="email" value="<?=$email?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="exampleInputPassword2" class="form-label">Повторіть пароль</label>
            <input type="password" name="password2" class="form-control" id="exampleInputPassword2">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <button type="submit" name="btn-register" class="btn btn-secondary">Реєстрація</button>
            <a href="<?php echo BASE_URL . 'login.php'?>">Логін</a>
        </div>
    </form>
</div>

<?php include_once "app/include/footer.php"; ?>