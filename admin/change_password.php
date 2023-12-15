<?php
// Kết nối đến CSDL (sử dụng PDO)
include('../config/connect_to_db.php');
include('../class.php');
include('../function.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = new Info();
    $data = [
        "email" => $_POST["email"],
        "oldPassword" => $_POST["oldPassword"],
        "newPassword" => $_POST["newPassword"]
    ];
    $conditionName = [
        "0" => "WHERE"
    ];
    $condition = [
        "0" => "`email` = '{$data["email"]}' AND `password` = '{$data["oldPassword"]}'",
        "1" => "`password` = '{$data["newPassword"]}' WHERE `email` = '{$data["email"]}'"
    ];
    $q = find($conn, "tbl_dangnhap", "*", $data, $conditionName, $condition);
    $r = $q->fetch(PDO::FETCH_ASSOC);

    if ($r) {
        // Tài khoản hợp lệ, thực hiện đổi mật khẩu
        $qUp = update($conn, "tbl_dangnhap", ["password" => $data["newPassword"]], $conditionName, $condition);
        // $updateStmt = $conn->prepare("UPDATE tbl_dangnhap SET password = '{$newPassword}' WHERE email = '{$email}'");
        // $updateStmt->bindParam(":newPassword", $newPassword);
        // $updateStmt->bindParam(":email", $email);
        if ($qUp->rowCount() > 0) {
            $response->set_success(true);
            $response->set_message("Đổi mật khẩu thành công.");
        } else {
            $response->set_success(false);
            $response->set_message("Đã xảy ra lỗi khi đổi mật khẩu.");
        }
    } else {
        $response->set_success(false);
        $response->set_message("Email hoặc mật khẩu không đúng.");
    }

    // Trả về kết quả cho Ajax
    echo json_encode($response);
}
//admin@gmail.com 123456 1234567890