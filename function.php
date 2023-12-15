<?php


function find($conn, $table, $query, $data, $conditionName, $condition)
{
    $sql = "SELECT $query[0] FROM $table $conditionName[0] $condition[0];";
    $result = $conn->query($sql);
    return $result;
}


function update($conn, $table, $data, $conditionName, $condition)
{
    $sql = null;
    $set = [];

    // xử lý chuỗi
    foreach ($data as $key => $element) {
        if (is_string($key)) {
            array_push($set, "`" . $key . "`" . "=" . "'" . $element . "'");
        }
    }
    $set = implode(',', array_values($set));

    $sql = "UPDATE $table SET $set $conditionName[0] $condition[0]";
    $result = $conn->query($sql);
    return $result;
}

function insert($conn, $table, $data)
{
    $sql = null;
    $cloumn = [];
    $value = [];

    // xử lý chuỗi
    foreach ($data as $key => $element) {
        if (is_string($key)) {
            array_push($cloumn, "`" . $key . "`");
        }
        if (is_string($element)) {
            array_push($value, "'" . $element . "'");
        }
    }

    $cloumn = implode(',', array_values($cloumn));
    $value = implode(',', array_values($value));


    switch ($table) {
        case "tbl_diemhocphan":
            // `Mã sinh viên`, `Mã học phần`, `A`, `B`, `C`
            //  '{$msv}', '{$mhp}','{$a}','{$b}','{$c}'
            $sql = "INSERT INTO `tbl_diemhocphan` ($cloumn) VALUES ($value)";
            break;
    }
    // echo $sql;
    $result = $conn->query($sql);
    return $result;
}

function delete($conn, $table, $data)
{
    $msv = $data['delete_msv'];
    switch ($table) {
        case "tbl_diemhocphan":
            $sql = "DELETE FROM `tbl_diemhocphan` WHERE `Mã sinh viên` = $msv";
            break;
    }
    $result = $conn->query($sql);
    return $result->rowCount() > 0;
}
