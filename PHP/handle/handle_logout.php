<?php

    session_start();
    // Hủy session của user
    unset($_SESSION['user']);
    // Hủy tất cả session
    // session_destroy();

    header('location:../index.php');

?>