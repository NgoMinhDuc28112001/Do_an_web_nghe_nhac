<?php
    // Render ra các bài hát ứng với từng user
    if(!empty($user))
    {
        $sqlRemix = "SELECT
        songs.*,
        artists.artistName,
        1 AS status
        FROM songs
        inner join songartist on songs.id = songartist.songID
        inner join artists on songartist.artistID = artists.id
        LEFT JOIN likesong ON likesong.songID = songs.id
        where songs.kindMusic = 'remix'and likesong.userID = {$_SESSION['user']['id']}

        UNION

        SELECT
        songs.*,
        artists.artistName,
        0 AS status
        FROM songs
        inner join songartist on songs.id = songartist.songID
        inner join artists on songartist.artistID = artists.id
        LEFT JOIN likesong ON likesong.songID = songs.id
        where songs.kindMusic = 'remix' and songs.id NOT IN (SELECT songID FROM likesong WHERE userID = {$_SESSION['user']['id']})
        ";
    
        $stmRemix = $connect -> prepare($sqlRemix);
    
        $stmRemix -> execute();
    
        $resultRemix = $stmRemix -> fetchAll(PDO::FETCH_ASSOC);
    
        $newResultRemix = [];
    
        foreach($resultRemix as $item)
        {
            $id = $item['id'];
            if (!isset($newResultRemix[$id])) {
                // Nếu chưa có mảng với 'id' này, tạo mới
                $newResultRemix[$id] = $item;
            } else {
                // Nếu đã có mảng với 'id' này, nối giá trị 'artistName'
                $newResultRemix[$id]['artistName'] = $newResultRemix[$id]['artistName'].', ' . $item['artistName'];
            }
        }
        
        $newResultRemix = array_values($newResultRemix);

        // echo "<pre>";
        // print_r($newResultRemix);
        // echo "<pre>";
    }
?>