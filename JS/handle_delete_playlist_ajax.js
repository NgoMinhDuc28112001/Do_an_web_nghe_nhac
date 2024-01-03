// Sử dụng jQuery để bắt sự kiện click
$(document).on('click', '.content__playlist-content-items-block-icon-items--left', function () {
    // Lấy ID từ thuộc tính data-id
    var playlistId = $(this).data('id');

    var _this = this;
    
    // Gửi yêu cầu xóa đến server bằng AJAX
    $.ajax({
        url: '../PHP/ajax/handle_delete_playlist_ajax.php', // Đường dẫn đến file xử lý xóa
        type: 'POST',
        data: {id: playlistId}, // Dữ liệu gửi đi, trong trường hợp này là ID của playlist cần xóa
        success: function (response) {
            $(_this).closest('.content__playlist-content-items').remove();
        },
        error: function (error) {
            // Xử lý lỗi nếu có
            console.log('Error:', error);
        }
    });
});