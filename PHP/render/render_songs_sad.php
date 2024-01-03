<?php
    // Render ra các bài hát ứng với từng user
    if(!empty($user))
    {
        $sqlSad = "SELECT
        songs.*,
        artists.artistName,
        1 AS status
        FROM songs
        inner join songartist on songs.id = songartist.songID
        inner join artists on songartist.artistID = artists.id
        LEFT JOIN likesong ON likesong.songID = songs.id
        where songs.kindMusic = 'sad'and likesong.userID = {$_SESSION['user']['id']}

        UNION

        SELECT
        songs.*,
        artists.artistName,
        0 AS status
        FROM songs
        inner join songartist on songs.id = songartist.songID
        inner join artists on songartist.artistID = artists.id
        LEFT JOIN likesong ON likesong.songID = songs.id
        where songs.kindMusic = 'sad' and songs.id NOT IN (SELECT songID FROM likesong WHERE userID = {$_SESSION['user']['id']})
        ";
    
        $stmSad = $connect -> prepare($sqlSad);
    
        $stmSad -> execute();
    
        $resultSad = $stmSad -> fetchAll(PDO::FETCH_ASSOC);
    
        $newResultSad = [];
    
        foreach($resultSad as $item)
        {
            $id = $item['id'];
            if (!isset($newResultSad[$id])) {
                // Nếu chưa có mảng với 'id' này, tạo mới
                $newResultSad[$id] = $item;
            } else {
                // Nếu đã có mảng với 'id' này, nối giá trị 'artistName'
                $newResultSad[$id]['artistName'] = $newResultSad[$id]['artistName'].', ' . $item['artistName'];
            }
        }
        
        $newResultSad = array_values($newResultSad);

        // echo "<pre>";
        // print_r($newResultSad);
        // echo "<pre>";
    }
    
    
?>