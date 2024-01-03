<?php

    session_start();
    include '../mySQL/connect.php';    

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if(!empty($_SESSION['user']))
        {
            if(isset($_POST['songID']))
            {
                $songID = $_POST['songID'];
                $userID = $_SESSION['user']['id'];
    
                // Kiểm tra xem bài hát đã tồn tại hay chưa
                $checkSongLibrary = "SELECT
                    * 
                    from  likesong 
                    where likesong.songID = $songID and likesong.userID = $userID
                ";
                
                $stmCheckSongLibrary = $connect -> prepare($checkSongLibrary);
    
                $stmCheckSongLibrary -> execute();
    
                $resultCheckSongLibrary = $stmCheckSongLibrary -> fetchAll(PDO::FETCH_ASSOC);
    
                if(count($resultCheckSongLibrary) === 0)
                {
                    echo "Đã thêm bài hát vào thư viện thành công";
                    $sqlAddSongLibrary = "INSERT INTO
                        likesong(songID,userID) 
                        VALUES
                        ({$songID},{$userID})
                    ";
    
                    $stmAddSongLibrary = $connect -> prepare($sqlAddSongLibrary);
    
                    $stmAddSongLibrary -> execute();
                }
                else{
                    echo "Bài hát đã tồn tại trong thư viện";
                }
            }
        }
    }

?>