<?php
    $listArtistsHot2023 = [];

    for($i = 0; $i < count($dataArrayFull['APIHot2023NewMost']);$i++)
    {
        $listArtist = $dataArrayFull['APIHot2023NewMost'][$i]['nameArtists'];

        // Hợp tất cả mảng con thành 1 mảng duy nhất
        $listArtistsHot2023 = array_merge($listArtistsHot2023, $listArtist);
    }
    
    // Loại bỏ các phần tử trùng lặp

    $listArtistsHot2023 = array_values(array_unique($listArtistsHot2023));

    // echo '<pre>';
    // print_r($listArtistsHot2023);
    // echo '<pre>';

?>