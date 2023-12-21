<?php
// Kết nối đến CSDL (giả sử đã có file connect_to_db.php)
include('../config/connect_to_db.php');
include('../class/message.php');
include('../query.php');

// Lấy dữ liệu từ biểu mẫu gửi lên
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $msv = $_POST['ma_sinhvien'];
    $mhp = $_POST['ma_hocphan'];
    $a = $_POST['diem_a'];
    $b = $_POST['diem_b'];
    $c = $_POST['diem_c'];

    // Câu truy vấn SQL để cập nhật dữ liệu vào bảng
    if (isset($msv) && isset($mhp) && isset($a) && isset($b) && isset($c)) {
        $q = sqlUpdate($conn, "tbl_diemhocphan", array(
            "diem_a" => $a,
            "diem_b" => $b,
            "diem_c" => $c
        ), "`ma_sinhvien`= '$msv'");
        // Trả về kết quả cho Ajax
        if (isset($q)) {
            $sqlDiemHocPhan = sqlSelect($conn, "*", "tbl_diemhocphan", 1);
            $diemhocphan = $sqlDiemHocPhan->fetchAll(PDO::FETCH_ASSOC);
            $res = new Message(true, 'Cập nhật dữ liệu thành công.', [
                "msv" => $msv,
                "a" => $a,
                "b" => $b,
                "c" => $c,
            ]);
        } else {
            $res = new Message(true, 'Đã xảy ra lỗi khi cập nhật dữ liệu. Vui lòng thử lại sau.', []);
        }
        echo json_encode($res);
        return $res;
    }
}
