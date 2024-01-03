// Sử dụng jQuery để bắt sự kiện click
$(document).on('click', '.liked .fa-solid.fa-heart', function () {
    // Lấy ID từ thuộc tính data-id để lấy ra id bài hát
    var songID = $(this).data('id');

    var _this = this;
    
    // Gửi yêu cầu xóa đến server bằng AJAX
    $.ajax({
        url: '../PHP/ajax/handle_delete_likeSong_ajax.php', // Đường dẫn đến file xử lý xóa
        type: 'POST',
        data: {songID: songID}, // Dữ liệu gửi đi, trong trường hợp này là ID của bài hát trong thư viện cần xóa
        success: function (response) {
            alert(response);
            location.reload();
        },
        error: function (error) {
            // Xử lý lỗi nếu có
            console.log('Error:', error);
        }
    });
});