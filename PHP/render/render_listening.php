<?php
    if(isset($_SESSION['user'])){
        $sqlRenderListening = "SELECT
        songs.*,
        artists.artistName
        from songs
        inner join songartist on songs.id = songartist.songID
        inner join artists on songartist.artistID = artists.id
        inner join listening on songs.id = listening.songID
        where listening.userID = {$_SESSION['user']['id']} and listening.countListening >=2
        ";

        $stmRenderListening = $connect -> prepare($sqlRenderListening);

        $stmRenderListening -> execute();

        $resultRenderListening = $stmRenderListening -> fetchAll(PDO::FETCH_ASSOC);

        $newResultRenderListening = [];

        foreach($resultRenderListening as $item)
        {
            $id = $item['id'];
            if (!isset($newResultRenderListening[$id])) {
                // Nếu chưa có mảng với 'id' này, tạo mới
                $newResultRenderListening[$id] = $item;
            } else {
                // Nếu đã có mảng với 'id' này, nối giá trị 'artistName'
                $newResultRenderListening[$id]['artistName'] = $newResultRenderListening[$id]['artistName'].', ' . $item['artistName'];
            }
        }
        
        $newResultRenderListening = array_values($newResultRenderListening);

        // echo '<pre>';
        // print_r($newResultRenderListening);
        // echo '<pre>';

    }
    else{
        return;
    }
?>