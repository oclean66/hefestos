
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title><?php echo Yii::app()->name; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Aplicacion de administracion de logros">
        <meta name="author" content="<?php echo Yii::app()->name;?>">

        <?php
        $baseUrl = Yii::app()->theme->baseUrl;
        $cs = Yii::app()->getClientScript();
        Yii::app()->clientScript->registerCoreScript('jquery');

        //<!-- Datepicker -->
        $cs->registerCssFile($baseUrl . '/css/bootstrap.min.css', 'screen');
        $cs->registerCssFile($baseUrl . '/css/style.css', 'screen');
        $cs->registerCssFile($baseUrl . '/css/themes.css', 'screen');



        $cs->registerScriptFile($baseUrl . '/js/jquery.min.js');
        $cs->registerScriptFile($baseUrl . '/js/plugins/nicescroll/jquery.nicescroll.min.js');
        $cs->registerScriptFile($baseUrl . '/js/bootstrap.min.js');
        ?>
        <!-- Favicon -->
        <link rel="shortcut icon" href="<?php echo $baseUrl ?>/img/logo.png" />
        <!-- Apple devices Homescreen icon -->
        <link rel="apple-touch-icon-precomposed" href="img/logo-big.png" />

    </head>

    <body class='error'>
        <?php echo $content; ?>

    </body>   
</html>