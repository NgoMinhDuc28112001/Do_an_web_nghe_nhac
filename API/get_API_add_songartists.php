<?php
    include('../PHP/mySQL/connect.php');

    // Đọc nội dung của tệp JSON
    $jsonContentFull = file_get_contents('APIFull.json');

    // Chuyển đổi JSON thành mảng PHP
    $dataArrayFull = json_decode($jsonContentFull, true);

    // Chill
    for($i = 0; $i < count($dataArrayFull['APIChillNewMost']); $i++)
    {
        // Lấy ra tên bài hát
        $nameSong = $dataArrayFull['APIChillNewMost'][$i]['titleSong'];
        // Lấy ra tên của ca sĩ
        $nameArtist = $dataArrayFull['APIChillNewMost'][$i]['nameArtists'];

        // echo $nameSong;
        // echo '<pre>';
        // print_r($nameArtist);
        // echo '<pre>';
        
        // Lấy ra id của bài hát có tên trùng với tên của bài hát ở trên
        $sqlGetTitleSong = "SELECT 
            songs.id 
            from songs 
            where songs.songName like :nameSong";

        $stmGetTitleSong = $connect -> prepare($sqlGetTitleSong);

        $stmGetTitleSong -> bindParam(':nameSong',$nameSong);

        $stmGetTitleSong -> execute();

        $resultGetTitleSong = $stmGetTitleSong -> fetch(PDO::FETCH_ASSOC);

        // echo '<pre>';
        // print_r($resultGetTitleSong);
        // echo '<pre>';

        // Lấy ra id của những ca sĩ trong từng bài hát
        $sqlGetNameSong = "SELECT 
            artists.id
            from artists 
            where artists.artistName like :nameArtist";

        $stmGetNameSong = $connect -> prepare($sqlGetNameSong);

        $nameSongArtist = [];

        for ($j = 0; $j < count($nameArtist); $j++)
        {
            $stmGetNameSong -> bindParam(':nameArtist',$nameArtist[$j]);

            $stmGetNameSong -> execute();

            $resultGetNameSong = $stmGetNameSong -> fetch(PDO::FETCH_ASSOC);

            $nameSongArtist[] = $resultGetNameSong;

        }

        // echo '<pre>';
        // print_r($nameSongArtist);
        // echo '<pre>';

        // thêm id của bài hát và id của các ca sĩ tương ứng vào bảng songartist
        $sqlAddSongArtist = "INSERT INTO songartist(songID,artistID) values(:songID,:artistID)";

        $stmAddSongArtist = $connect -> prepare($sqlAddSongArtist);

        for($j = 0; $j < count($nameSongArtist); $j++)
        {
            $stmAddSongArtist -> bindParam(':songID',$resultGetTitleSong['id']);
            $stmAddSongArtist -> bindParam(':artistID',$nameSongArtist[$j]['id']);

            $stmAddSongArtist -> execute();
        }

    }

    // Sad
    for($i = 0; $i < count($dataArrayFull['APISadNewMost']); $i++)
    {
        // Lấy ra tên bài hát
        $nameSong = $dataArrayFull['APISadNewMost'][$i]['titleSong'];
        // Lấy ra tên của ca sĩ
        $nameArtist = $dataArrayFull['APISadNewMost'][$i]['nameArtists'];
        
        // Lấy ra id của bài hát có tên trùng với tên của bài hát ở trên
        $sqlGetTitleSong = "SELECT 
            songs.id
            from songs 
            where songs.songName like :nameSong";

        $stmGetTitleSong = $connect -> prepare($sqlGetTitleSong);

        $stmGetTitleSong -> bindParam(':nameSong',$nameSong);

        $stmGetTitleSong -> execute();

        $resultGetTitleSong = $stmGetTitleSong -> fetch(PDO::FETCH_ASSOC);

        // echo '<pre>';
        // print_r($resultGetTitleSong);
        // echo '<pre>';

        // Lấy ra id của những ca sĩ trong từng bài hát
        $sqlGetNameSong = "SELECT 
            artists.id
            from artists 
            where artists.artistName like :nameArtist";

        $stmGetNameSong = $connect -> prepare($sqlGetNameSong);

        $nameSongArtist = [];

        for ($j = 0; $j < count($nameArtist); $j++)
        {
            $stmGetNameSong -> bindParam(':nameArtist',$nameArtist[$j]);

            $stmGetNameSong -> execute();

            $resultGetNameSong = $stmGetNameSong -> fetch(PDO::FETCH_ASSOC);

            $nameSongArtist[] = $resultGetNameSong;

        }

        // echo '<pre>';
        // print_r($nameSongArtist);
        // echo '<pre>';

        // thêm id của bài hát và id của các ca sĩ tương ứng vào bảng songartist
        $sqlAddSongArtist = "INSERT INTO songartist(songID,artistID) values(:songID,:artistID)";

        $stmAddSongArtist = $connect -> prepare($sqlAddSongArtist);

        for($j = 0; $j < count($nameSongArtist); $j++)
        {
            $stmAddSongArtist -> bindParam(':songID',$resultGetTitleSong['id']);
            $stmAddSongArtist -> bindParam(':artistID',$nameSongArtist[$j]['id']);

            $stmAddSongArtist -> execute();
        }

    }

    // Remix
    for($i = 0; $i < count($dataArrayFull['APIRemixNewMost']); $i++)
    {
        // Lấy ra tên bài hát
        $nameSong = $dataArrayFull['APIRemixNewMost'][$i]['titleSong'];
        // Lấy ra tên của ca sĩ
        $nameArtist = $dataArrayFull['APIRemixNewMost'][$i]['nameArtists'];
        
        // Lấy ra id của bài hát có tên trùng với tên của bài hát ở trên
        $sqlGetTitleSong = "SELECT 
            songs.id
            from songs 
            where songs.songName like :nameSong";

        $stmGetTitleSong = $connect -> prepare($sqlGetTitleSong);

        $stmGetTitleSong -> bindParam(':nameSong',$nameSong);

        $stmGetTitleSong -> execute();

        $resultGetTitleSong = $stmGetTitleSong -> fetch(PDO::FETCH_ASSOC);

        // echo '<pre>';
        // print_r($resultGetTitleSong);
        // echo '<pre>';

        // Lấy ra id của những ca sĩ trong từng bài hát
        $sqlGetNameSong = "SELECT 
            artists.id
            from artists 
            where artists.artistName like :nameArtist";

        $stmGetNameSong = $connect -> prepare($sqlGetNameSong);

        $nameSongArtist = [];

        for ($j = 0; $j < count($nameArtist); $j++)
        {
            $stmGetNameSong -> bindParam(':nameArtist',$nameArtist[$j]);

            $stmGetNameSong -> execute();

            $resultGetNameSong = $stmGetNameSong -> fetch(PDO::FETCH_ASSOC);

            $nameSongArtist[] = $resultGetNameSong;

        }

        // echo '<pre>';
        // print_r($nameSongArtist);
        // echo '<pre>';

        // thêm id của bài hát và id của các ca sĩ tương ứng vào bảng songartist
        $sqlAddSongArtist = "INSERT INTO songartist(songID,artistID) values(:songID,:artistID)";

        $stmAddSongArtist = $connect -> prepare($sqlAddSongArtist);

        for($j = 0; $j < count($nameSongArtist); $j++)
        {
            $stmAddSongArtist -> bindParam(':songID',$resultGetTitleSong['id']);
            $stmAddSongArtist -> bindParam(':artistID',$nameSongArtist[$j]['id']);

            $stmAddSongArtist -> execute();
        }

    }

    // Hot 2023
    for($i = 0; $i < count($dataArrayFull['APIHot2023NewMost']); $i++)
    {
        // Lấy ra tên bài hát
        $nameSong = $dataArrayFull['APIHot2023NewMost'][$i]['titleSong'];
        // Lấy ra tên của ca sĩ
        $nameArtist = $dataArrayFull['APIHot2023NewMost'][$i]['nameArtists'];
        
        // Lấy ra id của bài hát có tên trùng với tên của bài hát ở trên
        $sqlGetTitleSong = "SELECT 
            songs.id
            from songs 
            where songs.songName like :nameSong";

        $stmGetTitleSong = $connect -> prepare($sqlGetTitleSong);

        $stmGetTitleSong -> bindParam(':nameSong',$nameSong);

        $stmGetTitleSong -> execute();

        $resultGetTitleSong = $stmGetTitleSong -> fetch(PDO::FETCH_ASSOC);

        // echo '<pre>';
        // print_r($resultGetTitleSong);
        // echo '<pre>';

        // Lấy ra id của những ca sĩ trong từng bài hát
        $sqlGetNameSong = "SELECT 
            artists.id
            from artists 
            where artists.artistName like :nameArtist";

        $stmGetNameSong = $connect -> prepare($sqlGetNameSong);

        $nameSongArtist = [];

        for ($j = 0; $j < count($nameArtist); $j++)
        {
            $stmGetNameSong -> bindParam(':nameArtist',$nameArtist[$j]);

            $stmGetNameSong -> execute();

            $resultGetNameSong = $stmGetNameSong -> fetch(PDO::FETCH_ASSOC);

            $nameSongArtist[] = $resultGetNameSong;

        }

        // echo '<pre>';
        // print_r($nameSongArtist);
        // echo '<pre>';

        // thêm id của bài hát và id của các ca sĩ tương ứng vào bảng songartist
        $sqlAddSongArtist = "INSERT INTO songartist(songID,artistID) values(:songID,:artistID)";

        $stmAddSongArtist = $connect -> prepare($sqlAddSongArtist);

        for($j = 0; $j < count($nameSongArtist); $j++)
        {
            $stmAddSongArtist -> bindParam(':songID',$resultGetTitleSong['id']);
            $stmAddSongArtist -> bindParam(':artistID',$nameSongArtist[$j]['id']);

            $stmAddSongArtist -> execute();
        }

    }

?>