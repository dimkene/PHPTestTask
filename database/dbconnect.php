<?php
    session_start();
    require_once 'dbconnectioncfg.php';
    $link = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
    
    if (!$link) {
        $_SESSION['error_msg'] = 'Невозможно подключиться к базе данных';
        $_SESSION['base_error'] = mysqli_error($link);
    }
 ?>