<?php

    session_start();
    include '../mySQL/connect.php'; 

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if(isset($_POST['songID']))
        {
            $songID = $_POST['songID'];
            // Truy vấn để xóa đi bài hát bên trong thư viện (trong likesong)

            $sqlDeleteLikeSong = "DELETE
                FROM likesong
                WHERE 
                likesong.songID = {$songID} and likesong.userID = {$_SESSION['user']['id']}";
            
            $stmDeleteLikeSong = $connect -> prepare($sqlDeleteLikeSong);

            $stmDeleteLikeSong -> execute();

            echo "Bài hát đã được xóa thành công khỏi thư viện";

        }
    }

?>