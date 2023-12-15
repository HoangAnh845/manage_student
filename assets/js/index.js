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
            msv: msv,
            mhp: mhp
        },
        success: function (response) {
            var resultDiv = $("#result");
            resultDiv.empty().append(
                $("<div>", {
                    style: "padding:20px",
                    html: response
                })
            )
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
            password: password
        },
        // dataType: 'json',
        success: function (response) {
            const jsonObject = JSON.parse(response) || {};
            if (jsonObject.success) {
                // Hiển thị thông báo thành công
                alert(jsonObject.message);
                // Thực hiện chuyển hướng sang liên kết khác
                window.location.href = "http://localhost/manage_student/dashborad.php";
            } else {
                // Hiển thị thông báo lỗi
                alert(jsonObject.message);
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

    $(".login").show();
    $(".search").hide();
});
