<?php include_once "../../app/database/db.php";
include_once "../../root_path.php";

if (!$_SESSION){
    header('Location: ' . BASE_URL . 'login.php');
}

$errorMessage = [];
$id = '';
$postTitle = '';
$description = '';
$category = '';
$status = '';

$getAllCategory = selectAll('categories');
$getAllPostsAdmin = selectAllFromPostWithUser('posts', 'users');

//Created post
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add-post"])) {
    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
        $maxFileSize = 5 * 1024 * 1024; // 5 МБ
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileType = $_FILES["img"]["type"];
        $fileSize = $_FILES["img"]["size"];
        $fileError = $_FILES["img"]["error"];
        $imgName = time() . '_' . $_FILES["img"]["name"];
        $fileTempName = $_FILES["img"]["tmp_name"];
        $fileExtension = strtolower(pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION));
        $destination = ROOT_PATH . "\assets\img\posts\\" . $imgName;

        if(strpos($fileType, "image" ) === false){
            $errorMessage[] = "Потрібно завантажувати лише картинки";
            return;
        }
        if ($fileSize > $maxFileSize) {
            $errorMessage[] = "Розмір файлу перевищує допустимий (5 МБ).";
            return;
        }
        if (!in_array($fileExtension, $allowedExtensions)) {
            $errorMessage[] = "Дозволені лише файли з розширеннями: jpg, jpeg, png, gif.";
            return;
        }
        if ($fileError !== UPLOAD_ERR_OK) {
            $errorMessage[] = "Сталася помилка під час завантаження файлу.";
            return;
        }

        $result = move_uploaded_file($fileTempName, $destination);
        if ($result) {
            $_POST["img"] = $imgName;
        }else{
            $errorMessage[] = "Картинка не завантажилася на сервер!";
        }
    }else{
        $errorMessage[] = "Не вдалося отримати картинку!";
    }

    $postTitle = trim($_POST["title"]);
    $description = trim(strip_tags($_POST["editor"]));
    $category = trim($_POST["category"]);
    $status = isset($_POST["status"]) ? 1 : 0;

    if ($postTitle === '' || $description === '' || $category === ''){
        $errorMessage[] = "Не усі поля заповнені!";
    }elseif(mb_strlen($postTitle, 'UTF8') < 7){
        $errorMessage[] = "Назва поста повинна бути більшою ніж 7 символів";
    }else{
        $post =[
            "id_user" => $_SESSION["id"],
            "title" => $postTitle,
            "img" => $_POST["img"],
            "content" => $description,
            "status" => $status,
            "category_id" => $category,
        ];
        $id = insert('posts', $post);
        $category = selectOne('posts', ['id' => $id]);
        header('Location: ' . BASE_URL . 'admin/posts/index.php');
    }
}else{
    $id = '';
    $postTitle = '';
    $description = '';
    $category = '';
    $status = '';
}

//Update post
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $getOnePost = selectOne('posts', ['id' => $id]);
    if ($getOnePost) {
        $id = $getOnePost['id'];
        $postTitle = $getOnePost['title'];
        $description = $getOnePost['content'];
        $category = $getOnePost['category_id'];
        $status = $getOnePost['status'];
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update-post"])) {
    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
        $maxFileSize = 5 * 1024 * 1024; // 5 МБ
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileType = $_FILES["img"]["type"];
        $fileSize = $_FILES["img"]["size"];
        $fileError = $_FILES["img"]["error"];
        $imgName = time() . '_' . $_FILES["img"]["name"];
        $fileTempName = $_FILES["img"]["tmp_name"];
        $fileExtension = strtolower(pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION));
        $destination = ROOT_PATH . "\assets\img\posts\\" . $imgName;

        if(strpos($fileType, "image" ) === false){
            $errorMessage[] = "Потрібно завантажувати лише картинки";
            return;
        }
        if ($fileSize > $maxFileSize) {
            $errorMessage[] = "Розмір файлу перевищує допустимий (5 МБ).";
            return;
        }
        if (!in_array($fileExtension, $allowedExtensions)) {
            $errorMessage[] = "Дозволені лише файли з розширеннями: jpg, jpeg, png, gif.";
            return;
        }
        if ($fileError !== UPLOAD_ERR_OK) {
            $errorMessage[] = "Сталася помилка під час завантаження файлу.";
            return;
        }

        $result = move_uploaded_file($fileTempName, $destination);
        if ($result) {
            $_POST["img"] = $imgName;
        }else{
            $errorMessage[] = "Картинка не завантажилася на сервер!";
        }
    }else{
        $errorMessage[] = "Не вдалося отримати картинку!";
    }
    $postTitle = trim($_POST["title"]);
    $description = trim(strip_tags($_POST["editor"]));
    $category = trim($_POST["category"]);
    $status = isset($_POST["status"]) ? 1 : 0;

    if ($postTitle === '' || $description === '' || $category === ''){
        $errorMessage[] = "Не усі поля заповнені!";
    }elseif(mb_strlen($postTitle, 'UTF8') < 7){
        $errorMessage[] = "Назва поста повинна бути більшою ніж 7 символів";
    }else{
        $postUpdate =[
            "id_user" => $_SESSION["id"],
            "title" => $postTitle,
            "img" => $_POST["img"],
            "content" => $description,
            "status" => $status,
            "category_id" => $category,
        ];
        $id = $_POST['id'];
        $post_id = update('posts', $id, $postUpdate);
        header('Location: ' . BASE_URL . 'admin/posts/index.php');
    }
}

//Delete post
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id_delete"])) {
    $id = $_GET["id_delete"];
    delete('posts', $id);
    header('Location: ' . BASE_URL . 'admin/posts/index.php');
}

//Change post status
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["pub_id"])) {
    $id = $_GET["pub_id"];
    $publish = $_GET["publish"];
    update('posts', $id, ['status' => $publish]);
    header('Location: ' . BASE_URL . 'admin/posts/index.php');
    exit();
}