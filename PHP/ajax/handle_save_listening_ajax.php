<?php

    session_start();

    include '../mySQL/connect.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if(!empty($_SESSION['user']) && isset($_POST['songID']))
        {
            $songID = $_POST['songID'];

            $userID = $_SESSION['user']['id'];

            // echo $songID;
            // echo $userID;

            // Kiểm tra xem trong bảng listening đã có bài hát nào được nghe chưa
            // Nếu chưa thì thực hiện thêm bài đầu tiên mà người dùng nhấn nghe
            $sqlGetDataListening = "SELECT * FROM listening";

            $stmGetDataListening = $connect -> prepare($sqlGetDataListening);

            $stmGetDataListening -> execute();

            $resultGetDataListening = $stmGetDataListening -> fetchAll(PDO::FETCH_ASSOC);

            if(count($resultGetDataListening) === 0)
            {
                // Khi mà không có bản ghi bào trong bảng thì thực hiện thêm
                $sqlAddDataListening = "INSERT INTO listening values(:songID,:userID,:countListening)";

                $stmAddDataListening = $connect -> prepare($sqlAddDataListening);

                $stmAddDataListening -> bindParam(':songID',$songID);
                $stmAddDataListening -> bindParam(':userID',$userID);
                $stmAddDataListening -> bindValue(':countListening',1);

                $stmAddDataListening -> execute();
            }

            else{
                // Khi mà đã tồn tại bản ghi trong bảng rồi thì sẽ kiểm tra xem bài hát đang nghe
                // Có tồn tại trong bảng không
                // Nếu tồn tại thì cộng count lên 1
                // Nếu không tồn tại thì thêm thông tin bài hát và count = 1
                $sqlCheckDataListening = "SELECT * FROM listening where listening.songID = :songID and listening.userID = :userID";

                $stmCheckDataListening = $connect -> prepare($sqlCheckDataListening);

                $stmCheckDataListening -> bindParam(':songID',$songID);
                $stmCheckDataListening -> bindParam(':userID',$userID);

                $stmCheckDataListening -> execute();

                $resultCheckDataListening = $stmCheckDataListening -> fetchAll(PDO::FETCH_ASSOC);

                if(count($resultCheckDataListening) === 0)
                {
                    // Khi mà kết quả trả về bằng 0 tức là bài hát này chưa được nghe lần nào
                    // Sẽ thêm mới thông tin vào và count = 1;
                    $sqlAddNewDataListening = "INSERT INTO listening values(:songID,:userID,:countListening)";

                    $stmAddNewDataListening = $connect -> prepare($sqlAddNewDataListening);

                    $stmAddNewDataListening -> bindParam(':songID',$songID);
                    $stmAddNewDataListening -> bindParam(':userID',$userID);
                    $stmAddNewDataListening -> bindValue(':countListening',1);

                    $stmAddNewDataListening -> execute();
                }
                else{
                    // Trường hợp bài hát đang nghe đã từng nghe trước khia rồi thì sẽ cập nhật count tăng thêm 1 đơn vị
                    $sqlUpdateCount = "UPDATE listening set countListening = countListening + 1 
                        where listening.songID = :songID and listening.userID = :userID";

                    $stmUpdateCount = $connect -> prepare($sqlUpdateCount);

                    $stmUpdateCount -> bindParam(':songID',$songID);
                    $stmUpdateCount -> bindParam(':userID',$userID);

                    $stmUpdateCount -> execute();

                    // echo "Đã cập nhật thành công";
                }

            }
        }
    }

?>