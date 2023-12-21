<?php
// Kết nối đến CSDL (sử dụng PDO)
include('./config/connect_to_db.php');
include('./class/message.php');
include('./query.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $res = new Message();
    $email = $_POST["email"];
    $oldPassword = $_POST["oldPassword"];
    $newPassword = $_POST["newPassword"];

    $q =  sqlSelect($conn, "*", "tbl_dangnhap", "`email`='$email' AND `password`='$oldPassword'");
    if ($q->rowCount() > 0) {
        // Tài khoản hợp lệ, thực hiện đổi mật khẩu
        $qUp = sqlUpdate($conn, "tbl_dangnhap", array(
            "password" => $newPassword
        ), "`email`='$email'");
        if ($qUp) {
            $res->set_state(true);
            $res->set_content("Đổi mật khẩu thành công.");
        } else {
            $res->set_state(false);
            $res->set_content("Đã xảy ra lỗi khi đổi mật khẩu.");
        }
    } else {
        $res->set_state(false);
        $res->set_content("Email hoặc mật khẩu không đúng.");
    }

    // Trả về kết quả cho Ajax
    echo json_encode($res);
}
