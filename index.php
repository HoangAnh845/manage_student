<?php
// ký hiệu ->: truy cập phương thức và thuộc tính của một đối tượng

include('./config/connect_to_db.php');

// // Câu truy vấn SQL để lấy dữ liệu từ bảng 
$sql = "SELECT * FROM tbl_hocphan";
$sqlreq = $conn->query($sql);

// Lấy kết quả dưới dạng mảng kết hợp (Associative Array)
$result = $sqlreq->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <title>Student</title>
</head>

<body>
    <div class="container">
        <div class="c1">

            <div class="c11">
                <h1 class="mainhead">PICK YOUR SPOT</h1>
                <p class="mainp">Just click the buttons below to toggle between Login & Search</p>
            </div>
            <div id="left">
                <div class="s1class">LOG IN</div>
            </div>
            <div id="right">
                <div class="s2class">SEACRCH</div>
            </div>
        </div>
        <div class="c2">
            <form id="formLogin" class="login"> <!-- action="xulyDangNhap.php" method="post" -->
                <h1 class="title">LOG IN</h1>
                <br><br><br><br>
                <div id="message" style="position: absolute;top: 17%;left: 30%;width: 50%;color: red;"></div>
                <input id="email" name="fullname" type="text" placeholder="Email..." class="username" />
                <input id="password" name="password" type="password" placeholder="Password..." class="username" />
                <button class="btn" type="submit">Login</button>
            </form>
            <form id="formSearch" class="search">
                <h1 class="title">POINT LOOKUP</h1>
                <br><br><br><br>
                <input class="msv" type="text" name="msv" placeholder="Mã sinh viên">
                <br>
                <select class="mhp" name="mhp" value="">
                    <option value="">-- Chọn Học Phần --</option>
                    <?php
                    foreach ($result as $row) {
                        echo '<option value="' . $row['Mã học phần'] . '">' . $row['Tên học phần'] . '</option>';
                    }
                    ?>
                </select><br>
                <button class="btn searchResult" type="submit">Search</button>
            </form>
            <div id="result"></div>
        </div>
    </div>
    <script src="./assets/js/index.js"></script>
</body>

</html>