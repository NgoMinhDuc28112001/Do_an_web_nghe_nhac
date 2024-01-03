<?php
    session_start();
    include '../mySQL/connect.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(!empty($_SESSION['user']))
        {
            if(isset($_POST['songID']))
            {
                $songID = $_POST['songID'];
                $userID = $_SESSION['user']['id'];

                // Kiểm tra xem bài hát đã tồn tại trong bằng mediaplayer hay chưa
                $checkSongMediaPlayer = "SELECT * from mediaplayer where mediaplayer.songID = {$songID} and mediaplayer.userID = {$userID}";

                $stmCheckSongMediaPlayer = $connect -> prepare($checkSongMediaPlayer);

                $stmCheckSongMediaPlayer -> execute();

                $resultCheckSongMediaPlayer = $stmCheckSongMediaPlayer -> fetchAll(PDO::FETCH_ASSOC);

                if(count($resultCheckSongMediaPlayer) === 0)
                {
                    // Nếu bài hát đó không có trong mediaplayer thì sẽ thêm vào mediaplayer
                    echo "Đã thêm vào mediaplayer thành công";

                    $sqlAddSongMediaPlayer = "INSERT INTO mediaplayer(songID,userID) values(:songID,:userID)";

                    $stmAddSongMediaPlayer = $connect -> prepare($sqlAddSongMediaPlayer);

                    $stmAddSongMediaPlayer -> bindParam(':songID',$songID);
                    $stmAddSongMediaPlayer -> bindParam(':userID',$userID);

                    $stmAddSongMediaPlayer -> execute();
                }
                else{
                    echo "Bài hát này đã có trong mediaplayer";
                }

            }
        }
    }
?>