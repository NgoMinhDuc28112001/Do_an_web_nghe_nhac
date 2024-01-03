<?php
    // Render ra các bài hát ứng với từng user
    if(!empty($user))
    {
        $sqlHot2023 = "SELECT
        songs.*,
        artists.artistName,
        1 AS status
        FROM songs
        inner join songartist on songs.id = songartist.songID
        inner join artists on songartist.artistID = artists.id
        LEFT JOIN likesong ON likesong.songID = songs.id
        where songs.kindMusic = 'Hot2023'and likesong.userID = {$_SESSION['user']['id']}

        UNION

        SELECT
        songs.*,
        artists.artistName,
        0 AS status
        FROM songs
        inner join songartist on songs.id = songartist.songID
        inner join artists on songartist.artistID = artists.id
        LEFT JOIN likesong ON likesong.songID = songs.id
        where songs.kindMusic = 'Hot2023' and songs.id NOT IN (SELECT songID FROM likesong WHERE userID = {$_SESSION['user']['id']})
        ";
    
        $stmHot2023 = $connect -> prepare($sqlHot2023);
    
        $stmHot2023 -> execute();
    
        $resultHot2023 = $stmHot2023 -> fetchAll(PDO::FETCH_ASSOC);
    
        $newResultHot2023 = [];
    
        foreach($resultHot2023 as $item)
        {
            $id = $item['id'];
            if (!isset($newResultHot2023[$id])) {
                // Nếu chưa có mảng với 'id' này, tạo mới
                $newResultHot2023[$id] = $item;
            } else {
                // Nếu đã có mảng với 'id' này, nối giá trị 'artistName'
                $newResultHot2023[$id]['artistName'] = $newResultHot2023[$id]['artistName'].', ' . $item['artistName'];
            }
        }
        
        $newResultHot2023 = array_values($newResultHot2023);

        // echo "<pre>";
        // print_r($newResultHot2023);
        // echo "<pre>";
    }
?>