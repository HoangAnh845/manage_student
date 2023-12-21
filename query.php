<?php


function sqlSelect($conn, $columns, $table, $condition)
{

    $sql = "SELECT " . $columns . " FROM `" . $table . "` WHERE " . $condition;
    $result = $conn->query($sql);
    return $result;
}

function sqlInsert($conn, $table, $data)
{
    $cols = [];
    $values = [];
    foreach ($data as $key => $elemnt) {
        array_push($cols, $key);
        array_push($values, "'" . $elemnt . "'");
    };
    $sql = "INSERT INTO `" . $table . "` (" . implode(",",$cols) . ") VALUES (" . implode(",",$values) . ")";
    $result = $conn->query($sql);
    return $result;
}

function sqlUpdate($conn, $table, $data, $id)
{
    $setColumn = array();
    foreach ($data as $key => $value) {
        $setColumn[] = "`{$key}` = '{$value}'";
    }
    $sql = "UPDATE {$table} SET " . implode(', ', $setColumn) . " WHERE $id";
    $result = $conn->query($sql);
    return $result;
}

function sqlDelete($conn, $table, $msv)
{
    $sql = "DELETE FROM $table WHERE `ma_sinhvien` = '$msv'";
    $result = $conn->query($sql);
    return $result;
}
