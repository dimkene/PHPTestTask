<?php
    session_start();
    if (empty($_COOKIE['login'])){
        header("Location: enter.php");
    }
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Телефония</title>
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
                        if ($_COOKIE['user_privilege'] == 'root' or
                                $_COOKIE['user_privilege'] == 'admin'){
                    ?>
                            <p><a class="sidebar_link" href="http://10.101.0.44/computer.php">
                                    Компьютеры</a></p>
                    <?php
                        }    
                    ?>
                            
                    <?php
                        if ($_COOKIE['user_privilege'] == 'root' or
                                $_COOKIE['user_privilege'] == 'admin'){
                    ?>
                            <p><a class="sidebar_link" href="http://10.101.0.44/tv.php">
                                    Телевидение</a></p>
                    <?php
                        }    
                    ?>
                            
                    <?php
                        if ($_COOKIE['user_privilege'] == 'root' or
                                $_COOKIE['user_privilege'] == 'admin'){
                    ?>
                            <p><a class="sidebar_link" href="http://10.101.0.44/phone.php">
                                    Телефония</a></p>
                    <?php
                        }    
                    ?>
                    
                    <?php
                        if ($_COOKIE['user_privilege'] == 'root' or
                                $_COOKIE['user_privilege'] == 'admin'){
                    ?>
                            <p><a class="sidebar_link" href="http://10.101.0.44/adminka.php">
                                    Админка</a></p>
                    <?php
                        }    
                    ?>
                </td>
                <td class="general_content">
                    <header class="general_content_header">
                        Это страница телефонии
                    </header>
                </td>
            </tr>
        </table>
    </body>
</html>


