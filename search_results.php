<?php
include('./config/connect_to_db.php');
include('./function.php');

// Lấy dữ liệu từ biểu mẫu AJAX
// REQUEST_METHOD: trả về phương thức truy vấn
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Kiểm tra xem người dùng đã gửi yêu cầu tìm kiếm chưa
    if (isset($_POST['msv']) && isset($_POST['mhp'])) {
        $query = [
            "0" => "*"
        ];
        $data = [
            "msv" => $_POST['msv'],
            "mhp" => $_POST['mhp']
        ];
        $conditionName = [
            "0" => "WHERE"
        ];
        $condition = [
            "0" => "`Mã sinh viên` = '{$data['msv']}' AND `Mã học phần` = '{$data['mhp']}'",
        ];
        // Câu truy vấn SQL để lấy dữ liệu từ bảng
        $q = find($conn, "tbl_diemhocphan", $query, $data, $conditionName, $condition);
        $r = $q->fetch(PDO::FETCH_ASSOC);
        // Hiển thị kết quả tìm kiếm
        if ($r) {
            echo "<table>";
            echo "Mã sinh viên: " . $r['Mã sinh viên'] . "<br>";
            echo "Mã học phần: " . $r['Mã học phần'] . "<br>";
            echo "A: " . $r['A'] . "<br>";
            echo "B: " . $r['B'] . "<br>";
            echo "C: " . $r['C'] . "<br>";
            echo "</table>";
        } else {
            echo "Không tìm thấy kết quả cho Mã sinh viên và Mã học phần đã nhập.";
        }
    }
}
