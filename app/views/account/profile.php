<?php
/**
 * Created by PhpStorm.
 * User: игорь
 * Date: 02.07.2018
 * Time: 20:47
 */
?>
<h1>Профиль <?php echo $name;?></h1>
<p>Логин: <?php echo $login;?></p>
<p>Права доступа: <?php print_r($rules);?></p>
<br>

<a href="<?php if(isset($config['request_url'])) echo '/'.$config['request_url']; ?>/account/logout">Logout</a>
