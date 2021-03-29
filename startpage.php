<?php
    session_start();
    
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Базовая страница</title>
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
    <body>
        <!-- Основная страница -->
        <table >
            <tr>
                <td class="sidebar">
                    <!-- Переходы на страницы -->
                    <?php
                        if ($_COOKIE['user_privilege'] == 'root' or
                                $_COOKIE['user_privilege'] == 'admin'){
                    ?>
                            <p><a class="sidebar_link" href="http://10.101.0.44/computer.php">Компьютеры</a></p>
                    <?php
                        }    
                    ?>
                            
                    <?php
                        if ($_COOKIE['user_privilege'] == 'root' or
                                $_COOKIE['user_privilege'] == 'admin'){
                    ?>
                            <p><a class="sidebar_link" href="http://10.101.0.44/tv.php">Телевидение</a></p>
                    <?php
                        }    
                    ?>
                    
                    <?php
                        if ($_COOKIE['user_privilege'] == 'root' or
                                $_COOKIE['user_privilege'] == 'admin'){
                    ?>
                            <p><a class="sidebar_link" href="http://10.101.0.44/adminka.php">Админка</a></p>
                    <?php
                        }    
                    ?>
                </td>
                <td class="general_content">
                    <header>
                        Это стартовая страница
                    </header>
                </td>
            </tr>
        </table>
    </body>
</html>


