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
                                    
                    <?php
                        if ($_COOKIE['user_privilege'] == 'root' or
                                $_COOKIE['user_privilege'] == 'admin'){
                    ?>
                            <p><a class="sidebar_link" href="http://10.101.0.44/registration.php">
                                    Регистрация нового пользователя</a></p>
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
                            <table class="admin_tables_row">
                                <tr>
                                    <th>Фамилия</th>
                                    <th>Имя</th>
                                    <th>Отчество</th>
                                    <th>Логин</th>
                                    <th>Уровень привилегий</th>
                                    <th>Изменить уровень привилегий</th>
                                </tr>
                                <?php
                                    $logs_query = "SELECT `Surname`, `Name`, `Patronymic`, `Login`, `Privilege` FROM `User`";
                                    $logs = mysqli_query($link, $logs_query);
                                    $rows = mysqli_num_rows($logs);

                                    for ($i = 0; $i < $rows; ++$i)
                                    {
                                ?>
                                <tr>
                                <?php
                                        $row = mysqli_fetch_row($logs);
                                        for ($j = 0; $j < 5; ++$j)
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
                                    <td>
                                        <form class="upload_form" action="database/signin.php" method="POST">
                                            <input type="text" name="new_privilege" placeholder="Новый уровень привилегий">
                                            <button type="submit">Изменить</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </table>    
                        </div>
                        
                        <p class="admin_tables_name"> Доступ к страницам </p>
                        <div class="admin_tables">
                            <table class="admin_tables_row">
                                <tr>
                                    <th>Название страницы</th>
                                    <th>Уровень доступа</th>
                                    <th>Изменить уровень доступа</th>
                                </tr>
                                <?php
                                    $logs_query = "SELECT `Name`, `Page_access` FROM `Pages` WHERE `Name` != 'Adminka'";
                                    $logs = mysqli_query($link, $logs_query);
                                    $rows = mysqli_num_rows($logs);

                                    for ($i = 0; $i < $rows; ++$i)
                                    {
                                ?>
                                <tr>
                                <?php
                                        $row = mysqli_fetch_row($logs);
                                        for ($j = 0; $j < 2; ++$j)
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
                                    <td>
                                        <form class="upload_form" action="database/signin.php" method="POST">
                                            <input type="text" name="new_privilege" placeholder="Новый уровень доступа">
                                            <button type="submit">Изменить</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </table>    
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


