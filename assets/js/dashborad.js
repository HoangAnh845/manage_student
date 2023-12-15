// Khởi tạo biến đếm số lần click
var clickCount = 0;

// Thêm/Sửa điểm học phần
$("#handlePoint").on('submit', function (e) {
    e.preventDefault();
    var dataHP = {
        add_msv: $(this).find('input[name="msv"]').val(),
        add_mhp: $(this).find('select[name="mhp"]').val(),
        add_a: $(this).find('input[name="diemA"]').val(),
        add_b: $(this).find('input[name="diemB"]').val(),
        add_c: $(this).find('input[name="diemC"]').val()
    };

    // Sửa điểm học phần
    if ($(this).find('input[name="submit"]').val() == "Chỉnh sửa") {
        $.ajax({
            type: 'POST',
            url: 'admin/edit_point.php',
            data: dataHP,
            // dataType: 'json', // Kiểu dữ liệu trả về từ server (json)
            success: function (response) {
                const jsonObject = JSON.parse(response) || {};
                // Kiểm tra kết quả từ máy chủ
                if (jsonObject.success) {
                    alert(jsonObject.message);
                    $(".titleTool").text('Thêm thông tin điểm học phần');

                    $("#handlePoint").find('select[name="mhp"]').attr('disabled', false);
                    $("#handlePoint").find('input[name="msv"]').attr('disabled', false)

                    // Gắn giá trị mới
                    $(`#tools table [name=${jsonObject.msv}]`).parent().find("td:nth-child(4)").text(jsonObject.a) // a
                    $(`#tools table [name=${jsonObject.msv}]`).parent().find("td:nth-child(5)").text(jsonObject.b) // b
                    $(`#tools table [name=${jsonObject.msv}]`).parent().find("td:nth-child(6)").text(jsonObject.c) // c
                } else {
                    alert(jsonObject.message);
                }
            },
            error: function (xhr, status, error) {
                // alert('Có lỗi xảy ra khi gửi yêu cầu cập nhật dữ liệu.');
            }
        });
    }

    // Thêm mới học phần
    else {
        $.ajax({
            type: 'POST',
            url: 'admin/add_point.php',
            data: dataHP,
            success: function (response) {
                const jsonObject = JSON.parse(response);
                // Kiểm tra kết quả từ máy chủ
                if (jsonObject.success) {
                    alert(jsonObject.message);
                    // append thêm row on table
                    $("tbody").prepend(`
                        <tr class="dong">
                            <td>1</td>
                            <td>${jsonObject.mhp}</td>
                            <td name=${jsonObject.msv}>${jsonObject.msv}</td>
                            <td>${jsonObject.a}</td>
                            <td>${jsonObject.b}</td>
                            <td>${jsonObject.c}</td>
                            <td>
                                <button class="edit"><i class="far fa-edit"></i></button>
                                <button type="submit" class="delete"><i class="far fa-trash-alt"></i></button>
                            </td>
                        </tr>                    
                    `)
                } else {
                    alert(jsonObject.message);
                }
            },
            error: function (xhr, status, error) {
                // alert('Có lỗi xảy ra khi gửi yêu cầu thêm dữ liệu.');
            }
        });
    }

    $("#handlePoint").find('select').val('');
    $("#handlePoint").find('input').val('');
    $("#handlePoint").find('input[name="submit"]').val("Thêm mới");

});

// Xóa điểm học phần
$("#tools .delete").each(function (item, index) {
    $(this).on('click', function (e) {
        e.preventDefault(); // Ngăn chặn việc tải lại trang khi submit form
        var ths = $(this);
        var msv = $(this).closest('.dong').find("td[name]").text(); // Lấy giá trị của thuộc tính data-msv

        // Thực hiện AJAX để gửi yêu cầu xóa dữ liệu lên máy chủ
        $.ajax({
            type: 'POST',
            url: 'admin/delete_point.php', // Điền đúng đường dẫn tới file themDiem.php
            data: {
                delete_msv: msv
            },
            // dataType: 'json',
            success: function (response) {
                const jsonObject = JSON.parse(response);
                // Kiểm tra kết quả từ máy chủ
                if (jsonObject.success) {
                    // Xóa dòng chứa dữ liệu đã bị xóa trong bảng HTML
                    ths.closest(".dong").remove();
                    alert(jsonObject.message);
                } else {
                    alert(jsonObject.message);
                }
            },
            error: function (xhr, status, error) {
                alert('Có lỗi xảy ra khi gửi yêu cầu xóa dữ liệu.');
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
        url: "admin/change_password.php",
        data: {
            email: email,
            oldPassword: oldPassword,
            newPassword: newPassword
        },
        // dataType: "json",
        success: function (response) {
            // Chuyển chuỗi JSON thành đối tượng JavaScript
            const jsonObject = JSON.parse(response);
            console.log('--- DATA ---', response);

            if (jsonObject.success) {
                alert(jsonObject.message);
                // $("#message").text(jsonObject.message);
            } else {
                alert(jsonObject.message);
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