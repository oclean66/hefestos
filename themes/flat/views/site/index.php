<style>
    #main {
        margin-left: 0px;
        height: 100%;
    }

    #left {
        display: none;
    }
</style>
<?php
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


    <div class="col-sm-12">
        <ul class="tiles">
            <li class="long red">
                <a href="#">
                    <span class="nopadding">
                        <h5><?= Yii::app()->user->um->getFieldValue(Yii::app()->user->id, 'nombre') ?></h5>
                      
                        <p><?php echo !Yii::app()->user->isGuest ? "Nodo: " . Yii::app()->user->grupo : "" ?></p>
                        <p><?php echo !Yii::app()->user->isGuest ? "Bussiness: " . Yii::app()->user->bussiness : "" ?></p>
                    </span>
                    <span class="name">
                        <i class="fa fa-twitter"></i>
                        <span class="right"><?= date("d/m/Y") ?></span>
                    </span>
                </a>
            </li>

            <li class="blue long">
                <a href="#">
                    <span class="nopadding">
                        <h5><?= Yii::app()->user->um->getFieldValue(Yii::app()->user->id, 'nombre') ?></h5>
                        <p>Bienvenido, Tenemos nuevas actualizaciones</p>
                    </span>
                    <span class="name">
                        <i class="fa fa-twitter"></i>
                        <span class="right"><?= date("d/m/Y") ?></span>
                    </span>
                </a>
            </li>

            <li class="orange">
                <?php if (Yii::app()->user->checkAccess('action_gcca_admin')) { ?>
                    <a target="_blank" href="<?php echo Yii::app()->createUrl('gcca/admin'); ?>">
                        <span class="">
                            <i class="fa fa-home"></i> </span>
                        <span class="name">Agencias</span>
                    </a>
            </li>
        <?php }; ?>

        <!-- <li class="pink ">
                <a target="_blank" href="<?php echo Yii::app()->createUrl('fccu/admin'); ?>">
                    <span class="">
                        <i class="fa fa-print"></i> </span>
                    <span class="name">Activos</span>
                </a>
            </li> -->

        <li class="darkblue ">
            <?php if (Yii::app()->user->checkAccess('action_fccu_add')) { ?>
                <a target="_blank" href="<?php echo Yii::app()->createUrl('fccu/add'); ?>">
                    <span class="">
                        <i class="fa fa-star"></i> </span>
                    <span class="name">Agregar Activo</span>
                </a>
        </li>
    <?php }; ?>

    <li class="lime">
        <?php if (Yii::app()->user->checkAccess('action_fcco_create')) { ?>
            <a target="_blank" href="<?php echo Yii::app()->createUrl('fcco/create'); ?>">
                <span class="">
                    <i class="fa fa-plus-square"></i> </span>
                <span class="name">Asignar Activo</span>
            </a>
    </li>
<?php }; ?>

<li class="red">
    <?php if (Yii::app()->user->checkAccess('action_fcco_less')) { ?>
        <a target="_blank" href="<?php echo Yii::app()->createUrl('fcco/less'); ?>">
            <span class="">
                <i class="fa fa-minus-square"></i> </span>
            <span class="name">Recibir Activo</span>
        </a>
</li>
<?php }; ?>



<li class="teal ">
    <?php if (Yii::app()->user->checkAccess('action_fcco_admin')) { ?>
        <a target="_blank" href="<?php echo Yii::app()->createUrl('fcco/admin'); ?>">
            <span class="">
                <i class="fa fa-sitemap"></i> </span>
            <span class="name">Arbol</span>
        </a>
</li>
<?php }; ?>

<?php if (Yii::app()->user->checkAccess('action_fcco_report')) { ?>
    <li class="green ">
        <a target="_blank" href="<?php echo Yii::app()->createUrl('fcco/report', array('FCCN_Id' => 2)); ?>">
            <span class="">
                <i class="fa fa-sign-in"></i> </span>
            <span class="name">Entradas</span>
        </a>
    </li>


    <li class="blue ">
        <a target="_blank" href="<?php echo Yii::app()->createUrl('/fcco/report', array('FCCN_Id' => 1)); ?>">
            <span class="">
                <i class="fa fa-sign-out"></i> </span>
            <span class="name">Salidas</span>
        </a>
    </li>
<?php }; ?>


        </ul>
    </div>

    <div class="col-sm-12">
        <ul class="tiles">
            <?php if (Yii::app()->user->checkAccess('action_tcca_index')) { ?>
                <li class="blue long">
                    <a target="_blank" href="<?php echo Yii::app()->createUrl('tcca'); ?>">
                        <span class="nopadding">
                            <i class="fa fa-bookmark"></i> </span>
                        <p>Tableros</p>
                        </span>
                    </a>
                </li>
            <?php } ?>




        </ul>

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