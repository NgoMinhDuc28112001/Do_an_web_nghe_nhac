<?php
    session_start();
    include 'mySQL/connect.php';

    $errorMessage = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if(!empty($_POST['email']))
        {
            $userEmail = $_POST['email'];
            $userPass = $_POST['password'];
    
            $queryEmail = 'select * from users where userEmail ='."'".$_POST['email']."'";
    
            $statementEmail = $connect -> prepare($queryEmail);
    
            $statementEmail -> execute();
    
            if($statementEmail -> rowCount() > 0)
            {
                $result = $statementEmail -> fetch(PDO::FETCH_ASSOC);
                // Kiểm tra mật khẩu người dùng nhập

                if(!empty($userPass))
                {
                    $checkPass = password_verify($userPass,$result['userPass']);
                    if($checkPass)
                    {
                        $_SESSION['user'] = $result;
                        header('location:index.php');
                    }
                    else{
                        $errorMessage['password'] = 'Mật khẩu không chính xác!';
                    }
                }
                else{
                    $errorMessage['password'] = 'Bạn chưa nhập mật khẩu!';
                }
            }
            else{
                $errorMessage['email'] = 'Email không tồn tại!';
            }
        }
        else{
            $errorMessage['email'] = 'Bạn chưa nhập email!';
        }
    }

?>


