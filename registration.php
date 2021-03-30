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
    
    if ($user_priv != 'root' and $user_priv != 'admin'){
        header("Location: startpage.php");
    }
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Регистрация нового пользователя</title>
        <link rel="stylesheet" href="assets/css/reg_styles.css"/>
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
                    <form class="exit_form" action="adminka.php">
                        <button >Назад</button>
                    </form>
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
        <!-- Форма регистрации -->
        
        <form class="reg_form" action="database/signup.php" method="post">
            <p class="reg_msg">
                <?php
                    echo $_SESSION['error_msg'];
                    unset($_SESSION['error_msg']);
                ?>
            </p>
            <label>Фамилия</label>
            <input type="text" name='surname' placeholder="Введите фамилию">
            <label>Имя</label>
            <input type="text" name='name' placeholder="Введите имя">
            <label>Отчество</label>
            <input type="text" name='patronymic' placeholder="Введите отчество">
            <label>Привилегии</label>
            <!--<select type="text">
                <option disabled selected>Выберите уровень привилегий</option>
                <option value="guest">Гость</option>
                <option value="common_user">Пользователь</option>
                <option value="admin">Админ</option>
            </select>-->
            <input type="text" name='privilege' placeholder="Введите уровень привилегий">
            <label>Логин</label>
            <input type="text" name='login' placeholder="Введите логин">
            <label>Пароль</label>
            <input type="password" name='pass' placeholder="Введите пароль">
            <label>Подтвердите пароль</label>
            <input type="password" name='pass_confirm' placeholder="Введите пароль повторно">
            <button type="submit">Зарегистрировать пользователя</button>
        </form>
        
    </body>
</html>