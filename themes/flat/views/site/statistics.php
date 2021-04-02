<style>
    #main {
        margin-left: 0px;
    }

    #left {
        display: none;
    }
</style>
<?php

$color = array("lime", "lime", "red", "lime", "lime", "orange", "red", "red", "red", "orange", "orange");
$colores = array("lime", "pink", "magenta", "satgreen", "blue", "teal", "orange");




if (Yii::app()->user->isGuest)
    $this->redirect('cruge/ui/login');
?>
<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl;
?>
<div class="page-header">
    <div class="pull-left">
        <ul class="minitiles">
            <li class="">
                <img style="width: 190px;" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/brand.png">
            </li>

        </ul>

    </div>
    <div class="pull-right">

        <ul class="stats">

            <li class="lightred">
                <i class="fa fa-calendar"></i>
                <div class="details">
                    <span class="big"><?php echo date('j \d\e M Y'); ?></span>
                    <span><?php echo date('l, h:ia'); ?></span>
                </div>
            </li>
        </ul>
    </div>
</div>

<!--Logo de dashbord-->
<div>


    <div class="col-sm-12 hide">
        <ul class="tiles">

            <li class="blue long">
                <a href="#">
                    <span class="nopadding">
                        <h5>@oclean66</h5>
                        <p>Bienvenido, Tenemos nuevas actualizaciones</p>
                    </span>
                    <span class="name">
                        <i class="fa fa-twitter"></i>
                        <span class="right">09/01/2020</span>
                    </span>
                </a>
            </li>

            <li class="orange ">
                <a target="_blank" href="<?php echo Yii::app()->createUrl('gcca/admin'); ?>">
                    <span class="">
                        <i class="fa fa-home"></i> </span>
                    <span class="name">Agencias</span>
                </a>
            </li>

            <!-- <li class="pink ">
                <a target="_blank" href="<?php echo Yii::app()->createUrl('fccu/admin'); ?>">
                    <span class="">
                        <i class="fa fa-print"></i> </span>
                    <span class="name">Activos</span>
                </a>
            </li> -->

            <li class="darkblue ">
                <a target="_blank" href="<?php echo Yii::app()->createUrl('fccu/add'); ?>">
                    <span class="">
                        <i class="fa fa-star"></i> </span>
                    <span class="name">Agregar Activo</span>
                </a>
            </li>

            <li class="lime">
                <a target="_blank" href="<?php echo Yii::app()->createUrl('fcco/create'); ?>">
                    <span class="">
                        <i class="fa fa-plus-square"></i> </span>
                    <span class="name">Asignar Activo</span>
                </a>
            </li>

            <li class="red">
                <a target="_blank" href="<?php echo Yii::app()->createUrl('fcco/less'); ?>">
                    <span class="">
                        <i class="fa fa-minus-square"></i> </span>
                    <span class="name">Recibir Activo</span>
                </a>
            </li>



            <li class="teal ">
                <a target="_blank" href="<?php echo Yii::app()->createUrl('fcco/admin'); ?>">
                    <span class="">
                        <i class="fa fa-sitemap"></i> </span>
                    <span class="name">Arbol</span>
                </a>
            </li>


            <li class="green ">
                <a target="_blank" href="<?php echo Yii::app()->createUrl('fcco/report.html?FCCN_Id)=2'); ?>">
                    <span class="">
                        <i class="fa fa-sign-in"></i> </span>
                    <span class="name">Entradas</span>
                </a>
            </li>
            <li class="blue ">
                <a target="_blank" href="<?php echo Yii::app()->createUrl('fcco/report.html?FCCN_Id=1'); ?>">
                    <span class="">
                        <i class="fa fa-sign-out"></i> </span>
                    <span class="name">Salidas</span>
                </a>
            </li>


        </ul>
    </div>

    <div class="col-sm-12">
        <div class="panel-group panel-widget" id="ac3">
            <div class="panel panel-default orange">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a href="#c1" data-toggle="collapse" data-parent="#ac3" class="collapsed">
                            <i class="fa fa-th-list"></i>
                            Activos Por Estado
                        </a>
                    </h4>
                </div>
                <div id="c1" class="panel-collapse collapse" style="height: 0px;" >
                    <div class="panel-body" >
                        <div class="box-content">
                            <ul class="stats">
                                <?php
                                foreach ($data['estados'] as $key => $value) {
                                ?>
                                    <li class=<?php echo $color[$key]; ?> style="margin-top:5px">
                                        <i class="fa fa-desktop"></i></span>
                                        <div class="details">
                                            <span class="big"> <?php echo $value['cantidad']; ?></span>
                                            <span style="display:block;text-overflow: Ellipsis;width: 122px;overflow: hidden; white-space: nowrap;"><?php echo $value['name']; ?></span>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /#c1.panel-collapse collapse in -->
            </div>
            <!-- /.panel panel-default -->
            <div class="panel panel-default teal">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a href="#c3" data-toggle="collapse" data-parent="#ac3" class="collapsed">
                            <i class="fa fa-users"></i>
                            Agencias Por Grupos
                        </a>
                    </h4>
                    <!-- /.panel-title -->
                </div>
                <!-- /.panel-heading -->
                <div id="c3" class="panel-collapse collapse" style="height: 0px;">
                    <div class="panel-body">
                        <div class="box-content">
                            <ul class="stats">
                                <?php
                                foreach ($data['agencias'] as $key => $value) {
                                ?>
                                    <li class=<?php echo $colores[array_rand($colores, 1)]; ?> style="margin-top:5px">
                                        <i class="fa fa-users"></i></span>
                                        <div class="details">
                                            <span class="big"> <?php echo $value['cantidad']; ?></span>
                                            <span style="display:block;text-overflow: Ellipsis;width: 122px;overflow: hidden; white-space: nowrap;"><?php echo $value['name']; ?></span>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /#c1.panel-collapse collapse in -->
            </div>
            <div class="panel panel-default magenta">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a href="#c2" data-toggle="collapse" data-parent="#ac3" class="collapsed">
                            <i class="fa fa-th-list"></i>
                            Activos Por Modelo
                        </a>
                    </h4>
                    <!-- /.panel-title -->
                </div>
                <!-- /.panel-heading -->
                <div id="c2" class="panel-collapse collapse" style="height: 0px;">
                    <div class="panel-body">
                        <div class="box-content">
                            <div class="basic-margin" style="display:block">
                                <?php
                                foreach ($data['tipos'] as $value) {
                                ?>
                                    <ul class="stats" style="margin-right: 5px;display:block; ">
                                        <?php
                                        echo "<h4>" . $value['name'] . " (" . $value['cantidad'] . ") |</h4>";
                                        foreach ($value['modelos'] as $valueX) {
                                        ?>
                                            <li class=<?php echo $colores[array_rand($colores, 1)]; ?> style="margin-top:3px;">
                                                <i class="fa fa-desktop"></i></span>
                                                <div class="details">
                                                    <span class="big"> <?php echo $valueX['cantidad']; ?></span>
                                                    <span style="display:block;text-overflow: Ellipsis;width: 122px;overflow: hidden; white-space: nowrap;"><?php echo $valueX['name']; ?></span>
                                                </div>
                                            </li>
                                        <?php } ?>
                                        <li class="divider"></li>
                                    </ul>
                                    <!-- <br/> -->
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /#c1.panel-collapse collapse in -->
            </div>
            <!-- /.panel panel-default -->
            <!-- /.panel panel-default -->
        </div>
        <!-- /.panel-group -->
    </div>





    <div class="col-sm-12" style="display:flex">
        <ul class="tiles" style="margin:auto">
            <?php if (Yii::app()->user->checkAccess('action_tcca_index')) { ?>
                <li class="blue long hide">
                    <a target="_blank" href="<?php echo Yii::app()->createUrl('tcca'); ?>">
                        <span class="nopadding">
                            <i class="fa fa-bookmark"></i> </span>
                        <p>Tableros</p>
                        </span>
                    </a>
                </li>
            <?php } ?>

            <li class="lime long">
                <a href="#">
                    <span class="count">
                        <i class="fa fa-desktop"></i> <?php echo $data['activas']; ?></span>
                    <span class="name">Agencias Activas</span>
                </a>
            </li>
            <li class="red long">
                <a href="#">
                    <span class="count">
                        <i class="fa fa-desktop"></i> <?php echo $data['inactivas']; ?></span>
                    <span class="name">Agencias Inactivas</span>
                </a>
            </li>
            <li class="teal long">
                <a href="#">
                    <span class="count">
                        <i class="fa fa-users"></i> <?php echo $data['grupos']; ?></span>
                    <span class="name">Grupos Activos</span>
                </a>
            </li>
        </ul>


    </div>






    <!-- <pre>
<?php

//print_r($data);
?>
</pre> -->
</div>
<script type="text/javascript">
    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
    Tawk_API.visitor = {
        name: '<?php echo Yii::app()->user->name; ?>',
        email: '<?php echo Yii::app()->user->email; ?>'
    };

    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/5ecc2a98c75cbf1769ef3f32/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>