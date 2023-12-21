// Khởi tạo biến đếm số lần click
var clickCount = 0;


// Thêm/Sửa điểm học phần
$("#handlePoint").on('submit', function (e) {
    e.preventDefault();
    var dataHP = {
        ma_sinhvien: $(this).find('input[name="msv"]').val(),
        ma_hocphan: $(this).find('select[name="mhp"]').val(),
        diem_a: $(this).find('input[name="diemA"]').val(),
        diem_b: $(this).find('input[name="diemB"]').val(),
        diem_c: $(this).find('input[name="diemC"]').val()
    };

    // Sửa điểm học phần
    if ($(this).find('input[name="submit"]').val() == "Chỉnh sửa") {
        $.ajax({
            type: 'POST',
            url: 'http://localhost/manage_student/admin/edit_point.php',
            data: dataHP,
            // dataType: 'json', // Kiểu dữ liệu trả về từ server (json)
            success: function (response) {
                const jsonObject = JSON.parse(response) || {};

                // Kiểm tra kết quả từ máy chủ
                if (jsonObject.state) {
                    alert(jsonObject.content);
                    $(".titleTool").text('Thêm thông tin điểm học phần');

                    $("#handlePoint").find('select[name="mhp"]').attr('disabled', false);
                    $("#handlePoint").find('input[name="msv"]').attr('disabled', false)

                    // Gắn giá trị mới
                    $(`#tools table [name=${jsonObject.response['msv']}]`).parent().find("td:nth-child(4)").text(jsonObject.response['a']) // a
                    $(`#tools table [name=${jsonObject.response['msv']}]`).parent().find("td:nth-child(5)").text(jsonObject.response['b']) // b
                    $(`#tools table [name=${jsonObject.response['msv']}]`).parent().find("td:nth-child(6)").text(jsonObject.response['c']) // c
                } else {
                    alert(jsonObject.content);
                }
            },
            error: function (xhr, status, error) {
                alert('Có lỗi xảy ra khi gửi yêu cầu cập nhật dữ liệu.');
            }
        });
    }

    // Thêm mới học phần
    else {
        $.ajax({
            type: 'POST',
            url: 'http://localhost/manage_student/admin/add_point.php',
            data: dataHP,
            success: function (response) {
                const jsonObject = JSON.parse(response);
                if (jsonObject.state) {
                    alert(jsonObject.content);
                    $("tbody").empty().append($.map((jsonObject.response || []), function (item, index) {
                        return `
                            <tr class="dong">
                                <td>${index + 1}</td>
                                <td>${item.ma_hocphan}</td>
                                <td name=${item.ma_sinhvien}>${item.ma_sinhvien}</td>
                                <td>${item.diem_a}</td>
                                <td>${item.diem_b}</td>
                                <td>${item.diem_c}</td>
                                <td>
                                    <button class="edit"><i class="far fa-edit"></i></button>
                                    <button type="submit" class="delete"><i class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>                    
                        `
                    }))
                } else {
                    alert(jsonObject.content);
                }
            },
            error: function (xhr, status, error) {
                alert('Có lỗi xảy ra khi gửi yêu cầu thêm dữ liệu.');
            }
        });
    }

    $("#handlePoint").find('select').val('');
    $("#handlePoint").find('input').val('');
    $("#handlePoint").find('input[name="submit"]').val("Thêm mới");

});

// Tìm kiếm theo msv
$("#handleSearch").on("submit", (e) => {
    e.preventDefault();
    const msv = $("#handleSearch").find("input").val() || 0;
    $.ajax({
        type: "POST",
        url: "http://localhost/manage_student/search_results.php",
        data: { ma_sinhvien: msv },

        success: function (res) {
            const jsonObj = JSON.parse(res);
            const result = jsonObj.response;
            if (jsonObj.state) {
                $("tbody").empty().append(
                    $("<tr>", {
                        class: "dong",
                        html: `
                        <td>1</td>
                        <td>${result['ma_hocphan']}</td>
                        <td name=${result['ma_sinhvien']}>${result['ma_sinhvien']}</td>
                        <td>${result['diem_a']}</td>
                        <td>${result['diem_b']}</td>
                        <td>${result['diem_c']}</td>
                        <td>    
                            <button class='edit'><i class='far fa-edit'></i></button>
                            <button type='submit' class='delete'><i class='far fa-trash-alt'></i></button>
                        </td>
                    ` })
                )
            } else {
                $("tbody").empty();
                alert(jsonObj.content)
            }

        },
        error: function (error) {
            alert("Có lỗi xảy khi gửi yêu cầu tìm kiếm");
            console.log('--- Error - Search ---', error);
        }
    })
})

// Xóa điểm học phần
$("#tools .delete").each(function (item, index) {
    $(this).on('click', function (e) {
        e.preventDefault(); // Ngăn chặn việc tải lại trang khi submit form
        var ths = $(this);
        var msv = $(this).closest('.dong').find("td[name]").text(); // Lấy giá trị của thuộc tính data-msv

        // Thực hiện AJAX để gửi yêu cầu xóa dữ liệu lên máy chủ
        $.ajax({
            type: 'POST',
            url: 'http://localhost/manage_student/admin/delete_point.php', // Điền đúng đường dẫn tới file themDiem.php
            data: {
                ma_sinhvien: msv
            },
            // dataType: 'json',
            success: function (response) {
                const jsonObject = JSON.parse(response);
                // Kiểm tra kết quả từ máy chủ
                if (jsonObject.state) {
                    // Cập nhật lại bảng
                    $("tbody").empty().append($.map((jsonObject.response || []), function (item, index) {
                        return `
                            <tr class="dong">
                                <td>${index + 1}</td>
                                <td>${item.ma_hocphan}</td>
                                <td name=${item.ma_sinhvien}>${item.ma_sinhvien}</td>
                                <td>${item.diem_a}</td>
                                <td>${item.diem_b}</td>
                                <td>${item.diem_c}</td>
                                <td>
                                    <button class="edit"><i class="far fa-edit"></i></button>
                                    <button type="submit" class="delete"><i class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>                    
                        `
                    }))
                    alert(jsonObject.content);
                } else {
                    alert(jsonObject.content);
                }
            },
            error: function (xhr, status, error) {
                // alert('Có lỗi xảy ra khi gửi yêu cầu xóa dữ liệu.');
            }
        });
    })
});

// Tương tác - Sửa điểm học phần
$("#tools .edit").each(function (item, index) {
    $(this).on('click', function (e) {
        e.preventDefault();
        // Hiện thị dữ liệu 
        var mhp = $(this).closest('.dong').find("td:nth-child(2)").text(),
            msv = $(this).closest('.dong').find("td:nth-child(3)").text(),
            a = $(this).closest('.dong').find("td:nth-child(4)").text(),
            b = $(this).closest('.dong').find("td:nth-child(5)").text(),
            c = $(this).closest('.dong').find("td:nth-child(6)").text();
        $(".titleTool").text('Sửa thông tin điểm học phần');
        $("#handlePoint").find('select[name="mhp"]').val(mhp);
        $("#handlePoint").find('input[name="msv"]').val(msv);
        $("#handlePoint").find('input[name="diemA"]').val(a);
        $("#handlePoint").find('input[name="diemB"]').val(b);
        $("#handlePoint").find('input[name="diemC"]').val(c);
        $("#handlePoint").find('input[name="submit"]').val("Chỉnh sửa");

        // Không được phép sửa mhp and msv
        $("#handlePoint").find('select[name="mhp"]').attr('disabled', true);
        $("#handlePoint").find('input[name="msv"]').attr('disabled', true)
    })
});

// Đổi mật khẩu
$("#changePasswordForm").submit(function (e) {
    e.preventDefault();
    var email = $("#email").val();
    var oldPassword = $("#oldPassword").val();
    var newPassword = $("#newPassword").val();

    console.log(email, oldPassword, newPassword);

    $.ajax({
        type: "POST",
        url: "http://localhost/manage_student/admin/change_password.php",
        data: {
            email: email,
            oldPassword: oldPassword,
            newPassword: newPassword
        },
        // dataType: "json",
        success: function (response) {
            const jsonObject = JSON.parse(response);
            if (jsonObject.state) {
                alert(jsonObject.content);
            } else {
                alert(jsonObject.content);
            }
        },
        error: function (xhr, status, error) {
            alert("Có lỗi xảy ra khi xử lý yêu cầu.");
        }
    });
});

$(document).ready(function () {
    $("#thongKe").hide();
    $("#quanlyDiem").show();
    $("#changePass").hide();
});

$(".linkThongKe").click(function () {
    $("#thongKe").show();
    $("#quanlyDiem").hide();
    $("#changePass").hide();
});

$(".linkQLDiem").click(function () {
    $("#thongKe").hide();
    $("#quanlyDiem").show();
    $("#changePass").hide();
});

$(".linkchangePass").click(function () {
    $("#thongKe").hide();
    $("#quanlyDiem").hide();
    $("#changePass").show();
})