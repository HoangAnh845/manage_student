<?php
// Kết nối đến cơ sở dữ liệu
include('connect_to_db.php');

// Lấy dữ liệu từ biểu mẫu AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Kiểm tra xem người dùng đã gửi yêu cầu tìm kiếm chưa
    if (isset($_POST['msv']) && isset($_POST['mhp'])) {
        $msv = $_POST['msv'];
        $mhp = $_POST['mhp'];


        // Câu truy vấn SQL để lấy dữ liệu từ bảng
        $sql = "SELECT * FROM tbl_diemhocphan WHERE `Mã sinh viên` = :msv AND `Mã học phần` = :mhp";
        // Hàm prepare() của đối tượng PDO (biến $conn trong trường hợp này) được sử dụng để chuẩn bị câu truy vấn SQL
        $sqlreq = $conn->prepare($sql);
        // Dòng này ràng buộc các giá trị vào câu truy vấn SQL. 
        // Hàm bindParam() được sử dụng để ràng buộc giá trị $msv vào tham số :msv trong câu truy vấn. 
        // Khi ràng buộc giá trị, chúng ta có thể chỉ định loại dữ liệu của giá trị này. 
        // Trong trường hợp này, PDO::PARAM_INT được sử dụng để xác định rằng giá trị $msv là một số nguyên.
        $sqlreq->bindParam(':msv', $msv, PDO::PARAM_INT);
        $sqlreq->bindParam(':mhp', $mhp, PDO::PARAM_INT);
        // Dòng này thực thi câu truy vấn SQL đã được chuẩn bị và ràng buộc giá trị vào các tham số. 
        // Sau khi thực thi, câu truy vấn sẽ trả về các kết quả tương ứng
        $sqlreq->execute();

        // Lấy kết quả dưới dạng mảng kết hợp (Associative Array)
        $result = $sqlreq->fetch(PDO::FETCH_ASSOC);
        // Hiển thị kết quả tìm kiếm
        if ($result) {
            echo "<table>";
            echo "Mã sinh viên: " . $result['Mã sinh viên'] . "<br>";
            echo "Mã học phần: " . $result['Mã học phần'] . "<br>";
            echo "A: " . $result['A'] . "<br>";
            echo "B: " . $result['B'] . "<br>";
            echo "C: " . $result['C'] . "<br>";
            echo "</table>";
        } else {
            echo "Không tìm thấy kết quả cho Mã sinh viên và Mã học phần đã nhập.";
        }
    }
}
