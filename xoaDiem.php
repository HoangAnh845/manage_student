<?php
// Kết nối đến CSDL
// include('connect_to_db.php');

// Lấy dữ liệu từ biểu mẫu gửi lên
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $msv = $_POST['msv'];

//     // Câu truy vấn SQL để xóa dữ liệu khỏi bảng tbl_diemhocphan
//     $sql = "DELETE FROM tbl_diemhocphan WHERE `Mã sinh viên` = :msv";

//     // Chuẩn bị câu truy vấn SQL
//     $sqlreq = $conn->prepare($sql);

//     // Ràng buộc giá trị vào các tham số trong câu truy vấn
//     $sqlreq->bindParam(':msv', $msv, PDO::PARAM_INT);

//     // Thực thi câu truy vấn SQL
//     if ($sqlreq->execute()) {
//         echo "Xóa dữ liệu thành công.";
//     } else {
//         echo "Đã xảy ra lỗi khi xóa dữ liệu.";
//     }
// }


// Đóng kết nối đến CSDL
// include('disconnect_from_db.php');

// Kết nối đến CSDL
include('connect_to_db.php');

// Lấy dữ liệu từ biểu mẫu gửi lên
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_msv'])) {
        $msv = $_POST['delete_msv'];

        // Câu truy vấn SQL để xóa dữ liệu trong bảng tbl_diemhocphan
        $sql = "DELETE FROM `tbl_diemhocphan` WHERE `Mã sinh viên` = $msv";

        // Chuẩn bị câu truy vấn SQL
        $sqlreq = $conn->prepare($sql);

        // Ràng buộc giá trị vào các tham số trong câu truy vấn
        // $sqlreq->bindParam(':msv', $msv, PDO::PARAM_INT);

        // Thực thi câu truy vấn SQL
        $result = $sqlreq->execute();

        // Trả về kết quả cho AJAX
        $response = array();
        if ($result) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }

        echo json_encode($response);
    }
}

// Đóng kết nối đến CSDL
// include('disconnect_from_db.php');
