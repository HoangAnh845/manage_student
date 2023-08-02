<?php
// Kết nối đến CSDL
include('connect_to_db.php');

// Lấy dữ liệu từ yêu cầu Ajax
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    echo $email;
    echo $password;

    // Kiểm tra định dạng email
    // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     $response['success'] = false;
    //     $response['message'] = "Vui lòng nhập đúng định dạng email.";
    //     echo json_encode($response);
    //     exit;
    // }

    // Câu truy vấn SQL để kiểm tra tên người dùng và mật khẩu
    // $sql = "SELECT * FROM `tbl_dangnhap` WHERE email = :email AND password = :password";
    $sql = "SELECT * FROM `tbl_dangnhap` WHERE email = '{$email}' AND password = '{$password}'";

    // Chuẩn bị câu truy vấn SQL
    $sqlreq = $conn->prepare($sql);

    // Ràng buộc giá trị vào các tham số trong câu truy vấn
    // $sqlreq->bindParam(':email', $email);
    // $sqlreq->bindParam(':password', $password);

    // Thực thi câu truy vấn SQL
    $sqlreq->execute();

    // Trả về kết quả cho AJAX
    // $response = array();
    // Kiểm tra xem có dòng nào trả về từ câu truy vấn hay không
    if ($sqlreq->rowCount() > 0) {
        // Đăng nhập thành công
        $response['success'] = true;
        $response['message'] = "Đăng nhập thành công.";
    } else {
        // Đăng nhập không thành công
        $response['success'] = false;
        $response['message'] = "Email hoặc mật khẩu không đúng.";
    }

    echo json_encode($response);
}
