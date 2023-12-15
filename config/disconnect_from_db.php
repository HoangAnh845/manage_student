<?php
// Đảm bảo rằng biến $conn tồn tại và là một đối tượng PDO
if (isset($conn) && $conn instanceof PDO) {
    // Đóng kết nối cơ sở dữ liệu
    $conn = null;
    // echo "Đóng kết nối cơ sở dữ liệu thành công!";
} else {
    echo "Không có kết nối cơ sở dữ liệu để đóng.";
}
