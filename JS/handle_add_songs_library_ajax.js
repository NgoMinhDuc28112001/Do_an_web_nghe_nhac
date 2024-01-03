$(document).ready(function() {
    // Xử lý khi người dùng nhấn vào tim
    $(".liked .fa-regular.fa-heart").click(function() {
        var songID = $(this).data("id");

        $.ajax({
            type: "POST",
            url: "../PHP/ajax/handle_add_songs_library_ajax.php", // Tên tệp xử lý
            data: { songID: songID },
            success: function(response) {
                alert(response); // Hiển thị thông báo thành công hoặc thông báo lỗi
                location.reload();
            }
        });
    });
});