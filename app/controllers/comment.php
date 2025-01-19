<?php
$commentsForAdmin = selectAll('comments');

$page = isset($_GET['post']) ? $_GET['post'] : null;

$email = '';
$comment = '';
$errorMessage = [];
$commentsArray = [];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["goComment"])) {
    $email = trim($_POST["comment_email"]);
    $comment = trim(strip_tags($_POST["comment_text"]));

    if ($email === '' || $comment === ''){
        $errorMessage[] = "Не усі поля заповнені!";
    }elseif(mb_strlen($comment, 'UTF8') < 50){
        $errorMessage[] = "Коментар повинен бути більшим за 50 символів";
    }else{
        $user = selectOne("users", ['email' => $email]);
        if ($user && $user['email'] === $email && $user['admin'] === 1) {
            $status = 1;
        }else{
            $status = 0;
        }
        $comment =[
            "status" => $status,
            "page" => $page,
            "email" => $email,
            "comment" => $comment
        ];
        $comment = insert('comments', $comment);
        $comments = selectAll('comments', ['page' => $page, 'status' => 1]);
    }
}else{
    $email = '';
    $comment = '';
    $comments = selectAll('comments', ['page' => $page, 'status' => 1]);
}

//Delete comment
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id_delete"])) {
    $id = $_GET["id_delete"];
    delete('comments', $id);
    header('Location: ' . BASE_URL . 'admin/comments/index.php');
}

//Change comment status
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["pub_id"])) {
    $id = $_GET["pub_id"];
    $publish = $_GET["publish"];
    update('comments', $id, ['status' => $publish]);
    header('Location: ' . BASE_URL . 'admin/comments/index.php');
    exit();
}

//Update comment
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $getOneComment = selectOne('comments', ['id' => $id]);
    if ($getOneComment) {
        $id = $getOneComment['id'];
        $commentTitle = $getOneComment['email'];
        $description = $getOneComment['comment'];
        $status = $getOneComment['status'];
        $page = $getOneComment['page'];
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update-comment"])) {
    $id = $_POST["id"];
    $comment = trim(strip_tags($_POST["comment"]));
    $status = isset($_POST["status"]) ? 1 : 0;

    if ( $comment === ''){
        $errorMessage[] = "Не усі поля заповнені!";
    }elseif(mb_strlen($comment, 'UTF8') < 50){
        $errorMessage[] = "Коментар повинен бути більшим за 50 символів";
    }else{
        $comment =[
            "status" => $status,
            "comment" => $comment
        ];
        $comment = update('comments', $id, $comment);
        header('Location: ' . BASE_URL . 'admin/comments/index.php');
    }
}