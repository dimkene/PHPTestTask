<?php
    session_start();
    if (empty($_COOKIE['login'])){
        header("Location: enter.php");
    }
    require 'database/dbconnect.php';
    mysqli_set_charset($link, 'utf8');
    
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Админка</title>
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
                <td  class="general_content">
                    <header class="general_content_header">
                        Админка
                    </header>
                    <div>
                        <p class="admin_tables_name"> Пользователи </p>
                        <div class="admin_tables">
                        
                        </div>
                        
                        <p class="admin_tables_name"> Неподтвержденные пользователи </p>
                        <div class="admin_tables">
                            
                        </div>
                        
                        <p class="admin_tables_name"> Доступ к страницам </p>
                        <div class="admin_tables">

                        </div>
                        
                        <p class="admin_tables_name"> Логи </p>
                        <div class="admin_tables">
                            <table class="admin_tables_row">
                                <tr>
                                    <th>Пользователь</th>
                                    <th>Тип доступа</th>
                                    <th>Время</th>
                                </tr>
                                <?php
                                    $logs_query = "SELECT * FROM `Log`";
                                    $logs = mysqli_query($link, $logs_query);
                                    $rows = mysqli_num_rows($logs);

                                    for ($i = 0; $i < $rows; ++$i)
                                    {
                                ?>
                                <tr>
                                <?php
                                        $row = mysqli_fetch_row($logs);
                                        for ($j = 1; $j < 4; ++$j)
                                        {
                                ?>
                                    <td>
                                <?php
                                            echo $row[$j];
                                ?>
                                    </td>
                                <?php
                                        }
                                ?>
                                </tr>
                                <?php
                                    }
                                ?>
                            </table>    
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>


