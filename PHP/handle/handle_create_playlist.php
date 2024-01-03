<?php

    $errorPlaylist = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        // Trường hợp được nhập trường name
        if(!empty($_POST['namePlaylist']))
        {
            $namePlaylist = $_POST['namePlaylist'];
        }
        
        if(empty($_POST['namePlaylist'])){
            $errorPlaylist[] = 1;
        }

        // Trường hợp được chọn file ảnh
        if(!empty($_FILES['imgPlaylist']) && $_FILES['imgPlaylist']['error'] === 0)
        {
            // Thư mục lưu trữ ảnh tải lên
            $folderImage = '../Image/';

            $linkImage = $folderImage.basename($_FILES["imgPlaylist"]["name"]);

            $typeImage = strtolower(pathinfo($linkImage,PATHINFO_EXTENSION));

            // Kiểm tra xem tệp tin có phải là ảnh không
            $check = getimagesize($_FILES["imgPlaylist"]["tmp_name"]);
            // Trường hợp upload lên là ảnh
            if($check !== false)
            {
                // Di chuyển ảnh tới thư mục image trong dự án
                move_uploaded_file($_FILES["imgPlaylist"]["tmp_name"],$linkImage);
            
            }
            else{
                $errorPlaylist[] = 1;
            }
        }

        if(empty($errorPlaylist))
        {
            $linkImage = (isset($linkImage)) ? $linkImage : null;

            $sqlAddPlaylist = "INSERT INTO playlists(userID,playlistName,playlistImage) VALUES(:userID,:playlistName,:playlistImage)";
            $statementAddPlaylist = $connect -> prepare($sqlAddPlaylist);

            $statementAddPlaylist -> bindParam(':userID',$_SESSION['user']['id']);
            $statementAddPlaylist -> bindParam(':playlistName',$namePlaylist);
            $statementAddPlaylist -> bindParam(':playlistImage',$linkImage);

            $statementAddPlaylist -> execute();

        }
    }

?>