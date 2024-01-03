<?php

    // include '../mySQL/connect.php';
    $sqlHot2023NoUser = "SELECT
    songs.*,
    artists.artistName
    FROM songs
    inner join songartist on songs.id = songartist.songID
    inner join artists on songartist.artistID = artists.id
    where songs.kindMusic = 'Hot2023'";

    $stmHot2023NoUser = $connect -> prepare($sqlHot2023NoUser);

    $stmHot2023NoUser -> execute();

    $resultHot2023NoUser = $stmHot2023NoUser -> fetchAll(PDO::FETCH_ASSOC);

    $newResultHot2023NoUser = [];

    foreach($resultHot2023NoUser as $item)
    {
        $id = $item['id'];
        if (!isset($newResultHot2023NoUser[$id])) {
            // Nếu chưa có mảng với 'id' này, tạo mới
            $newResultHot2023NoUser[$id] = $item;
        } else {
            // Nếu đã có mảng với 'id' này, nối giá trị 'artistName'
            $newResultHot2023NoUser[$id]['artistName'] = $newResultHot2023NoUser[$id]['artistName'].', ' . $item['artistName'];
        }
    }
    
    $newResultHot2023NoUser = array_values($newResultHot2023NoUser);

    // echo '<pre>';
    // print_r($newResultHot2023NoUser);
    // echo '<pre>';

?>