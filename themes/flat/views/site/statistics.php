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


<!--Logo de dashbord-->
<div>


    <div class="col-sm-12" style="display:flex">
        <ul class="tiles" style="">
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
                <div id="c1" class="panel-collapse" style="height: 0px;">
                    <div class="panel-body">
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
        </div>
    </div>

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