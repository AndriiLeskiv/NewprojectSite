<?php
    include_once "path.php";
    include_once "app/database/db.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/style.css'?>">
</head>
<body>
<header class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h1>
                    <a href="<?php echo BASE_URL ?>">My blog</a>
                </h1>
            </div>
            <nav class="col-8">
                <ul>
                    <li><a href="<?php echo BASE_URL ?>">Головна</a></li>
                    <li><a href="<?php echo BASE_URL . 'about.php'?>">Про нас</a></li>
                    <li><a href="#">Послуги</a></li>
                    <li>
                        <?php if (isset($_SESSION['id'])) { ?>
                            <a href="#"><i class="fa-solid fa-user"></i> <?=$_SESSION['login']?></a>
                            <ul>
                                <?php if($_SESSION['admin']) { ?>
                                    <li><a href="<?php echo BASE_URL . 'admin/users/index.php'; ?>">Admin</a></li>
                                <?php } ?>
                                <li><a href="<?php echo BASE_URL . 'logout.php'?>">Вихід</a></li>
                            </ul>
                        <?php } else { ?>
                            <a href="<?php echo BASE_URL . 'login.php'?>"><i class="fa-solid fa-user"></i> Кабінет</a>
                            <ul>
                                <li><a href="<?php echo BASE_URL . 'register.php'?>">Реєстрація</a></li>
                            </ul>
                        <?php } ?>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>