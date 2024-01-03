<?php
    if($_SERVER['REQUEST_METHOD'] === 'GET')
    {
        if(isset($_GET['playlistID']))
        {
            $playlistID = $_GET['playlistID'];

            $sqlGetSongPlaylist = "SELECT 
                songs.*, artists.artistName 
                from songs
                inner join songartist on songs.id = songartist.songID
                inner join artists on artists.id = songartist.artistID
                inner join playlistsong on playlistsong.songID = songs.id
                where playlistsong.playlistID = {$playlistID}";

            $stmGetSongPlaylist = $connect -> prepare($sqlGetSongPlaylist);

            $stmGetSongPlaylist -> execute();

            $resultGetSongPlaylist = $stmGetSongPlaylist -> fetchAll(PDO::FETCH_ASSOC);

            $newResultGetSongPlaylist = [];
    
            foreach($resultGetSongPlaylist as $item)
            {
                $id = $item['id'];
                if (!isset($newResultGetSongPlaylist[$id])) {
                    // Nếu chưa có mảng với 'id' này, tạo mới
                    $newResultGetSongPlaylist[$id] = $item;
                } else {
                    // Nếu đã có mảng với 'id' này, nối giá trị 'artistName'
                    $newResultGetSongPlaylist[$id]['artistName'] = $newResultGetSongPlaylist[$id]['artistName'].', ' . $item['artistName'];
                }
            }
        
            $newResultGetSongPlaylist = array_values($newResultGetSongPlaylist);

            // echo '<pre>';
            // print_r($newResultGetSongPlaylist);
            // echo '<pre>';
        }
    }
?>