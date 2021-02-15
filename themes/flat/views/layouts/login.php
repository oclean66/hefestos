<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title><?php echo Yii::app()->name;?></title>
        <meta name="theme-color" content="#f8a31f">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Administrador de Inventarios">
        <meta name="author" content="<?php echo Yii::app()->name;?>">
        <link rel="manifest" href="/hefestos/manifest.json">

        <!--[if lte IE 9]>
                <script src="js/plugins/placeholder/jquery.placeholder.min.js"></script>
                <script>
                        $(document).ready(function() {
                                $('input, textarea').placeholder();
                        });
                </script>
        <![endif]-->
        <?php $baseUrl = Yii::app()->theme->baseUrl; ?>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?php echo $baseUrl ?>/css/bootstrap.min.css">
        <!-- icheck -->
        <link rel="stylesheet" href="<?php echo $baseUrl ?>/css/plugins/icheck/all.css">
        <!-- Theme CSS -->
        <link rel="stylesheet" href="<?php echo $baseUrl ?>/css/style.css">
        <!-- Color CSS -->
        <link rel="stylesheet" href="<?php echo $baseUrl ?>/css/themes.css">


        <!-- jQuery -->
        <!--<script src="<?php echo $baseUrl ?>/js/jquery.min.js"></script>-->

        <!-- Nice Scroll -->
        <!--<script src="<?php echo $baseUrl ?>/js/plugins/nicescroll/jquery.nicescroll.min.js"></script>-->
        <!-- Validation -->
        <!--<script src="<?php echo $baseUrl ?>/js/plugins/validation/jquery.validate.min.js"></script>-->
        <!--<script src="<?php echo $baseUrl ?>/js/plugins/validation/additional-methods.min.js"></script>-->
        <!-- icheck -->
        <script src="<?php echo $baseUrl ?>/js/plugins/icheck/jquery.icheck.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo $baseUrl ?>/js/bootstrap.min.js"></script>
        <script src="<?php echo $baseUrl ?>/js/eakroko.js"></script>



        <!-- Favicon -->
        <link rel="shortcut icon" href="<?php echo $baseUrl ?>/img/logo.png" />
        <!-- Apple devices Homescreen icon -->
        <link rel="apple-touch-icon-precomposed" href="<?php echo $baseUrl ?>/img/logo-big.png" />
<style>
 @media (max-width: 480px) {
        /* Specific to this particular image */
        #brand {
          width: 150px;
        }
      }
      </style>
    </head>

    <body class='login theme-orange' data-theme='theme-orange' style='background-image: url("https://www.transparenttextures.com/patterns/subtle-grey.png");'>
        <div class="wrapper">
            <h1>
                <a href="#">
                    <img id="brand" src="<?php echo $baseUrl ?>/img/logo-bigger.png" alt="" class='retina-ready' >
                    <br/>
                    <span style="font-size:40px"><?php echo Yii::app()->name;?></span>
                </a>
            </h1>

            <?php echo $content; ?>

        </div>

    </body>
</html>