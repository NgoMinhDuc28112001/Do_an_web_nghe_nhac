<?php
    $sqlRemixNoUser = "SELECT
    songs.*,
    artists.artistName
    FROM songs
    inner join songartist on songs.id = songartist.songID
    inner join artists on songartist.artistID = artists.id
    where songs.kindMusic = 'remix'";

    $stmRemixNoUser = $connect -> prepare($sqlRemixNoUser);

    $stmRemixNoUser -> execute();

    $resultRemixNoUser = $stmRemixNoUser -> fetchAll(PDO::FETCH_ASSOC);

    $newResultRemixNoUser = [];

    foreach($resultRemixNoUser as $item)
    {
        $id = $item['id'];
        if (!isset($newResultRemixNoUser[$id])) {
            // Nếu chưa có mảng với 'id' này, tạo mới
            $newResultRemixNoUser[$id] = $item;
        } else {
            // Nếu đã có mảng với 'id' này, nối giá trị 'artistName'
            $newResultRemixNoUser[$id]['artistName'] = $newResultRemixNoUser[$id]['artistName'].', ' . $item['artistName'];
        }
    }
    
    $newResultRemixNoUser = array_values($newResultRemixNoUser);

    // echo "<pre>";
    // print_r($newResultRemixNoUser);
    // echo "<pre>";
?>