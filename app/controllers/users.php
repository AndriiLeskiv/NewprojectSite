<?php
include_once "app/database/db.php";

$errorMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin = 0;
    $login = trim($_POST["login"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $password2 = trim($_POST["password2"]);

    if ($login === '' || $email === '' || $password === ''){
        $errorMessage = 'Не усі поля заповнені!';
    }elseif(mb_strlen($login, 'UTF8') < 3){
        $errorMessage = 'Логін повинен бути більшим ніж 3 символи';
    }elseif($password !== $password2){
        $errorMessage = 'Паролі не співпадають!';
    }else{
        $exist = selectOne('users', ['email' => $email]);
        if ($exist && $exist['email'] === $email){
            $errorMessage = 'Користувач з такою поштоюю вже існує!';
        }else{
            $password = password_hash($password, PASSWORD_DEFAULT);
            $post =[
                "admin" => $admin,
                "user_name" => $login,
                "email" => $email,
                "password" => $password
            ];
            $id = insert('users', $post);
            $user = selectOne('users', ['id' => $id]);

            $_SESSION['id'] = $user['id'];
            $_SESSION['login'] = $user['user_name'];
            $_SESSION['admin'] = $user['admin'];

            if ($_SESSION['admin']){
                header('Location: ' .BASE_URL. 'admin/admin.php');
                exit();
            }
            header('Location: ' .BASE_URL);
        }
    }
}else{
    $login = '';
    $email = '';
}