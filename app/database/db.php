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