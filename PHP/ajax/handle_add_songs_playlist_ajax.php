<?php

    include('../mySQL/connect.php');
    
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        
        if(isset($_POST['songID']) && isset($_POST['playlistID']))
        {
            $songID = $_POST['songID'];

            $playlistID = $_POST['playlistID'];

            $playlistName = $_POST['playlistName'];

            // Kiểm tra, nếu bài hát đã có trong playlist rồi thì sẽ không cho người dùng thêm
            $sqlCheckSongPlaylist = "SELECT * FROM playlistsong where playlistsong.songID = {$songID} and playlistsong.playlistID = {$playlistID}";

            $stmCheckSongPlaylist = $connect -> prepare($sqlCheckSongPlaylist);

            $stmCheckSongPlaylist -> execute();

            $resultCheckSongPlaylist = $stmCheckSongPlaylist -> fetchAll(PDO::FETCH_ASSOC);

            if(count($resultCheckSongPlaylist) > 0)
            {
                echo "Bài hát này đã tồn tại trong playlist {$playlistName}";
            }

            else{

                $sqlAddSongPlaylist = "INSERT INTO playlistsong(playlistID, songID) values(:playlistID,:songID)";
    
                $stmAddSongPlaylist = $connect -> prepare($sqlAddSongPlaylist);
    
                $stmAddSongPlaylist -> bindParam(':playlistID',$playlistID);
                $stmAddSongPlaylist -> bindParam(':songID',$songID);
    
                $stmAddSongPlaylist -> execute();
    
                echo "Đã thêm vào playlist {$playlistName} thành công";
            }

        }
    }

?>