<?php
    $listArtistsRemix= [];

    for($i = 0; $i < count($dataArrayFull['APIRemixNewMost']);$i++)
    {
        $listArtist = $dataArrayFull['APIRemixNewMost'][$i]['nameArtists'];

        // Hợp tất cả mảng con thành 1 mảng duy nhất
        $listArtistsRemix = array_merge($listArtistsRemix, $listArtist);
    }
    
    // Loại bỏ các phần tử trùng lặp

    $listArtistsRemix = array_values(array_unique($listArtistsRemix));

    // echo '<pre>';
    // print_r($listArtistsRemix);
    // echo '<pre>';

?>