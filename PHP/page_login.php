<?php
    include 'handle/handle_login.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập tài khoản</title>
    <link rel="icon" href="../Image/logo.png">
    <!-- Phần link sử dụng cho trang login -->
    <?php
        include('../Link/link_login.php')
    ?>
</head>
<body>
    <div class="container">
        <div class="block-logo block-logo--padding">
            <a class="block-logo__link" href="" class="">
                <img class="block-logo__link-img" src="../Image/logo.png" alt="logo web">
                <span>
                    YOURMUSIC
                </span>
            </a>
        </div>
        <form id="form-login" class="form" action="" method="post">
            <a href="" class="form__link">
                <img src="../Image/logo.png" alt="" class="form__img">
                <span>
                    Đăng nhập
                </span>
            </a>
            <!-- <div class="form__block-input"> -->
                <div class="from__input-text">
                    <input id="my-email" type="text" class="from__input" placeholder="Email của bạn" name="email" value="<?php echo (isset($_POST['email']) ? $_POST['email'] : '') ?>">
                    <span class="form-message form-message--error">
                        <!-- PHP xử lý việc hiện message -->
                        <?php
                            echo (isset($errorMessage['email']) ? $errorMessage['email'] : '');
                        ?>
                    </span>
                </div>
                <div class="from__input-text">
                    <div class="from__group">
                        <input id="my-password" type="password" class="from__input" placeholder="Mật khẩu của bạn" name="password" value="<?php echo (isset($_POST['password']) ? $_POST['password'] : '') ?>">
                        <i id="eye" class="fas fa-eye eye eye--show"></i>
                        <i id="eye-slash" class="fas fa-eye-slash eye-slash"></i>
                    </div>
                    <span class="form-message form-message--error">
                        <!-- PHP xử lý việc hiện message -->
                        <?php
                            echo (isset($errorMessage['password']) ? $errorMessage['password'] : '');
                        ?>
                    </span>
                </div>
            <!-- </div> -->
            <div class="no-remember-pass">
                <a href="" class="">
                    Quên mật khẩu?
                </a>
            </div>
            <div class="form__button">
                <button name="submit">ĐĂNG NHẬP</button>
            </div>
            <div class="form__question">
                Bạn mới biết đến YourMusic?
                <a href="page_signup.php" class="">Đăng ký</a>
            </div>
        </form>
    </div>
</body>
<script src="../JS/eye.js"></script>
</html>