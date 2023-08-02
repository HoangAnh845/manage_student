<?php
// Kết nối đến CSDL (giả sử đã có file connect_to_db.php)
include('connect_to_db.php');

// Lấy dữ liệu từ biểu mẫu gửi lên
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $msv = $_POST['add_msv'];
    $mhp = $_POST['add_mhp'];
    $a = $_POST['add_a'];
    $b = $_POST['add_b'];
    $c = $_POST['add_c'];

    // Câu truy vấn SQL để cập nhật dữ liệu vào bảng
    $sql = "UPDATE `tbl_diemhocphan` SET `A` = :a, `B` = :b, `C` = :c WHERE `Mã sinh viên` = '{$msv}' AND `Mã học phần` = '{$mhp}'";

    // Chuẩn bị câu truy vấn SQL
    $sqlreq = $conn->prepare($sql);

    // Ràng buộc giá trị vào các tham số trong câu truy vấn
    $sqlreq->bindParam(':a', $a);
    $sqlreq->bindParam(':b', $b);
    $sqlreq->bindParam(':c', $c);
    // $sqlreq->bindParam(':msv', $msv);
    // $sqlreq->bindParam(':mhp', $mhp);

    // Thực thi câu truy vấn SQL
    $result = $sqlreq->execute();

    // Trả về kết quả cho Ajax
    $response = array();
    if ($result) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
    }

    echo json_encode($response);

    // Đóng kết nối đến CSDL (giả sử đã có file disconnect_from_db.php)
    include('disconnect_from_db.php');
}
