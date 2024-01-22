<?php

    include '../mySQL/connect.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if (isset($_POST['id'])) {
            // Lấy ID từ yêu cầu POST
            $playlistId = $_POST['id'];

            // Kiểm tra xem trong playlist muốn xóa có bài hát nào không, nếu có thì sẽ xóa hết bài hát
            // Nếu không có bài hát nào thì sẽ thực hiện xóa playlist luôn
            $sqlCheckSongPlaylist = "SELECT * from playlistsong where playlistsong.playlistID = :id";
            $stmCheckSongPlaylist = $connect -> prepare($sqlCheckSongPlaylist);

            $stmCheckSongPlaylist -> bindParam(':id', $playlistId);
            $stmCheckSongPlaylist -> execute();

            $resultCheckSongPlaylist = $stmCheckSongPlaylist -> fetchAll(PDO::FETCH_ASSOC);

            // echo '<pre>';
            // print_r($resultCheckSongPlaylist);
            // echo '<pre>';

            // echo count($resultCheckSongPlaylist);

            if(count($resultCheckSongPlaylist) > 0)
            {
                $sqlDeleteSongPlaylist = "DELETE FROM playlistsong where playlistsong.playlistID = :id";
                $stmDeleteSongPlaylist = $connect -> prepare($sqlDeleteSongPlaylist);

                $stmDeleteSongPlaylist -> bindParam(':id',$playlistId);

                $stmDeleteSongPlaylist -> execute();
            }
        
            // Thực hiện truy vấn xóa trong cơ sở dữ liệu
            $stmt = $connect->prepare("DELETE FROM playlists WHERE playlists.id = :id");
            $stmt-> bindParam(':id', $playlistId);
    
            $stmt-> execute();

            echo "Xóa playlist thành công";
    
        }
    }
?>