<?php
/**
 * Created by PhpStorm.
 * User: игорь
 * Date: 23.06.2018
 * Time: 10:45
 */

?>
<p><h2><?php echo $code; ?> Error</h2><br>
<?php if (isset($config['dev']) && $config['dev'] == 'true') {
    ?>
    <?php if (isset($errstr) && $errstr != '') echo '<p><b>Ошибка ' . $errstr . '</b></p>' ?>
    <?php if (isset($errfile)) echo '<p>Файл ' . $errfile . '</p>' ?>
    <?php if (isset($errline)) echo '<p>Строка ' . $errline . '</p>' ?>
    <?php if (isset($errcontext) && count($errcontext) > 0) {
        echo '<p>Стэк ';
        print_r($errcontext);
        echo '</p>';
    } ?>
    <?php if (isset($errstr) && $errstr != '') echo '<p><b><a href ="https://stackoverflow.com/search?q=' . $errstr . '">Искать на stackoverflow </a></b></p>' ?>
    <?php
}
?>

<a href="/<?php if (isset($config['request_url']))
    echo $config['request_url'];
?>">To home page</a></p>
