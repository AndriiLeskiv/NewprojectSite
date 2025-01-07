<?php include_once "app/database/db.php";

$errorMessage = [];

// Реєстрація юзера
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btn-register"])) {
    $admin = 0;
    $login = trim($_POST["login"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $password2 = trim($_POST["password2"]);

    if ($login === '' || $email === '' || $password === ''){
        $errorMessage[] = 'Не усі поля заповнені!';
    }elseif(mb_strlen($login, 'UTF8') < 3){
        $errorMessage[] = 'Логін повинен бути більшим ніж 3 символи';
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage[] = 'Некоректний email!';
    }elseif ($password !== $password2){
        $errorMessage[] = 'Паролі не співпадають!';
    }elseif (strlen($password) < 6) {
        $errorMessage[] = 'Пароль повинен містити щонайменше 6 символів!';
    }else{
        $exist = selectOne('users', ['email' => $email]);
        if ($exist && $exist['email'] === $email){
            $errorMessage[] = 'Користувач з такою поштоюю вже існує!';
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
            userAuthorization($user);
        }
    }
}else{
    $login = '';
    $email = '';
}

// Авторизація юзера
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btn-login"])) {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if ($email === '' || $password === '') {
        $errorMessage[] = 'Не усі поля заповнені!';
        return;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage[] = 'Некоректний email!';
        return;
    }

    $existUser = selectOne('users', ['email' => $email]);
    if ($existUser){
        if(password_verify($password, $existUser['password'])){
            userAuthorization($existUser);
        }else{
            $errorMessage[] = 'Пароль введено не правильно!';
        }
    } else {
        $errorMessage[] = 'Користувача з такою поштоюю не знайдено!';
    }
}else{
    $email = '';
}

function userAuthorization($dataArray){
    $_SESSION['id'] = $dataArray['id'];
    $_SESSION['login'] = $dataArray['user_name'];
    $_SESSION['admin'] = $dataArray['admin'];

    if ($_SESSION['admin']){
        header('Location: ' .BASE_URL. 'admin/posts/index.php');
    }else{
        header('Location: ' .BASE_URL);
    }
}