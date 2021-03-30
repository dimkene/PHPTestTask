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
                        $user_priv = $_COOKIE['user_privilege'];
                        if ($user_priv == 'root' or $user_priv == 'admin'){
                    ?>
                            <p><a class="sidebar_link" href="http://10.101.0.44/computer.php">
                                    Компьютеры</a></p>
                    <?php
                        }    
                    ?>
                            
                    <?php
                        $user_priv = $_COOKIE['user_privilege'];
                        if ($user_priv == 'root' or $user_priv == 'admin'){
                    ?>
                            <p><a class="sidebar_link" href="http://10.101.0.44/tv.php">
                                    Телевидение</a></p>
                    <?php
                        }    
                    ?>
                    
                    <?php
                        $user_priv = $_COOKIE['user_privilege'];
                        if ($user_priv == 'root' or $user_priv == 'admin'){
                    ?>
                            <p><a class="sidebar_link" href="http://10.101.0.44/phone.php">
                                    Телефония</a></p>
                    <?php
                        }    
                    ?>

                    <?php
                        $user_priv = $_COOKIE['user_privilege'];
                        if ($user_priv == 'root' or $user_priv == 'admin'){
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
                        <table style="width: 100%;">
                            <tr>
                                <td>
                                    <p class="admin_tables_name"> Пользователи </p>
                                    <div class="admin_tables">
                                        <table class="admin_tables_row">
                                            <tr>
                                                <th>Фамилия</th>
                                                <th>Имя</th>
                                                <th>Отчество</th>
                                                <th>Логин</th>
                                                <th>Уровень привилегий</th>
                                            </tr>
                                            <?php
                                                $logs_query = "SELECT `Surname`, `Name`, `Patronymic`, `Login`, `Privilege` FROM `User` WHERE `Privilege` != 'root'";
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
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </table>    
                                    </div>
                                </td>
                                
                                <td style="width: 27%;">
                                    <form class="upload_form" action="database/changeprivilege.php" method="POST">
                                        <p class="update_msg">
                                            <?php
                                                echo $_SESSION['priv_update_msg'];
                                                unset($_SESSION['priv_update_msg']);
                                            ?>
                                        </p>
                                        <p><label>Изменить уровень привилегий</label></p>
                                        <p><input type="text" name="login" placeholder="Логин пользователя"></p>
                                        <p><input type="text" name="new_privilege" placeholder="Новый уровень привилегий"></p>
                                        <button type="submit">Изменить</button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                        
                        <table style="width: 100%;">
                            <tr>
                                <td>
                                    <p class="admin_tables_name"> Доступ к страницам </p>
                                    <div class="admin_tables">
                                        <table class="admin_tables_row">
                                            <tr>
                                                <th>Название страницы</th>
                                                <th>Уровень доступа</th>
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
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </table>    
                                    </div>
                                </td>
                                
                                <td style="width: 27%;">
                                    <form class="upload_form" action="database/changeaccess.php" method="POST">
                                        <p class="update_msg">
                                            <?php
                                                echo $_SESSION['page_update_msg'];
                                                unset($_SESSION['page_update_msg']);
                                            ?>
                                        </p>
                                        <p><label>Изменить доступность страницы</label></p>
                                        <p><input type="text" name="page_name" placeholder="Имя страницы"></p>
                                        <p><input type="text" name="new_access" placeholder="Новый уровень доступа"></p>
                                        <button type="submit">Изменить</button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                        
                        <table style="width: 100%;">
                            <tr>
                                <td>
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
                                    
                                    <td style="width: 27%;">
                                        <p><a class="sidebar_link" href="http://10.101.0.44/registration.php">
                                                Регистрация нового пользователя</a></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>


