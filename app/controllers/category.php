<?php include_once "../../app/database/db.php";

$errorMessage = "";

$id = '';
$nameCategory = '';
$textarea = '';

$getAllCategory = selectAll('categories');

//Created category
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add-category"])) {
    $nameCategory = trim($_POST["nameCategory"]);
    $textarea = trim($_POST["textarea"]);

    if ($nameCategory === '' || $textarea === ''){
        $errorMessage = 'Не усі поля заповнені!';
    }elseif(mb_strlen($nameCategory, 'UTF8') < 2){
        $errorMessage = 'Назва категорії повинна бути більшою ніж 2 символи';
    }else{
        $exist = selectOne('categories', ['name' => $nameCategory]);
        if ($exist && $exist['name'] === $nameCategory){
            $errorMessage = 'Категорія з таким іменем вже існує!';
        }else{
            $category =[
                "name" => $nameCategory,
                "description" => $textarea
            ];
            $id = insert('categories', $category);
            $category = selectOne('categories', ['id' => $id]);
            header('Location: ' . BASE_URL . 'admin/category/index.php');
        }
    }
}else{
    $nameCategory = '';
    $textarea = '';
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