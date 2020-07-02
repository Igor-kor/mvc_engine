<?php
/**
 * Created by PhpStorm.
 * User: игорь
 * Date: 22.06.2018
 * Time: 23:16
 */
?>
<div class="authorize">
    <h2>Авторизация</h2>
    <div class="errors"><?php if (isset($error)) echo $error ?></div>
    <form action="" method="post">
        <label>
            <input name="login" type="text" aria-label="Login">
        </label>
        <label>
            <input name="password" type="password" aria-label="Password">
        </label>
        <input type="submit" value="Вход">
    </form>
    <br><a href="<?php if(isset($config['request_url'])) echo '/'.$config['request_url']; ?>/account/register">Зарегистрироваться</a>
</div>