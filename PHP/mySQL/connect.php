<?php
    // Thông tin kết nối

    define('_HOST','localhost');
    define('_DB','web_nghe_nhac');
    define('_USER','root');
    define('_PASS','');

    try{
        if(class_exists('PDO'))
        {
            $connect = new PDO("mysql:host="._HOST.";"."dbname="._DB, _USER, _PASS);
            // Thiết lập chế độ lỗi để PDO ném ngoại lệ nếu có lỗi
            $connect -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo 'Kết nối thành công';
        }
    }catch(PDOException $e)
    {
        echo "Kết nối gặp lỗi: ",$e -> getMessage();
    }
?>