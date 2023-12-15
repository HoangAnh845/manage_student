<?php

include('../config/connect_to_db.php');
include('../class.php');
include('../function.php');

// Lấy dữ liệu từ biểu mẫu gửi lên
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_msv'])) {
        $response = new Info();
        $q = delete($conn, "tbl_diemhocphan", $_POST);
        if ($q) {
            $response->set_success(true);
            $response->set_message('Xóa dữ liệu thành công.');
        } else {
            $response->set_success(false);
            $response->set_message('Xóa dữ liệu thất bại.');
        }

        echo json_encode($response);
        include('../config/disconnect_from_db.php');
    }
}
