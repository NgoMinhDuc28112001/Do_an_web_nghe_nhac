<?php
    include '../PHP/mySQL/connect.php';
    // Đọc nội dung của tệp JSON
    $jsonContentFull = file_get_contents('APIFull.json');

    // Chuyển đổi JSON thành mảng PHP
    $dataArrayFull = json_decode($jsonContentFull, true);

    $sqlDataFullChill = "INSERT INTO 
        songs(id,songName,kindMusic,songImage,Link128,Link320,songImageNew)
        values
        (:id,:songName,:kindMusic,:songImage,:Link128,:Link320,:songImageNew)";

    $stmDataFullChill = $connect -> prepare($sqlDataFullChill);

    for($j = 0; $j < count($dataArrayFull['APIChillNewMost']); $j++)
    {
        $stmDataFullChill -> bindParam(':id',$dataArrayFull['APIChillNewMost'][$j]['id']);
        $stmDataFullChill -> bindParam(':songName',$dataArrayFull['APIChillNewMost'][$j]['titleSong']);
        $stmDataFullChill -> bindParam(':kindMusic',$dataArrayFull['APIChillNewMost'][$j]['kindMusic']);
        $stmDataFullChill -> bindParam(':songImage',$dataArrayFull['APIChillNewMost'][$j]['avatarSong']);
        $stmDataFullChill -> bindValue(':Link128',isset($dataArrayFull['APIChillNewMost'][$j]['mp3Link128']) ? $dataArrayFull['APIChillNewMost'][$j]['mp3Link128'] : null);
        $stmDataFullChill -> bindValue(':Link320',isset($dataArrayFull['APIChillNewMost'][$j]['mp3Link320']) ? $dataArrayFull['APIChillNewMost'][$j]['mp3Link320'] : null);
        $stmDataFullChill -> bindParam(':songImageNew',$dataArrayFull['APIChillNewMost'][$j]['avatarSongNew']);

        $stmDataFullChill -> execute();
    }

    $sqlDataFullSad = "INSERT INTO 
        songs(id,songName,kindMusic,songImage,Link128,Link320,songImageNew)
        values
        (:id,:songName,:kindMusic,:songImage,:Link128,:Link320,:songImageNew)";

    $stmDataFullSad = $connect -> prepare($sqlDataFullSad);

    for($j = 0; $j < count($dataArrayFull['APISadNewMost']); $j++)
    {
        $stmDataFullSad -> bindParam(':id',$dataArrayFull['APISadNewMost'][$j]['id']);
        $stmDataFullSad -> bindParam(':songName',$dataArrayFull['APISadNewMost'][$j]['titleSong']);
        $stmDataFullSad -> bindParam(':kindMusic',$dataArrayFull['APISadNewMost'][$j]['kindMusic']);
        $stmDataFullSad -> bindParam(':songImage',$dataArrayFull['APISadNewMost'][$j]['avatarSong']);
        $stmDataFullSad -> bindValue(':Link128',isset($dataArrayFull['APISadNewMost'][$j]['mp3Link128']) ? $dataArrayFull['APISadNewMost'][$j]['mp3Link128'] : null);
        $stmDataFullSad -> bindValue(':Link320',isset($dataArrayFull['APISadNewMost'][$j]['mp3Link320']) ? $dataArrayFull['APISadNewMost'][$j]['mp3Link320'] : null);
        $stmDataFullSad -> bindParam(':songImageNew',$dataArrayFull['APISadNewMost'][$j]['avatarSongNew']);

        $stmDataFullSad -> execute();
    }

    $sqlDataFullRemix = "INSERT INTO 
        songs(id,songName,kindMusic,songImage,Link128,Link320,songImageNew)
        values
        (:id,:songName,:kindMusic,:songImage,:Link128,:Link320,:songImageNew)";

    $stmDataFullRemix = $connect -> prepare($sqlDataFullRemix);

    for($j = 0; $j < count($dataArrayFull['APIRemixNewMost']); $j++)
    {
        $stmDataFullRemix -> bindParam(':id',$dataArrayFull['APIRemixNewMost'][$j]['id']);
        $stmDataFullRemix -> bindParam(':songName',$dataArrayFull['APIRemixNewMost'][$j]['titleSong']);
        $stmDataFullRemix -> bindParam(':kindMusic',$dataArrayFull['APIRemixNewMost'][$j]['kindMusic']);
        $stmDataFullRemix -> bindParam(':songImage',$dataArrayFull['APIRemixNewMost'][$j]['avatarSong']);
        $stmDataFullRemix -> bindValue(':Link128',isset($dataArrayFull['APIRemixNewMost'][$j]['mp3Link128']) ? $dataArrayFull['APIRemixNewMost'][$j]['mp3Link128'] : null);
        $stmDataFullRemix -> bindValue(':Link320',isset($dataArrayFull['APIRemixNewMost'][$j]['mp3Link320']) ? $dataArrayFull['APIRemixNewMost'][$j]['mp3Link320'] : null);
        $stmDataFullRemix -> bindParam(':songImageNew',$dataArrayFull['APIRemixNewMost'][$j]['avatarSongNew']);

        $stmDataFullRemix -> execute();
    }

    $sqlDataFullHot2023 = "INSERT INTO 
        songs(id,songName,kindMusic,songImage,Link128,Link320,songImageNew)
        values
        (:id,:songName,:kindMusic,:songImage,:Link128,:Link320,:songImageNew)";

    $stmDataFullHot2023 = $connect -> prepare($sqlDataFullHot2023);

    for($j = 0; $j < count($dataArrayFull['APIHot2023NewMost']); $j++)
    {
        $stmDataFullHot2023 -> bindParam(':id',$dataArrayFull['APIHot2023NewMost'][$j]['id']);
        $stmDataFullHot2023 -> bindParam(':songName',$dataArrayFull['APIHot2023NewMost'][$j]['titleSong']);
        $stmDataFullHot2023 -> bindParam(':kindMusic',$dataArrayFull['APIHot2023NewMost'][$j]['kindMusic']);
        $stmDataFullHot2023 -> bindParam(':songImage',$dataArrayFull['APIHot2023NewMost'][$j]['avatarSong']);
        $stmDataFullHot2023 -> bindValue(':Link128',isset($dataArrayFull['APIHot2023NewMost'][$j]['mp3Link128']) ? $dataArrayFull['APIHot2023NewMost'][$j]['mp3Link128'] : null);
        $stmDataFullHot2023 -> bindValue(':Link320',isset($dataArrayFull['APIHot2023NewMost'][$j]['mp3Link320']) ? $dataArrayFull['APIHot2023NewMost'][$j]['mp3Link320'] : null);
        $stmDataFullHot2023 -> bindParam(':songImageNew',$dataArrayFull['APIHot2023NewMost'][$j]['avatarSongNew']);

        $stmDataFullHot2023 -> execute();
    }
    
?>