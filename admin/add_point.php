<?php
// Kết nối đến CSDL
include('../config/connect_to_db.php');
include('../class/message.php');
include('../query.php');

// Lấy dữ liệu từ biểu mẫu gửi lên
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $msv = $_POST["ma_sinhvien"];
    $mhp = $_POST["ma_hocphan"];
    $a = $_POST["diem_a"];
    $b = $_POST["diem_b"];
    $c = $_POST["diem_c"];
    $res = null;

    if (isset($msv) && isset($mhp) && isset($a) && isset($b) && isset($c)) {
        $data = [
            "ma_sinhvien" => $msv,
            "ma_hocphan" => $mhp,
            "diem_a" => $a,
            "diem_b" => $b,
            "diem_c" => $c,
        ];
        $q = sqlInsert($conn, "tbl_diemhocphan", $data);
        if ($q) {
            $sqlDiemHocPhan = sqlSelect($conn, "*", "tbl_diemhocphan", 1);
            $diemhocphan = $sqlDiemHocPhan->fetchAll(PDO::FETCH_ASSOC);
            $res = new Message(true, 'Thêm dữ liệu thành công', $diemhocphan);
        } else {
            $res = new Message(false, 'Thêm dữ liệu thất bại', []);
        }
        echo json_encode($res);
        return $res;
        // Đóng kết nối đến CSDL
        include('./config/disconnect_from_db.php');
    }
}
