<?php

    include('../mySQL/connect.php');
    
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        
        if(isset($_POST['songID']) && isset($_POST['playlistID']) && isset($_POST['playlistName']))
        {
            $songID = $_POST['songID'];

            $playlistID = $_POST['playlistID'];

            $playlistName = $_POST['playlistName'];

            $sqlDeleteSongPlaylist = "DELETE FROM playlistsong where playlistsong.playlistID = {$playlistID} and playlistsong.songID = {$songID}";

            $stmDeleteSongPlaylist = $connect -> prepare($sqlDeleteSongPlaylist);

            $stmDeleteSongPlaylist -> execute();

            echo "Đã xóa bài hát thành công khỏi playlist {$playlistName}";

        }
    }

?>