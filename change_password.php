<?php
// Kết nối đến CSDL (sử dụng PDO)
include('connect_to_db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ biểu mẫu gửi lên
    $email = $_POST["email"];
    $oldPassword = $_POST["oldPassword"];
    $newPassword = $_POST["newPassword"];

    // Kiểm tra đúng sai của tài khoản và đổi mật khẩu nếu thông tin chính xác
    $stmt = $conn->prepare("SELECT * FROM tbl_dangnhap WHERE email = '{$email}' AND password = '{$oldPassword}'");
    // $stmt = $conn->prepare("SELECT * FROM tbl_dangnhap WHERE email = :email AND password = :password");
    // $stmt->bindParam(":email", $email);
    // $stmt->bindParam(":password", $oldPassword);
    $stmt->execute();

    $response = array();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        // Tài khoản hợp lệ, thực hiện đổi mật khẩu
        $updateStmt = $conn->prepare("UPDATE tbl_dangnhap SET password = '{$newPassword}' WHERE email = '{$email}' ");
        // $updateStmt->bindParam(":newPassword", $newPassword);
        // $updateStmt->bindParam(":email", $email);
        if ($updateStmt->execute()) {
            $response["success"] = true;
            $response["message"] = "Đổi mật khẩu thành công.";
        } else {
            $response["success"] = false;
            $response["message"] = "Đã xảy ra lỗi khi đổi mật khẩu.";
        }
    } else {
        $response["success"] = false;
        $response["message"] = "Email hoặc mật khẩu không đúng.";
    }

    // Trả về kết quả cho Ajax
    echo json_encode($response);
}
//admin@gmail.com 123456 1234567890