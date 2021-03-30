<?php
    session_start();
    
    require_once 'dbconnect.php';
    mysqli_set_charset($link, 'utf8');
    if (!empty($_SESSION['base_error'])){
        exit();
    }
    
    $login = mysqli_real_escape_string($link, trim($_POST['login']));
    $privilege = mysqli_real_escape_string($link, trim($_POST['new_privilege']));
    
    if (!empty($privilege) && !empty($login))
    {
        $update_query = "UPDATE `User` SET `Privilege` = '$privilege' WHERE `Login` = '$login'";
        mysqli_query($link, $update_query);

        $_SESSION['priv_update_msg'] = 'Привилегии изменены';
        header("Location: ../adminka.php");
    } else {
        $_SESSION['priv_update_msg'] = 'Заполните все поля';
        header("Location: ../adminka.php");
    }
?>