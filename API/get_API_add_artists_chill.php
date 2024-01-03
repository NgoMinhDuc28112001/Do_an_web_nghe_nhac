<?php
    $listArtistsChill = [];

    for($i = 0; $i < count($dataArrayFull['APIChillNewMost']);$i++)
    {
        $listArtist = $dataArrayFull['APIChillNewMost'][$i]['nameArtists'];

        // Hợp tất cả mảng con thành 1 mảng duy nhất
        $listArtistsChill = array_merge($listArtistsChill, $listArtist);
    }
    
    // Loại bỏ các phần tử trùng lặp và cập nhật vị trí

    $listArtistsChill = array_values(array_unique($listArtistsChill));

    // echo '<pre>';
    // print_r($listArtistsChill);
    // echo '<pre>';
?>