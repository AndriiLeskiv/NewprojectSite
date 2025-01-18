<?php
session_start();
require "connect.php";

function tt($value){
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}

// check the request execution
function dbCheckError($query){
    $errors = $query->errorInfo();
    if($errors[0] !==PDO::ERR_NONE){
        echo $errors[2];
        exit();
    }
    return true;
}

// Request to retrieve data from one table
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

// Query to get one result from the selected table
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

// Adding data to the table
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
        return $connect->lastInsertId();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Updated data to the table
function update($table, $id, $data) {
    global $connect;
    $i=0;
    $str = '';
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $str .= $key . " = '" . $value . "'";
        }else{
            $str .= ", " .$key ." = '".$value . "'" ;
        }
        $i++;
    }

    $sql = "UPDATE $table SET $str WHERE id = $id";
    try {
        $query = $connect->prepare($sql);
        $query->execute();
        dbCheckError($query);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Delete data to the table
function delete($table, $id) {
    global $connect;
    $sql = "DELETE FROM $table WHERE id = $id";

    try {
        $query = $connect->prepare($sql);
        $query->execute();
        dbCheckError($query);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

//Join post with user
function selectAllFromPostWithUser($table1, $table2){
    global $connect;
    $sql = "SELECT
    t1.*,
    t2.user_name,
    t2.email
    FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user = t2.id";
    try {
        $query = $connect->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetchAll();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

//Join post with user(index.php)
function selectAllPostAndUser($table1, $table2, $limit, $offset){
    global $connect;
    $sql = "SELECT
    p.*,
    u.user_name
    FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.status = 1 LIMIT $limit OFFSET $offset";
    try {
        $query = $connect->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetchAll();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

//Join post with user(index.php)
function selectTopPost($table){
    global $connect;
    $sql = "SELECT * FROM $table WHERE category_id = 8";
    try {
        $query = $connect->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetchAll();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Search posts
function searchAllPost($text, $table1, $table2){
    $text = trim(strip_tags(stripcslashes(htmlspecialchars($text))));

    global $connect;
    $sql = "SELECT
        p.*,
        u.user_name
        FROM $table1 AS p 
        JOIN $table2 AS u 
        ON p.id_user = u.id 
        WHERE p.status = 1
        AND p.title LIKE '%$text%' OR p.content LIKE '%$text%'";
    try {
        $query = $connect->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetchAll();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Single page query
function selectSinglePost($postIs, $table1, $table2){
    global $connect;
    $sql = "SELECT
    p.*,
    u.user_name
    FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.id = $postIs";
    try {
        $query = $connect->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetch();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Request to retrieve data from one table
function selectAllCategoryPost($table, $table2, $params =[]) {
    global $connect;
    $sql = "SELECT p.*,
        u.user_name
        FROM $table AS p JOIN $table2 AS u ON p.id_user = u.id";

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

function countRow($table){
    global $connect;
    $sql = "SELECT count(*) FROM $table WHERE status = 1";
    try {
        $query = $connect->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetchColumn();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}