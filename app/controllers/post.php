<?php include_once "../../app/database/db.php";

$errorMessage = "";

$id = '';
$postTitle = '';
$description = '';
$category = '';
$img = '';

$getAllCategory = selectAll('categories');
$getAllPostsAdmin = selectAllFromPostWithUser('posts', 'users');
tt($getAllPostsAdmin);

//Created post
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add-post"])) {
    $postTitle = trim($_POST["title"]);
    $description = trim(strip_tags($_POST["editor"]));
    $img = trim($_POST["img"]);
    $category = trim($_POST["category"]);
    $status = isset($_POST["status"]) ? 1 : 0;

    if ($postTitle === '' || $description === '' || $category === ''){
        $errorMessage = 'Не усі поля заповнені!';
    }elseif(mb_strlen($postTitle, 'UTF8') < 7){
        $errorMessage = 'Назва поста повинна бути більшою ніж 7 символів';
    }else{
        $post =[
            "id_user" => $_SESSION["id"],
            "title" => $postTitle,
            "img" => $img,
            "content" => $description,
            "status" => $status,
            "category_id" => $category,
        ];
        $id = insert('posts', $post);
        $category = selectOne('posts', ['id' => $id]);
        header('Location: ' . BASE_URL . 'admin/posts/index.php');
    }
}else{
    $postTitle = '';
    $description = '';
}

//Update category
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $getOneCategory = selectOne('categories', ['id' => $id]);
    if ($getOneCategory) {
        $id = $getOneCategory['id'];
        $nameCategory = $getOneCategory['name'];
        $textarea = $getOneCategory['description'];
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["edit-category"])) {
    $nameCategory = trim($_POST["nameCategory"]);
    $textarea = trim($_POST["textarea"]);

    if ($nameCategory === '' || $textarea === ''){
        $errorMessage = 'Не усі поля заповнені!';
    }elseif(mb_strlen($nameCategory, 'UTF8') < 3){
        $errorMessage = 'Назва категорії повинна бути більшою ніж 3 символи';
    }else{
        $categoryUpdate =[
            "name" => $nameCategory,
            "description" => $textarea
        ];
        $id = $_POST['id'];
        $category_id = update('categories', $id, $categoryUpdate);
        header('Location: ' . BASE_URL . 'admin/category/index.php');
    }
}

//Delete category
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["delete_id"])) {
    $id = $_GET["delete_id"];
    delete('categories', $id);
    header('Location: ' . BASE_URL . 'admin/category/index.php');
}