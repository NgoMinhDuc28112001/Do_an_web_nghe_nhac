<?php


    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if(!empty($_FILES['fileImage']) && $_FILES['fileImage']['error'] === 0)
        {
            // Thư mục lưu trữ ảnh tải lên
            $folderImage = '../Image/';

            $linkImage = $folderImage.basename($_FILES["fileImage"]["name"]);

            $typeImage = strtolower(pathinfo($linkImage,PATHINFO_EXTENSION));

            // Kiểm tra xem tệp tin có phải là ảnh không
            $check = getimagesize($_FILES["fileImage"]["tmp_name"]);

            // Trường hợp upload lên là ảnh
            if($check !== false)
            {
                // Di chuyển ảnh tới thư mục image trong dự án
                move_uploaded_file($_FILES["fileImage"]["tmp_name"],$linkImage);

                $queryUpdateImage = 'update users set userImage = '.'"'.$linkImage.'"'.'where userEmail = '.'"'.$_SESSION['user']['userEmail'].'"';
                
                $statementUpdateImage = $connect -> prepare($queryUpdateImage);

                $statementUpdateImage -> execute();

                // Lấy ra những thông tin sau khi cập nhật

                $queryNewData = 'select * from users where userEmail = '.'"'.$_SESSION['user']['userEmail'].'"';

                $statementNewData = $connect -> prepare($queryNewData);

                $statementNewData -> execute();

                $newData = $statementNewData -> fetch(PDO::FETCH_ASSOC);

                $_SESSION['user']['userImage'] = $newData['userImage'];

                // Để load lại ngay ở trang web hiện tại đang ở.
                header("Location: ".$_SERVER['PHP_SELF']);
            
            }
            else{
                echo 'file này không phải ảnh';
            }
        }
    }

?>

<!-- Các hàm và tác dụng:

        - Hàm basename: 
        - Hàm strtolower:
        - Hàm pathinfo:

-->