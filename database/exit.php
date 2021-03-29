<?php
    session_start();
    require 'dbconnect.php';
    mysqli_set_charset($link, 'utf8');
    date_default_timezone_set('Asia/Yekaterinburg');
    
    $current_time = mysqli_real_escape_string($link, date('Y/m/d H:i:s'));
    $current_user = mysqli_real_escape_string($link, ($_COOKIE['login']));
    $upload_log_query = "INSERT INTO `Log` (`Access_type`, `User_Login`, `Time`) VALUES ('Пользователь вышел','$current_user', '$current_time')";
    mysqli_query($link, $upload_log_query);

    unset($_COOKIE['user_id']);
    unset($_COOKIE['login']);
    unset($_COOKIE['user_privilege']);
    setcookie('user_privilege', '', -1, '/');
    setcookie('user_id', '', -1, '/');
    setcookie('login', '', -1, '/');
    
    header("Refresh: 1; url=http://10.101.0.44/enter.php"); 
?>

