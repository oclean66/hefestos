<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title><?php echo Yii::app()->name; ?></title>
    <meta name="theme-color" content="#f8a31f">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Administrador de Inventarios">
    <meta name="author" content="<?php echo Yii::app()->name; ?>">
    <link rel="manifest" href="/hefestos/manifest.json">
    <?php
    $baseUrl = Yii::app()->theme->baseUrl;
    $cs = Yii::app()->getClientScript();
    Yii::app()->clientScript->registerCoreScript('jquery');

    //<!-- Datepicker -->
    $cs->registerCssFile($baseUrl . '/css/plugins/datetimepicker/bootstrap-datetimepicker.css', 'screen');
    //<!-- timepicker -->
    $cs->registerCssFile($baseUrl . '/css/plugins/timepicker/bootstrap-timepicker.min.css', 'screen');

    //<!-- Bootstrap -->
    $cs->registerCssFile($baseUrl . '/css/bootstrap.min.css', 'screen');
    //<!-- jQuery UI -->
    $cs->registerCssFile($baseUrl . '/css/plugins/jquery-ui/smoothness/jquery-ui.css', 'screen');
    $cs->registerCssFile($baseUrl . '/css/plugins/jquery-ui/smoothness/jquery.ui.theme.css', 'screen');
    //<!-- Notify -->
    $cs->registerCssFile($baseUrl . '/css/plugins/gritter/jquery.gritter.css', 'screen');

    //<!-- select2 -->
    $cs->registerCssFile($baseUrl . '/css/plugins/select2/select2.css', 'screen');

    //<!-- croppie -->
    $cs->registerCssFile($baseUrl . '/css/plugins/croppie/croppie.css', 'screen');

    //<!-- Theme CSS -->        
    $cs->registerCssFile($baseUrl . '/css/style.css', 'screen');
    //<!-- Color CSS -->
    $cs->registerCssFile($baseUrl . '/css/themes.css', 'screen');
    $cs->registerCssFile($baseUrl . '/css/plugins/dynatree/ui.dynatree.css', 'screen');

    //<!-- Prints -->
    $cs->registerCssFile($baseUrl . '/css/print.css', 'print'); //para imprimir
    //$cs->registerCssFile($baseUrl . '/css/daterange/daterangepicker-bs2.css', 'screen');
    //<!-- jQuery -->
    // $cs->registerScriptFile($baseUrl . '/js/jquery.min.js'); //da error en los filtros
    //
    //<!-- Datepicker -->
    //$cs->registerScriptFile($baseUrl . '/js/plugins/datepicker/bootstrap-datepicker.js');
    //<!-- Timepicker -->
    //$cs->registerScriptFile($baseUrl . '/js/plugins/timepicker/bootstrap-timepicker.min.js');
    //<!-- DateTimepicker -->
    //<!-- Daterangepicker -->


    $cs->registerScriptFile($baseUrl . '/js/plugins/datetimepicker/moment.js');
    $cs->registerScriptFile($baseUrl . '/js/plugins/datetimepicker/moment-with-locales.js');
    $cs->registerScriptFile($baseUrl . '/js/plugins/datetimepicker/bootstrap-datetimepicker.js');


    //<!-- Nice Scroll -->
    $cs->registerScriptFile($baseUrl . '/js/plugins/nicescroll/jquery.nicescroll.min.js');
    //<!-- imagesLoaded -->
    // $cs->registerScriptFile($baseUrl . '/js/plugins/imagesLoaded/jquery.imagesloaded.min.js');
    //<!-- jQuery UI -->
    $cs->registerScriptFile($baseUrl . '/js/plugins/jquery-ui/jquery.ui.core.min.js');
    $cs->registerScriptFile($baseUrl . '/js/plugins/jquery-ui/jquery.ui.widget.min.js');
    $cs->registerScriptFile($baseUrl . '/js/plugins/jquery-ui/jquery.ui.mouse.min.js');
    $cs->registerScriptFile($baseUrl . '/js/plugins/jquery-ui/jquery.ui.resizable.min.js');
    $cs->registerScriptFile($baseUrl . '/js/plugins/jquery-ui/jquery.ui.sortable.min.js');
    //<!-- slimScroll -->
    $cs->registerScriptFile($baseUrl . '/js/plugins/slimscroll/jquery.slimscroll.min.js');
    //<!-- Bootstrap -->
    $cs->registerScriptFile($baseUrl . '/js/bootstrap.min.js');
    //<!-- Bootbox -->
    $cs->registerScriptFile($baseUrl . '/js/plugins/bootbox/jquery.bootbox.js');
    $cs->registerScriptFile($baseUrl . '/js/plugins/form/jquery.form.min.js');
    $cs->registerScriptFile($baseUrl . '/js/plugins/dynatree/jquery.dynatree.js');
    //<!-- Notify -->
    $cs->registerScriptFile($baseUrl . '/js/plugins/gritter/jquery.gritter.min.js');

    //<!-- Validation -->
    $cs->registerScriptFile($baseUrl . '/js/plugins/validation/jquery.validate.min.js');
    $cs->registerScriptFile($baseUrl . '/js/plugins/validation/additional-methods.min.js');

    //<!-- croppie -->
    $cs->registerScriptFile($baseUrl . '/js/plugins/croppie/croppie.min.js');

    //<!-- Theme framework -->
    $cs->registerScriptFile($baseUrl . '/js/eakroko.min.js');
    //<!-- Theme scripts -->
    $cs->registerScriptFile($baseUrl . '/js/application.min.js');
    //<!-- Just for demonstration -->
    $cs->registerScriptFile($baseUrl . '/js/demonstration.min.js');


    //        <!-- select2 -->
    //	<script src="js/plugins/select2/select2.min.js"></script>
    $cs->registerScriptFile($baseUrl . '/js/plugins/select2/select2.min.js');

    Yii::app()->clientScript->registerScript('activarSelects', 'function ActivarSelects(id, data){
            $("select").select2();
            $(".select2-container").css("width", "100%");
            $(".select2-container").css("heigth", "22px");
            $( "input[type=\'text\']" ).addClass("form-control");
            $("[rel=popover]").popover();
          
        }');

        $theme =  Yii::app()->user->um->getFieldValue(Yii::app()->user->id, 'theme') == "" ? "orange" :  Yii::app()->user->um->getFieldValue(Yii::app()->user->id, 'theme');
 
    ?>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo $baseUrl ?>/img/logo.png" />
    <!-- Apple devices Homescreen icon -->
    <link rel="apple-touch-icon-precomposed" href="img/logo-big.png" />
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: orange;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>

<body data-mobile-sidebar="button" class="theme-<?php echo $theme; ?>" data-theme="theme-<?php echo $theme; ?>" onload="$('#progress').attr('style', 'width:0%')">
    <div id="navigation" class="navbar-fixed-top">
        <!-- Require the navigation -->
        <?php require_once('tpl_navigation.php') ?>
    </div><!-- /#navigation-main -->

    <div class="container-fluid" id="content" style="padding-top: 40px;">

        <?php // require_once('column2.php')   
        ?>


        <div id="main">
            <div class="container-fluid">
                <!-- Include content pages -->
                <?php echo $content; ?>

            </div>
        </div>
    </div>
    <section id="footer">
        <!-- Require the footer -->
        <?php require_once('tpl_footer.php') ?>

    </section>
    <script>
        $(function() {
            $("select").select2();
            $(".select2-container").css('width', '100%');
            $("input[type='text']").addClass("form-control");
            // $("#datepicker1").datepicker();
        });
    </script>

</body>
<script>
    $('a:not(.dropdown-toggle):not(.mobile-sidebar-toggle):not(.not-link)').click(function() {
        $('#progress').attr('style', 'width:100%');
    });
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-S0TY8Y6YL3"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-S0TY8Y6YL3');
</script>

</html>