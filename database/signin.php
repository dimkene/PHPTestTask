<?php
    session_start();
    
    require_once 'dbconnect.php';
    mysqli_set_charset($link, 'utf8');
    date_default_timezone_set('Asia/Yekaterinburg');
    if (!empty($_SESSION['base_error'])){
        exit();
    }
    
    $current_user = mysqli_real_escape_string($link, trim($_POST['login']));
    $current_user_password = sha1(mysqli_real_escape_string($link, $_POST['pass']));
    $current_time = mysqli_real_escape_string($link, date('Y/m/d H:i:s'));

    if (!empty($current_user) AND !empty($current_user_password))
    {
        $submit_pass_query = "SELECT * FROM `User` WHERE `Login` = '$current_user' AND `Password` = '$current_user_password'";
        $submit_pass = mysqli_query($link, $submit_pass_query);

        if (mysqli_num_rows($submit_pass) == 1)
        {
            $row = mysqli_fetch_assoc($submit_pass);
            setcookie('user_id', $row['Id'], time() + (60*60*24*30), $path ="/");
            setcookie('login', $row['Login'], time() + (60*60*24*30), $path ="/");
            setcookie('user_privilege', $row['Privilege'], time() + (60*60*24*30), $path ="/");
            
            $access_type = mysqli_real_escape_string($link, "Пользователь успешно вошел в систему");
            $upload_log_query = "INSERT INTO `Log` (`Access_type`, `User_Login`, `Time`) VALUES ('$access_type', '$current_user', '$current_time')";
                                
            mysqli_query($link, $upload_log_query);
            
            header("Refresh: 1; url=http://10.101.0.44/startpage.php");
        } else {
            
            $access_type = mysqli_real_escape_string($link, "Ошибка входа: неверный логин или пароль");
            $upload_log_query = "INSERT INTO `Log` (`Access_type`, `User_Login`, `Time`) VALUES ('$access_type', '$current_user', '$current_time')";
            mysqli_query($link, $upload_log_query);
 
            $_SESSION['error_msg'] = 'Ошибка входа: неверный логин или пароль';
            header("Location: ../enter.php");
        }
    } else {
        $_SESSION['error_msg'] = 'Ошибка входа: заполните все поля';
        header("Location: ../enter.php");
    }
    
?>