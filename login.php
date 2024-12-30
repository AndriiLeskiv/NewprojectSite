<?php include_once "header.php"; ?>

<div class="container reg_form">
    <form class="row justify-content-center" method="post" action="login.php">
        <h2 class="col-12">Форма авторизації</h2>
        <div class="mb-3 col-12 col-md-4">
            <label for="formGroupExampleInput" class="form-label">Логін</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <button type="submit" class="btn btn-secondary">Увійти</button>
            <a href="login.php">Рєстрація</a>
        </div>
    </form>
</div>

<?php include_once "footer.php"; ?>