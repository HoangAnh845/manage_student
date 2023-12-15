<?php
include('./config/connect_to_db.php');
include('./function.php');
include('./class.php');

// Lấy dữ liệu từ yêu cầu Ajax
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = new Info();

    $query = [
        "0" => "*"
    ];
    $data = [
        "email" => $_POST['email'],
        "password" => $_POST['password']
    ];
    $conditionName = [
        "0" => "WHERE"
    ];
    $condition = [
        "0" => "email = '{$data["email"]}' AND password = '{$data["password"]}'",
    ];
    // Câu truy vấn SQL để lấy dữ liệu từ bảng
    $q = find($conn, "tbl_dangnhap", $query, $data, $conditionName, $condition);

    // Kiểm tra xem có dòng nào trả về từ câu truy vấn hay không
    if (isset($q) > 0) {
        // Đăng nhập thành công
        $response->set_success(true);
        $response->set_message("Đăng nhập thành công.");
    } else {
        // Đăng nhập không thành công
        $response->set_success(false);
        $response->set_message("Email hoặc mật khẩu không đúng.");
    }

    echo json_encode($response); // chuyển giá trị sang định dạng JSON
}
