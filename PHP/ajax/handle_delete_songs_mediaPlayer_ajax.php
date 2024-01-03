<?php

    session_start();
    include '../mySQL/connect.php';


    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if (isset($_POST['songID'])) {
            // Lấy ID từ yêu cầu POST
            $songId = $_POST['songID'];

            $userId = $_SESSION['user']['id'];
        
            // Thực hiện truy vấn xóa trong cơ sở dữ liệu
            $stmt = $connect->prepare("DELETE FROM mediaplayer WHERE mediaplayer.songID = :songID and mediaplayer.userID = :userID");
            
            $stmt-> bindParam(':songID', $songId);
            $stmt-> bindParam(':userID', $userId);
    
            $stmt-> execute();

            echo "Xóa bài hát khỏi media player thành công";
    
        }
    }

?>