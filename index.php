<?php
include('connect_to_db.php');

// Câu truy vấn SQL để lấy dữ liệu từ bảng 
$sql = "SELECT * FROM tbl_hocphan";
$sqlreq = $conn->prepare($sql);
$sqlreq->execute();

// Lấy kết quả dưới dạng mảng kết hợp (Associative Array)
$result = $sqlreq->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <title>Document</title>
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
            <form id="formDangNhap" class="login"> <!-- action="xulyDangNhap.php" method="post" -->
                <h1 class="title">LOG IN</h1>
                <br><br><br><br>
                <div id="message" style="position: absolute;top: 17%;left: 30%;width: 50%;color: red;"></div>
                <input id="email" name="fullname" type="text" placeholder="Email..." class="username" />
                <input id="password" name="password" type="password" placeholder="Password..." class="username" />
                <button class="btn" type="submit">Login</button>
            </form>
            <form id="myForm" class="search">
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
    <script>
        $(".search").on("submit", function(event) {
            event.preventDefault(); // Ngăn chặn việc tải lại trang khi submit form
            sendData();
        });

        // $(".login").on("submit", function(event) {
        //     event.preventDefault(); // Ngăn chặn việc tải lại trang khi submit form
        //     if ($("[name|='fullname']").val().length > 0) {
        // // Thực hiện chuyển hướng sang liên kết khác
        // window.location.href = "http://localhost/manage_student/layout.php";
        //     } else {
        //         console.log("Vui lòng nhập thông tin đăng nhập");
        //     }

        // })

        // Hàm sendData() thực hiện gửi yêu cầu AJAX đến server
        function sendData() {
            var form = document.getElementById("myForm");
            // Tạo một đối tượng FormData từ form, chứa tất cả các thông tin của form
            var formData = new FormData(form);

            // Tạo đối tượng XMLHttpRequest, đóng vai trò là đối tượng tạo yêu cầu AJAX
            var xhr = new XMLHttpRequest();

            // Lắng nghe sự kiện trạng thái của yêu cầu AJAX
            xhr.onreadystatechange = function() {
                // // Khi trạng thái yêu cầu AJAX thay đổi, kiểm tra xem yêu cầu đã hoàn thành chưa
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    // Nếu yêu cầu đã thành công (status = 200)
                    if (xhr.status === 200) {
                        var resultDiv = $("#result");
                        resultDiv.empty().append(
                            $("<div>", {
                                style: "padding:20px",
                                html: xhr.response
                            })
                        )
                        $(".search").hide();
                        $("#result").show();
                    } else {
                        alert("Đã xảy ra lỗi khi gửi yêu cầu.");
                    }
                }
            };

            // Thiết lập yêu cầu AJAX với phương thức POST và URL là "ket_qua_tra_cuu.php"
            xhr.open("POST", "ket_qua_tra_cuu.php", true);
            // Gửi yêu cầu AJAX đến server với dữ liệu từ biến formData
            xhr.send(formData);
        };

        // Xử lý sự kiện submit của biểu mẫu
        $("#formDangNhap").submit(function(e) {
            e.preventDefault(); // Ngăn chặn việc tải lại trang khi submit form

            // Lấy dữ liệu từ biểu mẫu
            var email = $("#email").val();
            var password = $("#password").val();

            // Gửi dữ liệu lên máy chủ bằng Ajax
            $.ajax({
                type: 'POST',
                url: 'xulyDangNhap.php', // Đường dẫn tới file xử lý đăng nhập
                data: {
                    email: email,
                    password: password
                },
                // dataType: 'json',
                success: function(response) {
                    const str = response;

                    console.log(response);

                    // Tìm vị trí của "{" đầu tiên và "}" cuối cùng trong chuỗi
                    const startIndex = str.indexOf('{');
                    const endIndex = str.lastIndexOf('}') + 1;

                    // Tách chuỗi JSON từ đoạn chuỗi gốc
                    const jsonStr = str.slice(startIndex, endIndex);

                    // Chuyển chuỗi JSON thành đối tượng JavaScript
                    const jsonObject = JSON.parse(jsonStr);


                    if (jsonObject.success) {
                        // Hiển thị thông báo thành công
                        alert("Đăng nhập thành công.");
                        // Thực hiện chuyển hướng sang liên kết khác
                        window.location.href = "http://localhost/manage_student/layout.php";
                    } else {
                        // Hiển thị thông báo lỗi
                        alert("Đăng nhập không thành công. Vui lòng kiểm tra tên người dùng và mật khẩu.");
                    }
                },
                error: function(xhr, status, error) {
                    // Hiển thị thông báo lỗi nếu có lỗi trong quá trình gửi yêu cầu Ajax
                    $("#message").text("Có lỗi xảy ra khi gửi yêu cầu đăng nhập.");
                }
            });
        });

        /* Điều hướng */
        $(document).ready(function() {



            $(".container").fadeIn(1000);

            $(".s1class").css({
                "color": "#EE9BA3"
            });
            $(".s2class").css({
                "color": "#748194"
            });

            $(".search").hide();
            $(".login").show();
        });
        $("#right").click(function() {
            $("#left").removeClass("left_hover");
            $(".s2class").css({
                "color": "#EE9BA3"
            });
            $(".s1class").css({
                "color": "#748194"
            });
            $(".login").hide();
            $("#result").hide();
            $(".search").show();
        });
        $("#left").click(function() {
            $(".s1class").css({
                "color": "#EE9BA3"
            });
            $(".s2class").css({
                "color": "#748194"
            });

            $(".login").show();
            $(".search").hide();
        });
    </script>
</body>


</html>