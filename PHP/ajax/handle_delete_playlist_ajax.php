<?php

    include '../mySQL/connect.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if (isset($_POST['id'])) {
            // Lấy ID từ yêu cầu POST
            $playlistId = $_POST['id'];
        
            // Thực hiện truy vấn xóa trong cơ sở dữ liệu
            $stmt = $connect->prepare("DELETE FROM playlists WHERE playlists.id = :id");
            $stmt-> bindParam(':id', $playlistId);
    
            $stmt-> execute();
    
        }
    }
?>