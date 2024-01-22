<!-- Phần xử lý PHP cho việc đăng ký -->
<?php
    include 'mySQL/connect.php';

    // Mảng chứa các validator
    $errorValidator = [];
    $successValidator = [];
    // kiểm tra khi nhấn vào submit
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if(empty($_POST['name']))
        {
            $errorValidator['name'] = 'Bạn chưa nhập tên!';
        };
        // Thông báo thành công khi người dùng đã nhập tên
        if(!empty($_POST['name']))
        {
            $successValidator['name'] = 'Tên đăng ký thành công';
        }

        if(empty($_POST['email']))
        {
            $errorValidator['email'] = 'Bạn chưa nhập email!';
        };
        // Kiểm tra trường hợp email đăng ký không được trùng nhau
        if(!empty($_POST['email']))
        {
            $queryEmail = 'select * from users where userEmail = '."'".$_POST['email']."'";
    
            $statementEmail = $connect -> prepare($queryEmail);

            $statementEmail -> execute();

            // Trường hợp email đã được đăng ký
            if($statementEmail -> rowCount() > 0)
            {
                $errorValidator['checkEmail'] = 'Email đã tồn tại!';
            }
            // Trường hợp thành công
            else{
                // Kiểm tra xem người dùng đã nhập đúng định dạng của email hay chưa
                if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                    $errorValidator['checkFormEmail'] = 'Người dùng nhập địa chỉ email không chính xác!';
                }
                else{
                    $successValidator['checkEmail'] = 'Đã đăng ký email thành công';
                }
            }
        }

        if(empty($_POST['password']))
        {
            $errorValidator['password'] = 'Bạn chưa nhập mật khẩu!';
        };
        // Kiểm tra mật khẩu nhập vào phải lớn hơn hoặc bằng 6 ký tự
        if(!empty($_POST['password']))
        {
            if(strlen($_POST['password']) >= 6)
            {
                $successValidator['checkPass'] = 'Nhập mật khẩu thành công';
            }
            else{
                $errorValidator['checkPass'] = 'Yêu cầu mật khẩu tối thiểu 6 ký tự!';
            }
        }

        if(empty($_POST['confirmPass']))
        {
            $errorValidator['confirmPass'] = 'Bạn chưa nhập lại mật khẩu!';
        }

        if(!empty($_POST['confirmPass']))
        {
            // Kiểm tra TH mật khẩu nhập lại không giống
            if($_POST['confirmPass'] !== $_POST['password'])
            {
                $errorValidator['checkConfirmPass'] = 'Mật khẩu nhập lại không đúng!';
            };
            // Thông báo thành công khi người dùng nhập lại mật khẩu chính xác
            if($_POST['confirmPass'] === $_POST['password'])
            {
                $successValidator['checkConfirmPass'] = 'Mật khẩu nhập lại chính xác';
            };
        }

        if(empty($_POST['checkbox']))
        {
            $errorValidator['checkbox'] = 'Bạn chưa đồng ý với các điều khoản và dịch vụ!';
        }
        if(!empty($_POST['checkbox']))
        {
            $successValidator['checkbox'] = 'Bạn đã đồng ý với các điều khoản và dịch vụ';
        }


        // Kiểm tra nếu như không có lỗi gì mới cho dữ liệu được thêm vào database
        if(empty($errorValidator))
        {
            $userName = $_POST['name'];
            $userEmail = $_POST['email'];
            $userPass = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $queryInsert = '
            insert into users(userName,userEmail,userPass) values(:userName,:userEmail,:userPass)';

            $statementInsert = $connect -> prepare($queryInsert);

            $statementInsert -> bindParam(':userName',$userName);
            $statementInsert -> bindParam(':userEmail',$userEmail);
            $statementInsert -> bindParam(':userPass',$userPass);

            $statementInsert -> execute();
        }

    }

?>

