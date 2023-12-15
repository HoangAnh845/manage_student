<?php
// Thông tin kết nối cơ sở dữ liệu
$servername = "localhost";  // Địa chỉ máy chủ MySQL
$username = "root"; // Tên đăng nhập MySQL
$password = ""; // Mật khẩu MySQL
$dbname = "manage_student";   // Tên cơ sở dữ liệu muốn kết nối


try {
    // Tạo đối tượng kết nối
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Khi có lỗi xảy ra trong quá trình thực thi truy vấn SQL 
    // PDO sẽ ném một ngoại lệ (exception) và không thực hiện các lệnh tiếp theo trong chương trình.
    $conn->setAttribute(
        PDO::ATTR_ERRMODE, // một hằng số đại diện cho thuộc tính liên quan đến chế độ xử lý lỗi của PDO.
        PDO::ERRMODE_EXCEPTION // sử dụng chế độ xử lý lỗi theo kiểu ngoại lệ 
    );
    //  echo "Kết nối cơ sở dữ liệu thành công!<br>";
} catch (PDOException $e) {
    // PDOException: Giúp bạn xác định rõ ràng lỗi xảy ra trong quá trình thao tác với cơ sở dữ liệu, 
    echo "Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage();
}
