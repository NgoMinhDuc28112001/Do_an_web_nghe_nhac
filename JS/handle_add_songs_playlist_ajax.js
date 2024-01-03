$(document).ready(function() {
    // Xử lý khi người dùng nhấn vào thêm bài hát vào playlist
    $(".item--addPlaylist .fa-solid.fa-plus").click(function() {
        var songID = $(this).data("id-song");
        var playlistID = $(this).data("id-playlist");
        var playlistName = $(this).data("name-playlist");

        // console.log(songID);
        // console.log(playlistID);

        $.ajax({
            type: "POST",
            url: "../PHP/ajax/handle_add_songs_playlist_ajax.php", // Tên tệp xử lý
            data: { songID: songID , playlistID: playlistID, playlistName: playlistName },
            success: function(response) {
                alert(response); // Hiển thị thông báo thành công hoặc thông báo lỗi
                location.reload();
            }
        });
    });
});