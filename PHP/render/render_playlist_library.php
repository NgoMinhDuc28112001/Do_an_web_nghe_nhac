<?php
    if(!empty($user)){
        // render ra những dữ liệu của user hiện tại
        $sqlRenderPlaylist = 
        "SELECT users.id as userID,users.userName,playlists.id as playlistID,playlists.playlistName,playlists.playlistImage 
        from playlists
        inner join users on users.id = playlists.userID 
        where users.id = {$_SESSION['user']['id']}";
        
        $statementRenderPlaylist = $connect -> prepare($sqlRenderPlaylist);
        $statementRenderPlaylist -> execute();
        $resultRenderPlaylist = $statementRenderPlaylist -> fetchAll(PDO::FETCH_ASSOC);
    }


?>