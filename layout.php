<?php
// Kết nối đến CSDL
include('connect_to_db.php');

// Câu truy vấn SQL để lấy tổng số lượng bản ghi trong bảng tbl_diemhocphan
$sql = "
    SELECT 'tbl_hocsinh' AS table_name, COUNT(*) AS total_records FROM tbl_sinhvien    
    UNION
    SELECT 'tbl_diemhocphan' AS table_name, COUNT(*) AS total_records FROM tbl_hocphan
    UNION
    SELECT 'tbl_hocsinh' AS table_name, COUNT(*) AS total_records FROM tbl_lopchuyennganh
    UNION
    SELECT 'tbl_hocsinh' AS table_name, COUNT(*) AS total_records FROM tbl_khoa
";

// Chuẩn bị câu truy vấn SQL
$sqlreq = $conn->prepare($sql);
// Thực thi câu truy vấn SQL
$sqlreq->execute();
// Lấy kết quả dưới dạng mảng kết hợp (Associative Array)
$results = $sqlreq->fetchAll(PDO::FETCH_ASSOC);

// Thực hiện truy vấn để lấy danh sách sinh viên từ cơ sở dữ liệu
$sql1 = "SELECT * FROM tbl_diemhocphan";
$sqlreq1 = $conn->prepare($sql1);
$sqlreq1->execute();

// Xử lý kết quả truy vấn và trả về danh sách sinh viên dưới dạng HTML
$diemhocphan = $sqlreq1->fetchAll(PDO::FETCH_ASSOC);


// Câu truy vấn SQL để lấy dữ liệu từ bảng 
$sql2 = "SELECT * FROM tbl_hocphan";
$sqlreq2 = $conn->prepare($sql2);
$sqlreq2->execute();

// Lấy kết quả dưới dạng mảng kết hợp (Associative Array)
$hocPhan = $sqlreq2->fetchAll(PDO::FETCH_ASSOC);


// Đóng kết nối đến CSDL
include('disconnect_from_db.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý học tập sinh viên</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/layout.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
</head>

<body>
    <div class="main">
        <div class="left">
            <ul>
                <li class="menu-heading">BẢNG ĐIỀU KHIỂN</li>
                <li><a data-toggle="tab"> <i class="fa fa-home fa-lg"></i> Tổng quan</a></li>
                <li><a data-toggle="tab"> <i class="fa fa-tachometer fa-lg"></i> Hiệu suất</a></li>
                <li class="active linkThongKe"><a data-toggle="tab"> <i class="fa fa-line-chart fa-lg"></i> Thống kê</a></li>

                <li class="menu-heading">QUẢN LÝ</li>
                <li class="linkQLDiem"><a data-toggle="tab"><i class="fa fa-users fa-lg"></i> Quản lý điểm</a></li>
                <li class="linkDOIMK"><a data-toggle="tab"><i class="fa fa-file-text-o fa-lg"></i> Đổi mật khẩu</a></li>
                <li><a data-toggle="tab" href="http://localhost/manage_student/"><i class="fa fa-sign-out fa-lg"></i> Đăng xuất</a></li>
            </ul>
        </div>
        <div class="right">
            <div class="tab-content">
                <!-- Thống kế -->
                <div id="thongKe" class="tab-pane fade">
                    <div class="header">
                        <h4>Thống kê</h4>
                        <ul class="pull-right">
                            <li>
                                <div class="btn-group dropleft dropdown-user">
                                    <i class="fa fa-user-o dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </i>
                                </div>
                            </li>
                            <li>
                                <div class="btn-group dropleft dropdown-alert">
                                    <i class="fa fa-bell-o dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </i>
                                </div>
                            </li>
                            <li>
                                <div class="btn-group dropleft dropdown-avatar">
                                    <img src="https://bit.ly/2Km1kf6" class="img-circle img-responvie" /><i class="fa fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="content">
                        <div class="row">
                            <div class="col">
                                <div><i class="fa fa-users fa-lg"></i></div>
                                <div class="total">
                                    <div><?php echo $results[0]['total_records']; ?></div>
                                    <div>Số lượng sinh viên</div>
                                </div>
                            </div>
                            <div class="col">
                                <div><i class="fa fa-file-text fa-lg"></i></div>
                                <div class="total">
                                    <div><?php echo $results[1]['total_records']; ?></div>
                                    <div>Học phần</div>
                                </div>
                            </div>
                            <div class="col">
                                <div><i class="fa fa-book fa-lg"></i></div>
                                <div class="total">
                                    <div><?php echo $results[2]['total_records']; ?></div>
                                    <div>Lớp chuyên ngành</div>
                                </div>
                            </div>
                            <div class="col">
                                <div><i class="fa fa-cube fa-lg"></i></div>
                                <div class="total">
                                    <div><?php echo $results[3]['total_records']; ?></div>
                                    <div>Khoa</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quản lý bài điểm-->
                <div id="quanlyDiem" class="tab-pane fade">
                    <div class="header">
                        <h4>Quản lý điểm học phần</h4>
                        <ul class="pull-right">
                            <li>
                                <div class="btn-group dropleft dropdown-user">
                                    <i class="fa fa-user-o dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </i>
                                </div>
                            </li>
                            <li>
                                <div class="btn-group dropleft dropdown-alert">
                                    <i class="fa fa-bell-o dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </i>
                                </div>
                            </li>
                            <li>
                                <div class="btn-group dropleft dropdown-avatar">
                                    <img src="https://bit.ly/2Km1kf6" class="img-circle img-responvie" /><i class="fa fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="content">
                        <div class="addDiemHP">
                            <form id="addDiemHP"><!-- action="themDiem.php" method="post" -->
                                <h4 class="titleTool">Thêm mới điểm học phần</h4>
                                <input type="text" name="msv" placeholder="Mã sinh viên..." />
                                <select style="padding:10px;" class="mhp" name="mhp" value="">
                                    <option value="">-- Chọn Học Phần --</option>
                                    <?php
                                    foreach ($hocPhan as $row) {
                                        echo '<option value="' . $row['Mã học phần'] . '">' . $row['Tên học phần'] . '</option>';
                                    }
                                    ?>
                                </select><br>
                                <input type="text" name="diemA" placeholder="Điểm A..." />
                                <input type="text" name="diemB" placeholder="Điểm B..." />
                                <input type="text" name="diemC" placeholder="Điểm C..." />
                                <input type="submit" name="submit" value="Thêm mới" />
                                <!-- <a class="" href="http://localhost/manage_student/layout.php">Làm mới</a> -->
                            </form>
                        </div>
                        <div style="height: 500px;overflow: overlay;">
                            <h4>Danh sách điểm học phần</h4>
                            <form id="tools">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã học phần</th>
                                            <th>Mã sinh viên</th>
                                            <th>A</th>
                                            <th>B</th>
                                            <th>C</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        if ($diemhocphan) {
                                            foreach ($diemhocphan as $diem) {
                                                echo "<tr class=dong" . " >";
                                                echo "<td>" . $count++ . "</td>";
                                                echo "<td>" . $diem['Mã học phần'] . "</td>";
                                                echo "<td " . "name=" . $diem['Mã sinh viên'] . "" . ">" . $diem['Mã sinh viên'] . "</td>";
                                                echo "<td>" . $diem['A'] . "</td>";
                                                echo "<td>" . $diem['B'] . "</td>";
                                                echo "<td>" . $diem['C'] . "</td>";
                                                echo "<td>" . "
                                            <button class='edit'><i class='far fa-edit'></i></button>
                                            <button type='submit' class='delete'><i class='far fa-trash-alt'></i></button>
                                            " . "</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "Không tìm thấy danh sách sinh viên.";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </form>

                        </div>

                    </div>
                </div>
                <!-- Đổi mật khẩu-->
                <div id="doiMK" class="tab-pane fade">
                    <div class="header">
                        <h4>Đổi mật khẩu</h4>
                        <ul class="pull-right">
                            <li>
                                <div class="btn-group dropleft dropdown-user">
                                    <i class="fa fa-user-o dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </i>
                                </div>
                            </li>
                            <li>
                                <div class="btn-group dropleft dropdown-alert">
                                    <i class="fa fa-bell-o dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </i>
                                </div>
                            </li>
                            <li>
                                <div class="btn-group dropleft dropdown-avatar">
                                    <img src="https://bit.ly/2Km1kf6" class="img-circle img-responvie" /><i class="fa fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="content">
                        <form id="changePasswordForm" style="padding-top:20px;">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required><br>
                            <label for="oldPassword">Mật khẩu cũ:</label>
                            <input type="password" id="oldPassword" name="oldPassword" required><br>
                            <label for="newPassword">Mật khẩu mới:</label>
                            <input type="password" id="newPassword" name="newPassword" required><br>
                            <button type="submit">Đổi mật khẩu</button>
                        </form>
                        <div id="message"></div>
                    </div>
                </div>
            </div>

        </div>
        <script>
            // Khởi tạo biến đếm số lần click
            var clickCount = 0;

            // Xóa điểm học phần
            $("#tools .delete").each(function(item, index) {
                $(this).on('click', function(e) {
                    e.preventDefault(); // Ngăn chặn việc tải lại trang khi submit form
                    var ths = $(this);
                    var msv = $(this).closest('.dong').find("td[name]").text(); // Lấy giá trị của thuộc tính data-msv

                    // Thực hiện AJAX để gửi yêu cầu xóa dữ liệu lên máy chủ
                    $.ajax({
                        type: 'POST',
                        url: 'xoaDiem.php', // Điền đúng đường dẫn tới file themDiem.php
                        data: {
                            delete_msv: msv
                        },
                        dataType: 'json',
                        success: function(response) {
                            // Kiểm tra kết quả từ máy chủ
                            if (response.success) {
                                // Xóa dòng chứa dữ liệu đã bị xóa trong bảng HTML
                                ths.closest(".dong").remove();
                                alert('Xóa dữ liệu thành công.');
                            } else {
                                alert('Không thể xóa dữ liệu. Vui lòng thử lại sau.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr, status, error);
                            alert('Có lỗi xảy ra khi gửi yêu cầu xóa dữ liệu.');
                        }
                    });
                })
            });

            // Sửa điểm học phần
            $("#tools .edit").each(function(item, index) {
                $(this).on('click', function(e) {
                    e.preventDefault(); // Ngăn chặn việc tải lại trang khi submit form
                    var ths = $(this);

                    var mhp = $(this).closest('.dong').find("td:nth-child(2)").text(),
                        msv = $(this).closest('.dong').find("td:nth-child(3)").text(),
                        a = $(this).closest('.dong').find("td:nth-child(4)").text(),
                        b = $(this).closest('.dong').find("td:nth-child(5)").text(),
                        c = $(this).closest('.dong').find("td:nth-child(6)").text();

                    $(".titleTool").text('Sửa thông tin điểm học phần');
                    $("#addDiemHP").find('select[name="mhp"]').val(mhp);
                    $("#addDiemHP").find('input[name="msv"]').val(mhp);
                    $("#addDiemHP").find('input[name="diemA"]').val(a);
                    $("#addDiemHP").find('input[name="diemB"]').val(b);
                    $("#addDiemHP").find('input[name="diemC"]').val(c);
                    $("#addDiemHP").find('input[name="submit"]').val("Chỉnh sửa");
                })
            });


            $("#addDiemHP").on('submit', function(e) {
                e.preventDefault(); // Ngăn chặn việc tải lại trang khi submit form
                var msv = $(this).find('input[name="msv"]').val(), // Lấy giá trị của thuộc tính data-msv
                    mhp = $(this).find('select[name="mhp"]').val(),
                    a = $(this).find('input[name="diemA"]').val(),
                    b = $(this).find('input[name="diemB"]').val(),
                    c = $(this).find('input[name="diemC"]').val();
                console.log("LOG_____", msv, mhp, a, b, c);
                console.log($(this).find('input[name="msv"]'));
                console.log($(this).find('select[name="mhp"]'));
                // Sửa buổi học phần
                if ($(this).find('input[name="submit"]').val() == "Chỉnh sửa") {
                    // Gửi dữ liệu đến file PHP xử lý (updateData.php)
                    $.ajax({
                        type: 'POST',
                        url: 'suaDiem.php', // Điền đúng đường dẫn tới file updateData.php
                        data: {
                            add_msv: msv,
                            add_mhp: mhp,
                            add_a: a,
                            add_b: b,
                            add_c: c,
                        },
                        // dataType: 'json', // Kiểu dữ liệu trả về từ server (json)
                        success: function(response) {
                            const str = response;

                            console.log("response___", msv, mhp, a, b, c);

                            // Tìm vị trí của "{" đầu tiên và "}" cuối cùng trong chuỗi
                            const startIndex = str.indexOf('{');
                            const endIndex = str.lastIndexOf('}') + 1;

                            // Tách chuỗi JSON từ đoạn chuỗi gốc
                            const jsonStr = str.slice(startIndex, endIndex);

                            // Chuyển chuỗi JSON thành đối tượng JavaScript
                            const jsonObject = JSON.parse(jsonStr);

                            // Kiểm tra kết quả từ máy chủ
                            if (jsonObject.success) {
                                alert('Cập nhật dữ liệu thành công.');
                                $(".titleTool").text('Thêm thông tin điểm học phần');
                                $("#addDiemHP").find('select').val('');
                                $("#addDiemHP").find('input').val('');
                                $("#addDiemHP").find('input[name="submit"]').val("Thêm mới");
                            } else {
                                alert('Đã xảy ra lỗi khi cập nhật dữ liệu. Vui lòng thử lại sau.');
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Có lỗi xảy ra khi gửi yêu cầu cập nhật dữ liệu.');
                        }
                    });
                } else {
                    // Thêm điểm học phần
                    // Thực hiện AJAX để gửi yêu cầu xóa dữ liệu lên máy chủ
                    $.ajax({
                        type: 'POST',
                        url: 'themDiem.php', // Điền đúng đường dẫn tới file themDiem.php
                        data: {
                            add_msv: msv,
                            add_mhp: mhp,
                            add_a: a,
                            add_b: b,
                            add_c: c,
                        },
                        // dataType: 'json',
                        success: function(response) {
                            const str = response;

                            // Tìm vị trí của "{" đầu tiên và "}" cuối cùng trong chuỗi
                            const startIndex = str.indexOf('{');
                            const endIndex = str.lastIndexOf('}') + 1;

                            // Tách chuỗi JSON từ đoạn chuỗi gốc
                            const jsonStr = str.slice(startIndex, endIndex);

                            // Chuyển chuỗi JSON thành đối tượng JavaScript
                            const jsonObject = JSON.parse(jsonStr);

                            // Kiểm tra kết quả từ máy chủ
                            if (jsonObject.success) {
                                alert('Thêm dữ liệu thành công. Vui lòng làm mới lại.');
                            } else {
                                alert('Không thể thêm dữ liệu. Vui lòng thử lại sau.');
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Có lỗi xảy ra khi gửi yêu cầu thêm dữ liệu.');
                        }
                    });
                }

            });

            // Đổi mật khẩu
            $("#changePasswordForm").submit(function(e) {
                e.preventDefault();
                var email = $("#email").val();
                var oldPassword = $("#oldPassword").val();
                var newPassword = $("#newPassword").val();

                console.log(email, oldPassword, newPassword);

                $.ajax({
                    type: "POST",
                    url: "change_password.php",
                    data: {
                        email: email,
                        oldPassword: oldPassword,
                        newPassword: newPassword
                    },
                    // dataType: "json",
                    success: function(response) {
                        const str = response;

                        // Tìm vị trí của "{" đầu tiên và "}" cuối cùng trong chuỗi
                        const startIndex = str.indexOf('{');
                        const endIndex = str.lastIndexOf('}') + 1;

                        // Tách chuỗi JSON từ đoạn chuỗi gốc
                        const jsonStr = str.slice(startIndex, endIndex);

                        // Chuyển chuỗi JSON thành đối tượng JavaScript
                        const jsonObject = JSON.parse(jsonStr);

                        $("#message").text(jsonObject.message);
                    },
                    error: function(xhr, status, error) {
                        console.error("LOG____", error);
                        $("#message").text("Có lỗi xảy ra khi xử lý yêu cầu.");
                    }
                });
            });

            $(document).ready(function() {
                $("#thongKe").hide();
                $("#quanlyDiem").show();
                $("#doiMK").hide();
            });

            $(".linkThongKe").click(function() {
                $("#thongKe").show();
                $("#quanlyDiem").hide();
                $("#doiMK").hide();
            });
            $(".linkQLDiem").click(function() {
                $("#thongKe").hide();
                $("#quanlyDiem").show();
                $("#doiMK").hide();
            });
            $(".linkDOIMK").click(function() {
                $("#thongKe").hide();
                $("#quanlyDiem").hide();
                $("#doiMK").show();
            })
        </script>
</body>

</html>