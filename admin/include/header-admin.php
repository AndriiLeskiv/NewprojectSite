<?php
    include_once "../../app/include/path.php";
    include_once "../../app/database/db.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My blog admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/admin.css'?>">
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
                    <li><a href="#"><i class="fa-solid fa-user"></i> <?=$_SESSION['login']?></a></li>
                    <li><a href="<?php echo BASE_URL . 'logout.php'?>">Вихід</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>