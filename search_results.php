<?php
include('./config/connect_to_db.php');
include('./query.php');
include('./class/message.php');

// Lấy dữ liệu từ biểu mẫu AJAX
// REQUEST_METHOD: trả về phương thức truy vấn
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $msv = $_POST['ma_sinhvien'];
    $mhp = $_POST['ma_hocphan'];
    // Kiểm tra xem người dùng đã gửi yêu cầu tìm kiếm chưa
    if (isset($msv) || isset($mhp)) {
        $q = $mhp ? sqlSelect($conn, "*", "tbl_diemhocphan", "`ma_sinhvien` = '{$msv}' AND `ma_hocphan` = '{$mhp}'") :
            sqlSelect($conn, "*", "tbl_diemhocphan", "`ma_sinhvien` = '{$msv}'");
        $r = $q->fetch(PDO::FETCH_ASSOC);

        if ($r) {
            $res = new Message(true, "Tìm thấy kết quả mã sinh viên", $r);
        } else {
            $res = new Message(false, "Không tìm thấy kết quả cho Mã sinh viên và Mã học phần đã nhập.", []);
        }
        echo json_encode($res);
    }
}
