<?php
include('./config/connect_to_db.php');

// Câu truy vấn SQL để lấy tổng số lượng bản ghi trong bảng tbl_diemhocphan
// UNION: dùng để tập hợp kết quả
$sql = "
    SELECT 'tbl_hocsinh' AS table_name, COUNT(*) AS total_records FROM tbl_sinhvien    
    UNION
    SELECT 'tbl_diemhocphan' AS table_name, COUNT(*) AS total_records FROM tbl_hocphan
    UNION
    SELECT 'tbl_hocsinh' AS table_name, COUNT(*) AS total_records FROM tbl_lopchuyennganh
    UNION
    SELECT 'tbl_hocsinh' AS table_name, COUNT(*) AS total_records FROM tbl_khoa
";
$sqlreq = $conn->query($sql);
$results = $sqlreq->fetchAll(PDO::FETCH_ASSOC);


// Truy vấn bảng điểm học phần
$sql1 = "SELECT * FROM tbl_diemhocphan";
$sqlreq1 = $conn->query($sql1);
$diemhocphan = $sqlreq1->fetchAll(PDO::FETCH_ASSOC);


// Truy vấn SQL để lấy dữ liệu từ bảng học phần
$sql2 = "SELECT * FROM tbl_hocphan";
$sqlreq2 = $conn->query($sql2);
$hocPhan = $sqlreq2->fetchAll(PDO::FETCH_ASSOC);


// Đóng kết nối đến CSDL
include('./config/disconnect_from_db.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý học tập sinh viên</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/dashborad.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                <li class="linkchangePass"><a data-toggle="tab"><i class="fa fa-file-text-o fa-lg"></i> Đổi mật khẩu</a></li>
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
                        <div class="handlePoint">
                            <form id="handlePoint"><!-- action="themDiem.php" method="post" -->
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
                <div id="changePass" class="tab-pane fade">
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
                        <div id="message"></div>
                        <form id="changePasswordForm" style="padding-top:20px;">
                            <label for="email">Email:</label>
                            <br>
                            <input type="email" id="email" name="email" required>
                            <br>
                            <br>
                            <label for="oldPassword">Mật khẩu cũ:</label>
                            <br>
                            <input type="password" id="oldPassword" name="oldPassword" required>
                            <br>
                            <br>
                            <label for="newPassword">Mật khẩu mới:</label>
                            <br>
                            <input type="password" id="newPassword" name="newPassword" required>
                            <br>
                            <br>
                            <br>
                            <button type="submit">Đổi mật khẩu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./assets/js/dashborad.js"></script>
</body>

</html>