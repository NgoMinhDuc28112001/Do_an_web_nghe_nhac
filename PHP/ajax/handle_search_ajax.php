<?php
    session_start();
    include '../mySQL/connect.php';

    if($_SERVER['REQUEST_METHOD'] === 'GET')
    {
        // Nhận từ khóa tìm kiếm từ yêu cầu AJAX
        $searchTerm = $_GET['q'];
    
        // Thực hiện truy vấn tìm kiếm
        $sql = "SELECT
        songs.*,
        artists.artistName,
        1 AS status
        FROM songs
        inner join songartist on songs.id = songartist.songID
        inner join artists on songartist.artistID = artists.id
        LEFT JOIN likesong ON likesong.songID = songs.id
        where songs.songName like '%{$searchTerm}%' and likesong.userID = {$_SESSION['user']['id']}

        UNION

        SELECT
        songs.*,
        artists.artistName,
        0 AS status
        FROM songs
        inner join songartist on songs.id = songartist.songID
        inner join artists on songartist.artistID = artists.id
        LEFT JOIN likesong ON likesong.songID = songs.id
        where songs.songName like '%{$searchTerm}%' and songs.id NOT IN (SELECT songID FROM likesong WHERE userID = {$_SESSION['user']['id']})
        ";

        $statement = $connect -> prepare($sql);
        $statement -> execute();
    
        // Hiển thị kết quả tìm kiếm dưới dạng danh sách
        if ($statement -> rowCount() > 0) {
            $result = $statement -> fetchAll(PDO::FETCH_ASSOC);
        
            $newResult = [];
    
            foreach($result as $item)
            {
                $id = $item['id'];
                if (!isset($newResult[$id])) {
                    // Nếu chưa có mảng với 'id' này, tạo mới
                    $newResult[$id] = $item;
                } else {
                    // Nếu đã có mảng với 'id' này, nối giá trị 'artistName'
                    $newResult[$id]['artistName'] .= ', ' . $item['artistName'];
                }
            }
            
            $newResult = array_values($newResult);
            //render ra giao diện trong result
            echo "
                <h5 class='header__container-items-result-title'>
                    Có ".count($newResult)." kết quả phù hợp:
                </h5>
                <ul class='header__container-items-result-list'>";
                for($i = 0; $i < count($newResult); $i++)
                {
                    echo "
                            <li class='header__container-items-result-items'>
                                <div class='header__container-items-result-items-left'>
                                    <!-- Phần này chứa ảnh và các icon trong ảnh -->
                                    <div class='header__container-items-result-items-block'>
                                        <div style='background-image: url({$newResult[$i]['songImage']});' class='header__container-items-result-items-block-img'></div>
                                        <div class='header__container-items-result-items-block-blur'></div>
                                        <div class='header__container-items-result-items-block-icon'>
                                            <div class='header__container-items-result-items-block-icon-i'>
                                                <i id='play-search-{$newResult[$i]['id']}' onclick = 'playSongSearch({$newResult[$i]['id']})' class='fa-solid fa-play icon--active'></i>
                                                <i id='pause-search-{$newResult[$i]['id']}' onclick = 'pauseSongSearch({$newResult[$i]['id']})' class='fa-solid fa-pause'></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Phần chứa văn bản -->
                                    <div class='header__container-items-result-items-text'>
                                        <div class='header__container-items-result-items-text-items'>
                                            <div class='header__container-items-result-items-text-items-link header__container-items-result-items-text-items-link--large'>
                                                {$newResult[$i]['songName']}
                                            </div>
                                        </div>
                                        <div class='header__container-items-result-items-text-items margin--top'>";
                                            $arrayArtistName = explode(",", $newResult[$i]['artistName']);
                                            foreach($arrayArtistName as $artistName){
                                                echo "
                                                    <div class='header__container-items-result-items-text-items-link header__container-items-result-items-text-items-link--small'>
                                                        {$artistName}
                                                    </div>
                                                ";
                                            };
                    echo "
                                        </div>
                                    </div>
                                </div>
                                <div class='header__container-items-result-items-right'>
                                    <div class='header__container-items-result-items-right-button'>";
                                        if($newResult[$i]['status'] === 0)
                                        {
                                            echo "<i onclick='addLibrary({$newResult[$i]['id']});' class='fa-regular fa-heart icon--active'></i>";
                                        }
                                        else{
                                            echo "<i onclick='removeLibrary({$newResult[$i]['id']});' class='fa-solid fa-heart icon--active icon--library'></i>";
                                        }

                    echo "
                                    </div>
                                    <div class='header__container-items-result-items-right-button'>
                                        <i class='icon ic-add-play-now icon--active'></i>
                                    </div>
                                    <div class='header__container-items-result-items-right-button'>
                                        <i class='icon ic-download icon--active'></i>
                                    </div>
                                </div>
                                <!-- Link audio lấy id bằng các audio rồi chèn vào id của nó trong mysql -->
                                <audio id='audio-search-{$newResult[$i]['id']}' src='{$newResult[$i]['Link320']}'></audio>
                            </li>";
                }
    
            echo "</ul>";
        } else {
            echo '
                <h5 class="header__container-items-result-title">
                    Không tìm thấy kết quả
                </h5>';
        }
    }

?>