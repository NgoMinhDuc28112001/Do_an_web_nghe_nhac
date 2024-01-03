<?php

    session_start();
    include '../mySQL/connect.php';
    
    if(isset($_SESSION['user'])){
        $sqlRenderMediaPlayer = "SELECT
        songs.*,
        artists.artistName
        from songs
        inner join songartist on songs.id = songartist.songID
        inner join artists on songartist.artistID = artists.id
        inner join mediaplayer on songs.id = mediaplayer.songID
        where mediaplayer.userID = {$_SESSION['user']['id']}
        ";

        $stmRenderMediaPlayer = $connect -> prepare($sqlRenderMediaPlayer);

        $stmRenderMediaPlayer -> execute();

        $resultRenderMediaPlayer = $stmRenderMediaPlayer -> fetchAll(PDO::FETCH_ASSOC);

        $newResultRenderMediaPlayer = [];

        foreach($resultRenderMediaPlayer as $item)
        {
            $id = $item['id'];
            if (!isset($newResultRenderMediaPlayer[$id])) {
                // Nếu chưa có mảng với 'id' này, tạo mới
                $newResultRenderMediaPlayer[$id] = $item;
            } else {
                // Nếu đã có mảng với 'id' này, nối giá trị 'artistName'
                $newResultRenderMediaPlayer[$id]['artistName'] = $newResultRenderMediaPlayer[$id]['artistName'].', ' . $item['artistName'];
            }
        }
        
        $newResultRenderMediaPlayer = array_values($newResultRenderMediaPlayer);

        header('Content-Type: application/json');
        echo json_encode($newResultRenderMediaPlayer);

    }
    else{
        return;
    }

?>