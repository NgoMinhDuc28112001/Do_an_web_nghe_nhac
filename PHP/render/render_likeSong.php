<?php
    if(isset($_SESSION['user'])){
        $sqlRenderLikeSong = "SELECT
        songs.*,
        artists.artistName
        from songs
        inner join songartist on songs.id = songartist.songID
        inner join artists on songartist.artistID = artists.id
        inner join likesong on songs.id = likesong.songID
        where likesong.userID = {$_SESSION['user']['id']}
        ";

        $stmRenderLikeSong = $connect -> prepare($sqlRenderLikeSong);

        $stmRenderLikeSong -> execute();

        $resultRenderLikeSong = $stmRenderLikeSong -> fetchAll(PDO::FETCH_ASSOC);

        $newResultRenderLikeSong = [];

        foreach($resultRenderLikeSong as $item)
        {
            $id = $item['id'];
            if (!isset($newResultRenderLikeSong[$id])) {
                // Nếu chưa có mảng với 'id' này, tạo mới
                $newResultRenderLikeSong[$id] = $item;
            } else {
                // Nếu đã có mảng với 'id' này, nối giá trị 'artistName'
                $newResultRenderLikeSong[$id]['artistName'] = $newResultRenderLikeSong[$id]['artistName'].', ' . $item['artistName'];
            }
        }
        
        $newResultRenderLikeSong = array_values($newResultRenderLikeSong);

    }
    else{
        return;
    }
?>