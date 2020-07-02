<?php
/**
 * Created by PhpStorm.
 * User: игорь
 * Date: 22.06.2018
 * Time: 23:13
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title ?></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css"
          href="/<?php if (isset($config['request_url'])) echo $config['request_url'] ?>/public/style.css">
</head>
<body>
<?php echo $content ?>
</body>
</html>

