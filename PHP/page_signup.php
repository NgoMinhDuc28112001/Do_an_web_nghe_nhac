<?php
    
    include 'handle/handle_signup.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <link rel="icon" href="../Image/logo.png">
    <!-- Link sử dụng trong trang signup -->
    <?php
        include('../Link/link_signup.php');
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
            <a href="main.php" class="form__link">
                <img src="../Image/logo.png" alt="" class="form__img">
                <span>
                    Đăng ký
                </span>
            </a>
            <!-- <div class="form__block-input"> -->
                <div class="from__input-text">
                    <input id="my-name" type="text" class="from__input" placeholder="User name" name="name">
                    <span class="form-message form-message--error">
                        <!-- PHP xử lý việc hiện message -->
                        <?php
                            echo (isset($errorValidator['name']) ? $errorValidator['name'] : '');
                        ?>
                    </span>
                    <span class="form-message form-message--success">
                        <!-- PHP xử lý việc hiện message -->
                        <?php
                            echo (isset($successValidator['name']) ? $successValidator['name'] : '');
                        ?>
                    </span>
                </div>
                <div class="from__input-text">
                    <input id="my-email" type="text" class="from__input" placeholder="Email Address" name="email">
                    <span class="form-message form-message--error">
                        <!-- PHP xử lý việc hiện message -->
                        <?php
                            echo (isset($errorValidator['email']) ? $errorValidator['email'] : '');
                            echo (isset($errorValidator['checkEmail']) ? $errorValidator['checkEmail'] : '');
                            echo (isset($errorValidator['checkFormEmail']) ? $errorValidator['checkFormEmail'] : '');
                        ?>
                    </span>
                    <span class="form-message form-message--success">
                        <?php
                            echo (isset($successValidator['checkEmail']) ? $successValidator['checkEmail'] : '');
                        ?>
                    </span>
                </div>
                <div class="from__input-text">
                    <div class="from__group">
                        <input id="my-password" type="password" class="from__input" placeholder="Password" name="password">
                        <i class="fas fa-eye eye eye--show"></i>
                        <i class="fas fa-eye-slash eye-slash"></i>
                    </div>
                    <span class="form-message form-message--error">
                        <!-- PHP xử lý việc hiện message -->
                        <?php
                            echo (isset($errorValidator['password']) ? $errorValidator['password'] : '');
                            echo (isset($errorValidator['checkPass']) ? $errorValidator['checkPass'] : '');
                        ?>
                    </span>
                    <span class="form-message form-message--success">
                        <!-- PHP xử lý việc hiện message -->
                        <?php
                            echo (isset($successValidator['checkPass']) ? $successValidator['checkPass'] : '');
                        ?>
                    </span>
                </div>
                <div class="from__input-text">
                    <div class="from__group">
                        <input id="my-password-confirm" type="password" class="from__input" placeholder="Confirm Password" name="confirmPass">
                        <i class="fas fa-eye eye eye--show"></i>
                        <i class="fas fa-eye-slash eye-slash"></i>
                    </div>
                    <span class="form-message form-message--error">
                        <!-- PHP xử lý việc hiện message -->
                        <?php
                            echo (isset($errorValidator['checkConfirmPass']) ? $errorValidator['checkConfirmPass'] : '');
                            echo (isset($errorValidator['confirmPass']) ? $errorValidator['confirmPass'] : '');
                        ?>
                    </span>
                    <span class="form-message form-message--success">
                        <!-- PHP xử lý việc hiện message -->
                        <?php
                            echo (isset($successValidator['checkConfirmPass']) ? $successValidator['checkConfirmPass'] : '');
                        ?>
                    </span>
                </div>
            <!-- </div> -->
            <div class="from__input-text">
                <div class="checkbox-text">
                    <input id="my-checkbox" type="checkbox" class="my-checkbox" name="checkbox">
                    <span>Tôi đồng ý với các <a href="">điều khoản</a> & <a href="">dịch vụ</a>.</span>
                </div>
                <span class="form-message form-message--error">
                    <!-- PHP xử lý việc hiện message -->
                    <?php
                        echo (isset($errorValidator['checkbox']) ? $errorValidator['checkbox'] : '');
                    ?>
                </span>
                <span class="form-message form-message--success">
                    <!-- PHP xử lý việc hiện message -->
                    <?php
                        echo (isset($successValidator['checkbox']) ? $successValidator['checkbox'] : '');
                    ?>
                </span>
            </div>
            <div class="form__button">
                <button name="submit">ĐĂNG KÝ</button>
            </div>
            <div class="form__question">
                Bạn đã có tài khoản?
                <a href="page_login.php" class="">Đăng nhập</a>
            </div>
        </form>
    </div>
</body>
<script src="../JS/eye.js"></script>
</html>