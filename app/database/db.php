<?php
require "connect.php";

function tt($value){
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}

// перевірка виконання запиту
function dbCheckError($query){
    $errors = $query->errorInfo();
    if($errors[0] !==PDO::ERR_NONE){
        echo $errors[2];
        exit();
    }
    return true;
}

// Запит на отримання даниз з однієї таблиці
function selectAll($table, $params =[]) {
    global $connect;
    $sql = "SELECT * FROM $table";

    if(!empty($params)){
        $i = 0;
        foreach($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'".$value."'";
            }
            if($i === 0){
                $sql .= " WHERE $key = $value";
            }else{
                $sql .= " AND $key = $value";
            }
            $i++;
        }
    }

    $query = $connect->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

// Запит на отримання одного результату з вибраної таблиці
function selectOne($table, $params =[]) {
    global $connect;
    $sql = "SELECT * FROM $table";

    if(!empty($params)){
        $i = 0;
        foreach($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'".$value."'";
            }
            if($i === 0){
                $sql .= " WHERE $key = $value";
            }else{
                $sql .= " AND $key = $value";
            }
            $i++;
        }
    }

    $query = $connect->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
}

// Додавання даних в табличку
function insert($table, $data) {
    global $connect;
    $i=0;
    $coll = '';
    $mask = '';
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $coll .= "$key";
            $mask .= "'" . $value . "'";
        }else{
            $coll .= ", $key";
            $mask .= ", '".$value . "'" ;
        }
        $i++;
    }

    $sql = "INSERT INTO $table ($coll) VALUES ($mask)";

    try {
        $query = $connect->prepare($sql);
        $query->execute();
        dbCheckError($query);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$data = [
    "admin" => "0",
    "user_name" => "Andrii",
    "email" => "test@email.com",
    "password" => "24557x"
];
insert('users', $data);