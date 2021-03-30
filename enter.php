<?php
    session_start();
    
    if (isset($_COOKIE['user_id']))
    {
        header("Location: startpage.php");
    }
?>


<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Авторизация</title>
        <link rel="stylesheet" href="assets/css/auth_styles.css"/>
    </head>
    <body>
        <form class="auth_form" action="database/signin.php" method="POST">
            <p class="auth_msg">
                <?php
                    echo $_SESSION['error_msg'];
                    unset($_SESSION['error_msg']);
                ?>
            </p>
            <label>Логин</label>
            <input type="text" name="login" placeholder="Введите логин">
            <label>Пароль</label>
            <input type="password" name="pass" placeholder="Введите пароль">
            <button type="submit">Войти</button>
            <p>
                </br>
                Для получения доступа к сайту заполните</br>форму регистрации
                для создания нового</br>аккаунта:
                <a href="#">Форма регистрации</a> </br></br>
                При возникновении вопросов вы можете</br>связаться с
                администратором сайта:</br>
                <a href="https://t.me/homelessscat">Гимадеев Дмитрий Александрович</a></br>
            </p>
        </form>
    </body>
</html>
