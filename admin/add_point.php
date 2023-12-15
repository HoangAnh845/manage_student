<?php
// Kết nối đến CSDL
include('../config/connect_to_db.php');
include('../class.php');
include('../function.php');

// Lấy dữ liệu từ biểu mẫu gửi lên
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $msv = $_POST["add_msv"];
    $mhp = $_POST["add_mhp"];
    $a = $_POST["add_a"];
    $b = $_POST["add_b"];
    $c = $_POST["add_c"];
    $response = new Info();

    if (isset($msv) && isset($mhp) && isset($a) && isset($b) && isset($c)) {
        $data = [
            "Mã sinh viên" => $msv,
            "Mã học phần" => $mhp,
            "A" => $a,
            "B" => $b,
            "C" => $c
        ];
        // Trả về kết quả cho Ajax
        $q = insert($conn, "tbl_diemhocphan", $data);
        $r = $q->rowCount() > 0;
        if ($r) {
            $response->set_success(true);
            $response->set_message('Thêm dữ liệu thành công.');
            $response->set_msv($msv);
            $response->set_mhp($mhp);
            $response->set_a($a);
            $response->set_b($b);
            $response->set_c($c);
        } else {
            $response->set_success(false);
            $response->set_message('Đã xảy ra lỗi khi thêm dữ liệu. Vui lòng thử lại sau.');
        }
        echo json_encode($response);
        // Đóng kết nối đến CSDL
        include('../config/disconnect_from_db.php');
    }
}
