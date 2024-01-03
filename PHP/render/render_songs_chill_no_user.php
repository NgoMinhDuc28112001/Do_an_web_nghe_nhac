<?php

    // include '../mySQL/connect.php';
    $sqlChillNoUser = "SELECT
    songs.*,
    artists.artistName
    FROM songs
    inner join songartist on songs.id = songartist.songID
    inner join artists on songartist.artistID = artists.id
    where songs.kindMusic = 'chill'";

    $stmChillNoUser = $connect -> prepare($sqlChillNoUser);

    $stmChillNoUser -> execute();

    $resultChillNoUser = $stmChillNoUser -> fetchAll(PDO::FETCH_ASSOC);

    $newResultChillNoUser = [];

    foreach($resultChillNoUser as $item)
    {
        $id = $item['id'];
        if (!isset($newResultChillNoUser[$id])) {
            // Nếu chưa có mảng với 'id' này, tạo mới
            $newResultChillNoUser[$id] = $item;
        } else {
            // Nếu đã có mảng với 'id' này, nối giá trị 'artistName'
            $newResultChillNoUser[$id]['artistName'] = $newResultChillNoUser[$id]['artistName'].', ' . $item['artistName'];
        }
    }
    
    $newResultChillNoUser = array_values($newResultChillNoUser);

    // echo '<pre>';
    // print_r($newResultChillNoUser);
    // echo '<pre>';

?>