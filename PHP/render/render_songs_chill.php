<?php
    // session_start();
    // include '../mySQL/connect.php';
    // Render ra các bài hát ứng với từng user
    if(!empty($user))
    {
        $sqlChill = "SELECT
        songs.*,
        artists.artistName,
        1 AS status
        FROM songs
        inner join songartist on songs.id = songartist.songID
        inner join artists on songartist.artistID = artists.id
        LEFT JOIN likesong ON likesong.songID = songs.id
        where songs.kindMusic = 'chill'and likesong.userID = {$_SESSION['user']['id']}

        UNION

        SELECT
        songs.*,
        artists.artistName,
        0 AS status
        FROM songs
        inner join songartist on songs.id = songartist.songID
        inner join artists on songartist.artistID = artists.id
        LEFT JOIN likesong ON likesong.songID = songs.id
        where songs.kindMusic = 'chill' and songs.id NOT IN (SELECT songID FROM likesong WHERE userID = {$_SESSION['user']['id']})
        ";
    
        $stmChill = $connect -> prepare($sqlChill);
    
        $stmChill -> execute();
    
        $resultChill = $stmChill -> fetchAll(PDO::FETCH_ASSOC);
    
        $newResultChill = [];
    
        foreach($resultChill as $item)
        {
            $id = $item['id'];
            if (!isset($newResultChill[$id])) {
                // Nếu chưa có mảng với 'id' này, tạo mới
                $newResultChill[$id] = $item;
            } else {
                // Nếu đã có mảng với 'id' này, nối giá trị 'artistName'
                $newResultChill[$id]['artistName'] = $newResultChill[$id]['artistName'].', ' . $item['artistName'];
            }
        }
        
        $newResultChill = array_values($newResultChill);

        // echo '<pre>';
        // print_r($newResultChill);
        // echo '<pre>';
    }
    
    
?>