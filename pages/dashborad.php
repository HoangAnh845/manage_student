<?php
include('../config/connect_to_db.php');
include("../query.php");
include("../pagination.php");


// UNION: dùng để tập hợp kết quả
$sqlSinhVien = "
    SELECT 'tbl_sinhvien' AS table_name, COUNT(*) AS total_records FROM tbl_sinhvien
    UNION
    SELECT 'tbl_hocphan' AS table_name, COUNT(*) AS total_records FROM tbl_hocphan
    UNION
    SELECT 'tbl_lop' AS table_name, COUNT(*) AS total_records FROM tbl_lopchuyennganh
    UNION
    SELECT 'tbl_khoa' AS table_name, COUNT(*) AS total_records FROM tbl_khoa
";
$sqlreq = $conn->query($sqlSinhVien);
$results = $sqlreq->fetchAll(PDO::FETCH_ASSOC);

// Số bản ghi trên mỗi trang
$page_size = 10;

// Tổng số bảng ghi
$q = sqlSelect($conn, "COUNT(*) AS total", "tbl_sinhvien", 1);
$total_pages = $q->fetch(PDO::FETCH_DEFAULT)['total'];

// Kiểm tra số trang hiên tại 
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Tính toán số trang cần hiện 
$start_page = ($page - 1) * $page_size;

// Truy vấn dữ liệu
$sqlDiemHocPhan = sqlSelect($conn, "*", "tbl_diemhocphan", "1 ORDER BY `ma_sinhvien` LIMIT $page_size  OFFSET $start_page");
$diemhocphan = $sqlDiemHocPhan->fetchAll(PDO::FETCH_ASSOC);

// Truy vấn bảng học phần
$sqlHocPhan = sqlSelect($conn, "*", "tbl_hocphan", 1);
$hocPhan = $sqlHocPhan->fetchAll(PDO::FETCH_ASSOC);

// Đóng kết nối đến CSDL
include('../config/disconnect_from_db.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý học tập sinh viên</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/dashborad.css">
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
                                    <img width="50px" height="50px" src="https://i.pinimg.com/originals/ed/2e/e4/ed2ee49c72e3aff37d3a9428112f287b.png" class="img-circle img-responvie" />
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
                                    <img width="50px" height="50px" src="https://i.pinimg.com/originals/ed/2e/e4/ed2ee49c72e3aff37d3a9428112f287b.png" class="img-circle img-responvie" />
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="content">
                        <div class="handlePoint">
                            <form id="handlePoint"><!-- action="themDiem.php" method="post" -->
                                <input type="text" name="msv" placeholder="Mã sinh viên..." />
                                <select style="padding:10px;" class="mhp" name="mhp" value="">
                                    <option value="">-- Chọn Học Phần --</option>
                                    <?php
                                    foreach ($hocPhan as $row) {
                                        echo '<option value="' . $row['ma_hocphan'] . '">' . $row['ten_hocphan'] . '</option>';
                                    }
                                    ?>
                                </select><br>
                                <input type="text" name="diemA" placeholder="Điểm A..." />
                                <input type="text" name="diemB" placeholder="Điểm B..." />
                                <input type="text" name="diemC" placeholder="Điểm C..." />
                                <input type="submit" name="submit" value="Thêm mới" />
                            </form>
                            <form id="handleSearch">
                                <input type="number" name="search" placeholder="Tìm kiếm theo mã sinh viên..." />
                                <button type="submit" style="padding:10px;">Search</button>
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
                                        if ($diemhocphan) {
                                            foreach ($diemhocphan as $key => $diem) {
                                                echo "<tr class=dong" . " >";
                                                echo "<td>" . ($page - 1) * $page_size +  $key + 1 . "</td>";
                                                echo "<td>" . $diem['ma_hocphan'] . "</td>";
                                                echo "<td " . "name=" . $diem['ma_sinhvien'] . "" . ">" . $diem['ma_sinhvien'] . "</td>";
                                                echo "<td>" . $diem['diem_a'] . "</td>";
                                                echo "<td>" . $diem['diem_b'] . "</td>";
                                                echo "<td>" . $diem['diem_c'] . "</td>";
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
                            <ul class="pagination">
                                <?php if ($page > 1) : ?>
                                    <li class="prev"><a href="dashborad.php?page=<?php echo $page - 1 ?>">Prev</a></li>
                                <?php endif; ?>

                                <?php if ($page > 3) : ?>
                                    <li class="start"><a href="dashborad.php?page=1">1</a></li>
                                    <li class="dots">...</li>
                                <?php endif; ?>

                                <?php if ($page - 2 > 0) : ?><li class="page"><a href="dashborad.php?page=<?php echo $page - 2 ?>"><?php echo $page - 2 ?></a></li><?php endif; ?>
                                <?php if ($page - 1 > 0) : ?><li class="page"><a href="dashborad.php?page=<?php echo $page - 1 ?>"><?php echo $page - 1 ?></a></li><?php endif; ?>

                                <li class="currentpage"><a href="dashborad.php?page=<?php echo $page ?>"><?php echo $page ?></a></li>

                                <?php if ($page + 1 < ceil($total_pages / $page_size) + 1) : ?><li class="page"><a href="dashborad.php?page=<?php echo $page + 1 ?>"><?php echo $page + 1 ?></a></li><?php endif; ?>
                                <?php if ($page + 2 < ceil($total_pages / $page_size) + 1) : ?><li class="page"><a href="dashborad.php?page=<?php echo $page + 2 ?>"><?php echo $page + 2 ?></a></li><?php endif; ?>

                                <?php if ($page < ceil($total_pages / $page_size) - 2) : ?>
                                    <li class="dots">...</li>
                                    <li class="end"><a href="dashborad.php?page=<?php echo ceil($total_pages / $page_size) ?>"><?php echo ceil($total_pages / $page_size) ?></a></li>
                                <?php endif; ?>

                                <?php if ($page < ceil($total_pages / $page_size)) : ?>
                                    <li class="next"><a href="dashborad.php?page=<?php echo $page + 1 ?>">Next</a></li>
                                <?php endif; ?>
                            </ul>
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
                                    <img width="50px" height="50px" src="https://i.pinimg.com/originals/ed/2e/e4/ed2ee49c72e3aff37d3a9428112f287b.png" class="img-circle img-responvie" />
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
    <script src="../assets/js/dashborad.js"></script>
</body>

</html>