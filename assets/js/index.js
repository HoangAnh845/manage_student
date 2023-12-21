
// Truy vấn
$("#formSearch").on("submit", function (e) {
    e.preventDefault();
    var msv = $(".msv").val();
    var mhp = $(".mhp").val();
    // Thực hiện gửi yêu cầu AJAX đến server
    $.ajax({
        type: 'POST',
        url: 'search_results.php',
        data: {
            ma_sinhvien: msv,
            ma_hocphan: mhp
        },
        success: function (response) {
            var resultDiv = $("#result");
            const jsonObj = JSON.parse(response);
            const result = jsonObj.response;

            if (jsonObj.state) {
                resultDiv.empty().append(
                    $("<table>", {
                        style: "padding:20px",
                        html: `
                        Mã sinh viên: ${result['ma_sinhvien']}<br>
                        Mã học phần: ${result['ma_hocphan']}<br>
                        A: ${result['diem_a']}<br>
                        B: ${result['diem_b']}<br>
                        C: ${result['diem_c']}<br>
                        `
                    })
                )
            } else {
                resultDiv.empty().append(
                    $("<div>", { style: "padding:20px;", text: jsonObj.content })
                )
            }

            $(".search").hide();
            $("#result").show();
        },
        error: function (xhr, status, error) {
            // alert("Đã xảy ra lỗi khi gửi yêu cầu.");
        }
    });
});

// Login
$("#formLogin").submit(function (e) {
    e.preventDefault();
    var email = $("#email").val();
    var password = $("#password").val();

    // Gửi dữ liệu lên máy chủ bằng Ajax
    $.ajax({
        type: 'POST',
        url: 'handle_login.php', // Đường dẫn tới file xử lý đăng nhập
        data: {
            email: email,
            msv: password
        },
        success: function (response) {            
            const jsonObject = JSON.parse(response) || {};
            if (jsonObject.state) {
                alert(jsonObject.content);
                // Thực hiện chuyển hướng sang liên kết khác
                window.location.href = "http://localhost/manage_student/pages/dashborad.php";
            } else {
                alert(jsonObject.content);
            }
        },
        error: function (xhr, status, error) {
            // Hiển thị thông báo lỗi nếu có lỗi trong quá trình gửi yêu cầu Ajax
            $("#message").text("Có lỗi xảy ra khi gửi yêu cầu đăng nhập.");
        }
    });
});

/* Điều hướng */
$(document).ready(function () {
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
$("#right").click(function () {
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
$("#left").click(function () {
    $(".s1class").css({
        "color": "#EE9BA3"
    });
    $(".s2class").css({
        "color": "#748194"
    });

    $("#result").hide();
    $(".login").show();
    $(".search").hide();
});
