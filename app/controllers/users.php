<?php
include_once "app/database/db.php";

if(isset($_POST["submit"])){
    $admin = 0;
    $login = $_POST["login"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $post =[
        "admin" => $admin,
        "user_name" => $login,
        "email" => $email,
        "password" => $password
    ];

    $id = insert('users', $post);
    $last_row = selectOne('users', [ "id" => $id]);
}