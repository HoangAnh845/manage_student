<?php
// Kết nối đến CSDL
include('connect_to_db.php');

// Lấy dữ liệu từ biểu mẫu gửi lên
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $msv = $_POST['add_msv'];
    $mhp = $_POST['add_mhp'];
    $a = $_POST['add_a'];
    $b = $_POST['add_b'];
    $c = $_POST['add_c'];

    // Câu truy vấn SQL để thêm dữ liệu vào bảng tbl_diemhocphan
    $sql = "INSERT INTO `tbl_diemhocphan` (`Mã sinh viên`, `Mã học phần`, `A`, `B`, `C`) VALUES ('{$msv}', '{$mhp}','{$a}','{$b}','{$c}')";
    // $sql = "INSERT INTO `tbl_diemhocphan` (`Mã sinh viên`, `Mã học phần`, `A`, `B`, `C`) VALUES (:msv, :mhp, :a, :b, :c)";
    // $sql = "INSERT INTO `tbl_diemhocphan` (`Mã sinh viên`, `Mã học phần`, `A`, `B`, `C`) VALUES (125, 7080116, 24, 35, 59)";

    // Chuẩn bị câu truy vấn SQL
    $sqlreq = $conn->prepare($sql);

    // Ràng buộc giá trị vào các tham số trong câu truy vấn
    // $sqlreq->bindParam(':msv', $msv);
    // $sqlreq->bindParam(':mhp', $mhp);
    // $sqlreq->bindParam(':a', $a);
    // $sqlreq->bindParam(':b', $b);
    // $sqlreq->bindParam(':c', $c);
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
    // if ($sqlreq->execute()) {
    //     echo "Thêm dữ liệu thành công.";
    // } else {
    //     echo "Đã xảy ra lỗi khi thêm dữ liệu.";
    // }

    // Đóng kết nối đến CSDL
    include('disconnect_from_db.php');
}
