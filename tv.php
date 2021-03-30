<?php
    session_start();
    if (empty($_COOKIE['login'])){
        header("Location: enter.php");
    }
    
    require 'database/dbconnect.php';
    include 'database/pageaccess.php';
    mysqli_set_charset($link, 'utf8');
    
    $user_priv = $_COOKIE['user_privilege'];
    $computer_priv = page_privilege_catch('Computer', $link);
    $tv_priv = page_privilege_catch('Tv', $link);
    $phone_priv = page_privilege_catch('Phone', $link);
    
    if ($user_priv != $tv_priv and $user_priv != 'root' and $user_priv != 'admin'){
        header("Location: startpage.php");
    }
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ТВ</title>
        <link rel="stylesheet" href="assets/css/startpage_styles.css"/>
    </head>
    <header>
        <table class="header_styles">
            <tr>
                <td class="header_styles_left">
                    <?php
                        echo "Вы вошли как ".$_COOKIE['login']." с правами доступа ".
                                $_COOKIE['user_privilege'];
                    ?>
                </td>
                <td class="header_styles_right">
                    <form class="exit_form" action="database/exit.php" method="post">
                        <button >Выход</button>
                    </form>
                </td>    
            </tr>
        </table>
    </header>
    <body style="border: 2px solid #778899">
        <!-- Основная страница -->
        <table >
            <tr>
                <td class="sidebar">
                    <!-- Переходы на страницы -->
                    <p><a class="sidebar_link" href="http://10.101.0.44/startpage.php">
                                    Главная</a></p>
                    <?php
                        if ($user_priv == 'root' or $user_priv == 'admin' or 
                                $user_priv == $computer_priv){
                    ?>
                            <p><a class="sidebar_link" href="http://10.101.0.44/computer.php">
                                    Компьютеры</a></p>
                    <?php
                        }    
                    ?>
                            
                    <?php
                        if ($user_priv == 'root' or $user_priv == 'admin' or 
                                $user_priv == $tv_priv){
                    ?>
                            <p><a class="sidebar_link" href="http://10.101.0.44/tv.php">
                                    Телевидение</a></p>
                    <?php
                        }    
                    ?>
                            
                    <?php
                        if ($user_priv == 'root' or $user_priv == 'admin' or 
                                $user_priv == $phone_priv){
                    ?>
                            <p><a class="sidebar_link" href="http://10.101.0.44/phone.php">
                                    Телефония</a></p>
                    <?php
                        }    
                    ?>
                    
                    <?php
                        if ($user_priv == 'root' or $user_priv == 'admin'){
                    ?>
                            <p><a class="sidebar_link" href="http://10.101.0.44/adminka.php">
                                    Админка</a></p>
                    <?php
                        }    
                    ?>
                </td>
                
                <td class="general_content">
                    <header class="general_content_header">
                        Это страница телевидения
                    </header>
                </td>
            </tr>
        </table>
    </body>
</html>


