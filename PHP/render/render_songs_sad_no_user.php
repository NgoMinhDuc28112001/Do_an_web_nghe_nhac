<?php
    $sqlSadNoUser = "SELECT
    songs.*,
    artists.artistName
    FROM songs
    inner join songartist on songs.id = songartist.songID
    inner join artists on songartist.artistID = artists.id
    where songs.kindMusic = 'sad'";

    $stmSadNoUser = $connect -> prepare($sqlSadNoUser);

    $stmSadNoUser -> execute();

    $resultSadNoUser = $stmSadNoUser -> fetchAll(PDO::FETCH_ASSOC);

    $newResultSadNoUser = [];

    foreach($resultSadNoUser as $item)
    {
        $id = $item['id'];
        if (!isset($newResultSadNoUser[$id])) {
            // Nếu chưa có mảng với 'id' này, tạo mới
            $newResultSadNoUser[$id] = $item;
        } else {
            // Nếu đã có mảng với 'id' này, nối giá trị 'artistName'
            $newResultSadNoUser[$id]['artistName'] = $newResultSadNoUser[$id]['artistName'].', ' . $item['artistName'];
        }
    }
    
    $newResultSadNoUser = array_values($newResultSadNoUser);

    // echo '<pre>';
    // print_r($newResultSadNoUser);
    // echo '<pre>';
?>