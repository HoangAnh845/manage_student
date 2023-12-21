<?php

include('../config/connect_to_db.php');
include('../class/message.php');
include('../query.php');

// Lấy dữ liệu từ biểu mẫu gửi lên
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        $msv = $_POST['ma_sinhvien'];
        if (isset($msv)) {
            $q = sqlDelete($conn, "tbl_diemhocphan", $msv);
            if ($q) {
                $sqlDiemHocPhan = sqlSelect($conn, "*", "tbl_diemhocphan", 1);
                $diemhocphan = $sqlDiemHocPhan->fetchAll(PDO::FETCH_ASSOC);
                $res = new Message(true, 'Xóa dữ liệu thành công', $diemhocphan);
                // thành công return thẳng ra kết quả
                echo json_encode($res);
                include('../config/disconnect_from_db.php');
                return $res;
            }
        }
        // nếu sai thì return null
        $res = new Message(false, 'Xóa dữ liệu thất bại', []);
        echo json_encode($res);
        return $res;
    } catch (\Exception $e) {
        echo json_encode($e->getMessage());
    }
    // include('../config/disconnect_from_db.php');
}
