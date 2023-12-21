<?php
include('./config/connect_to_db.php');
include('./query.php');
include('./class/message.php');

// Lấy dữ liệu từ yêu cầu Ajax
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $msv = $_POST['msv'];
    
    if (isset($email) && isset($msv)) {
        $q = sqlSelect($conn, "*", "tbl_sinhvien", "`email` = '{$email}' AND `ma_sinhvien` = '{$msv}'");
        
        if ($q->rowCount() > 0) {
            // Đăng nhập thành công
            $res = new Message(true, 'Đăng nhập thành công', []);
        } else {
            // Đăng nhập không thành công
            $res = new Message(false, 'Email hoặc mật khẩu không đúng.', []);
        }
        echo json_encode($res);
    }
}
