<?php
    session_start();
    
    require_once 'dbconnect.php';
    mysqli_set_charset($link, 'utf8');
    if (!empty($_SESSION['base_error'])){
        exit();
    }
    
    $page_name = mysqli_real_escape_string($link, trim($_POST['page_name']));
    $new_access = mysqli_real_escape_string($link, trim($_POST['new_access']));
    
    if (!empty($page_name) && !empty($new_access))
    {
        $update_query = "UPDATE `Pages` SET `Page_access` = '$new_access' WHERE `Name` = '$page_name'";
        mysqli_query($link, $update_query);

        $_SESSION['page_update_msg'] = 'уровень доступа изменен';
        header("Location: ../adminka.php");
    } else {
        $_SESSION['page_update_msg'] = 'Заполните все поля';
        header("Location: ../adminka.php");
    }
?>