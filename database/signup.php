<?php
    session_start();
    
    require_once 'dbconnect.php';
    mysqli_set_charset($link, 'utf8');
    if (!empty($_SESSION['base_error'])){
        exit();
    }
    
    $name = mysqli_real_escape_string($link, trim($_POST['name']));
    $surname = mysqli_real_escape_string($link, trim($_POST['surname']));
    $patronymic = mysqli_real_escape_string($link, trim($_POST['patronymic']));
    $login = mysqli_real_escape_string($link, trim($_POST['login']));
    $pass = sha1(mysqli_real_escape_string($link, $_POST['pass']));
    $pass_confirm = sha1(mysqli_real_escape_string($link, $_POST['pass_confirm']));
    /*if (!empty($_POST['guest']))
    {
        $privilege = mysqli_real_escape_string($link, $_POST['guest']);
    } elseif (!empty($_POST['common_user'])) {
        $privilege = mysqli_real_escape_string($link, $_POST['common_user']);
    } elseif (!empty($_POST['admin'])) {
        $privilege = mysqli_real_escape_string($link, $_POST['admin']);
    }*/
    $privilege = mysqli_real_escape_string($link, trim($_POST['privilege']));
    
    if (!empty($name) && !empty($surname) && !empty($patronymic) &&!empty($privilege)
            && !empty($login) && !empty($pass) && !empty($pass_confirm))
    {
        if ($pass === $pass_confirm)
        {
            $user_existing_check_temp = 0;
            $user_existing_check_query = "SELECT * FROM `User` WHERE `Login` = '$login'";
            $user_existing_check = mysqli_num_rows($link, $user_existing_check_query);
            
            if($user_existing_check)
            {
                $rows = mysqli_num_rows($user_existing_check); // количество полученных строк
                for ($i = 0 ; $i < $rows ; ++$i)
                {
                    $row = mysqli_fetch_row($user_existing_check);
                    for ($j = 0 ; $j < 7 ; ++$j)
                    {
                        if ($row[$j] == $login)
                        {
                            $user_existing_check_temp = $row[$j];
                        }
                    }
                }
                // очищаем результат
                mysqli_free_result($result);
            }

            if ($user_existing_check_temp == NULL)
            {
                $insert_query = "INSERT INTO `User`(`Name`, `Surname`, `Patronymic`, `Login`, `Password`, `Privilege`) VALUES ('$name','$surname','$patronymic','$login','$pass','$privilege')";
                mysqli_query($link, $insert_query);

                $_SESSION['error_msg'] = 'Новый пользователь успешно добавлен';
                header("Location: ../enter.php");
            } else {
                $_SESSION['error_msg'] = 'Пользователь с таким логином уже есть';
                header("Location: ../registration.php");
            }
            
        } else {
            $_SESSION['error_msg'] = 'Пароли не совпадают';
            header("Location: ../registration.php");
        }
    } else {
        $_SESSION['error_msg'] = 'Заполните все поля';
        header("Location: ../registration.php");
    }
?>