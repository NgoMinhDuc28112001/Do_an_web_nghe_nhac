<?php

    include '../PHP/mySQL/connect.php';
    // Đọc nội dung của tệp JSON
    $jsonContentFull = file_get_contents('APIFull.json');

    // Chuyển đổi JSON thành mảng PHP
    $dataArrayFull = json_decode($jsonContentFull, true);

    // Chill
    include('./get_API_add_artists_chill.php');
    // Sad
    include('./get_API_add_artists_sad.php');
    // Remix
    include('./get_API_add_artists_remix.php');
    // Hot 2023
    include('./get_API_add_artists_hot2023.php');

    // Hợp tất cả các mảng chứa những ca sĩ lại

    $listArtistsFull = [...$listArtistsChill,...$listArtistsSad,...$listArtistsRemix,...$listArtistsHot2023,];

    // Loại bỏ những phần tử trùng nhau và sẽ thu được mảng chưa full artist không lặp nhau
    $listArtistsFull = array_values(array_unique($listArtistsFull));

    echo '<pre>';
    print_r($listArtistsFull);
    echo '<pre>';
    
    // Thêm tên ca sĩ vào database

    // Kiểm tra xem trong database đã có những ca sĩ này chưa, nếu có thì sẽ không in vào bảng

    $checkAddArtist = "SELECT * from artists where artists.artistName like :artistName";

    $stmCheckAddArtist = $connect -> prepare($checkAddArtist);

    for($i = 0; $i < count($listArtistsFull);$i++)
    {
        $checkStatus = 0;

        $nameArtist = $listArtistsFull[$i];

        $stmCheckAddArtist -> bindParam(':artistName',$nameArtist);

        $stmCheckAddArtist -> execute();

        $resultCheckAddArtist = $stmCheckAddArtist -> fetchAll(PDO::FETCH_ASSOC);

        // echo '<pre>';
        // print_r($resultCheckAddArtist);
        // echo '<pre>';

        if(count($resultCheckAddArtist) !== 0)
        {
            $checkStatus++;
        }

        // echo $checkStatus;
        // echo '<br>';

        // echo $checkStatus;
        // Nếu checkStatus bằng 0 tức là tên ca sĩ chưa có trong bảng thì sẽ thêm vào
        if($checkStatus === 0)
        {
            $sqlAddArtist = "INSERT INTO artists(id,artistName) values(:id,:artistName)";
    
            $stmAddArtist = $connect -> prepare($sqlAddArtist);
    
            $stmAddArtist -> bindParam(':id',$i);
            $stmAddArtist -> bindParam(':artistName',$listArtistsFull[$i]);

            $stmAddArtist -> execute();
        }
    }
    
?>