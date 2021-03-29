<?php
    session_start();
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Регистрация нового пользователя</title>
        <link rel="stylesheet" href="assets/css/reg_styles.css"/>
    </head>
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
            <!--<input type="text" name='privileges' placeholder="Выберите уровень привилегий">-->
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