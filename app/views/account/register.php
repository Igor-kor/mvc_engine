<?php
/**
 * Created by PhpStorm.
 * User: игорь
 * Date: 02.07.2018
 * Time: 21:41
 */
?>
<div class="register">
    <h2>Регистрация</h2>
    <div class="errors"><?php if (isset($error)) echo $error ?></div>
    <div class="ok"><?php if (isset($register)) echo 'Пользователь зарегистрирован' ?></div>
    <form action="" method="post">
        <label>
            <input name="login" type="text" aria-label="Login">
        </label>
        <label>
            <input name="password" type="password" aria-label="Password">
        </label>
        <label>
            <input name="name" type="text" aria-label="name">
        </label>
        <input type="submit" value="Регистрация">
    </form>
    <br><a href="<?php if(isset($config['request_url'])) echo '/'.$config['request_url']; ?>/account/login">Войти</a>
</div>
