<?php
    $listArtistsSad = [];

    for($i = 0; $i < count($dataArrayFull['APISadNewMost']);$i++)
    {
        $listArtist = $dataArrayFull['APISadNewMost'][$i]['nameArtists'];

        // Hợp tất cả mảng con thành 1 mảng duy nhất
        $listArtistsSad = array_merge($listArtistsSad, $listArtist);
    }
    
    // Loại bỏ các phần tử trùng lặp

    $listArtistsSad = array_values(array_unique($listArtistsSad));

    // echo '<pre>';
    // print_r($listArtistsSad);
    // echo '<pre>';

?>