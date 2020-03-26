<div class="container-fluid " >
    <a href="#" class="mobile-sidebar-toggle">
        <i class="fa fa-th-list"></i>
    </a>
    <a href="<?php $this->createUrl('site/index') ?>" id="brand"><?php echo Yii::app()->name ?></a>
    <a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Herramientas">
        <i class="fa fa-bars"></i>
    </a> 
    <div>
        <?php
        $baseUrl = Yii::app()->theme->baseUrl;
        $visible = !Yii::app()->user->isGuest;
        $admin = Yii::app()->user->isSuperAdmin;
        $this->widget('zii.widgets.CMenu', array(
            'htmlOptions' => array('class' => 'main-nav'),
            'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
            'encodeLabel' => false,
            'items' => array(
                array('label' => 'Inicio', 'url' => array('/site/index'), 'visible' => Yii::app()->user->checkAccess('action_site_index')),
                array('label' => 'Activos <span class="caret"></span>', 'url' => '#', 'visible' => Yii::app()->user->checkAccess('controller_fccu'), 'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
                'items' => array(
                    array('label' => 'Agregar', 'url' => array('/fccu/add'), 'visible' => Yii::app()->user->checkAccess('action_fccu_add')),
                    array('label' => 'Asignar', 'url' => array('/fcco/create'), 'visible' => Yii::app()->user->checkAccess('action_fcco_create')),
                    array('label' => 'Recibir', 'url' => array('/fcco/less'), 'visible' => Yii::app()->user->checkAccess('action_fcco_less')),
                    array('label' => 'Buscar', 'url' => array('/fccu/admin'), 'visible' => Yii::app()->user->checkAccess('action_fccu_admin')),
                )),
                array('label' => 'Operaciones* <span class="caret"></span>', 'url' => '#', 'visible' => $admin, 'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
                    'items' => array(
                       
                        array('label' => 'Suministros*', 'url' => '#', 'visible' => $admin, 'itemOptions' => array('class' => 'dropdown-submenu', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
                            'items' => array(
                                array('label' => 'Asignar', 'url' => array('/fcco/create')),
                                array('label' => 'Recargar', 'url' => array('#')),
                                array('label' => 'Buscar', 'url' => array('/fccu/admin')),
                            )),
                        array('label' => 'Facturacion*', 'url' => '#', 'visible' => $admin, 'itemOptions' => array('class' => 'dropdown-submenu', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
                            'items' => array(
                                array('label' => 'Asignar', 'url' => array('#')),
                                array('label' => 'Recargar', 'url' => array('#')),
                                array('label' => 'Buscar', 'url' => array('#')),
                            )),
                    )),
                array('label' => 'Mantenimiento <span class="caret"></span>', 'url' => '#', 'visible' => $visible, 'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
                    'items' => array(
                        array('label' => 'Grupos', 'url' => array('/gccd/admin'), 'visible' => Yii::app()->user->checkAccess('action_gccd_admin')),
                        array('label' => 'Agencias', 'url' => array('/gcca/admin'), 'visible' => Yii::app()->user->checkAccess('action_gcca_admin')),
                        array('label' => 'Activos', 'url' => array('/fccu/admin'), 'visible' => Yii::app()->user->checkAccess('action_fccu_admin')),
                    )),
                array('label' => 'Reportes <span class="caret"></span>', 'url' => '#', 'visible' => $visible, 'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
                    'items' => array(
                        array('label' => 'Arbol de Asignaciones', 'url' => array('/fcco/admin'), 'visible' => Yii::app()->user->checkAccess('action_fcco_admin')),
                        array('label' => 'Reporte de Salidas', 'url' => $this->createUrl('fcco/report',array('FCCN_Id'=>1)), 'visible' => Yii::app()->user->checkAccess('action_fcco_report')),
                        array('label' => 'Reporte de Entradas', 'url' =>$this->createUrl('fcco/report',array('FCCN_Id'=>2)), 'visible' => Yii::app()->user->checkAccess('action_fcco_report')),
                      
                        array('label' => 'Recargas*', 'url' => array('fcuc/admin'), 'visible' => $admin),
                        array('label' => 'Rendimiento laboral*', 'url' => array('/#'), 'visible' => $admin),
                    //array('label' => 'Compras', 'url' => array('#'),'visible' =>  $admin ),
                    //array('label' => 'Resumen', 'url' => array('#'),'visible' => $admin ),
                    // array('label' => 'Bitacora', 'url' => array('#'),'visible' =>  $admin ),
                    )),
                array('label' => 'Configuracion <span class="caret"></span>', 'url' => '#', 'visible' => $visible, 'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
                    'items' => array(
                        array('label' => 'Usuarios del Sistema', 'url' => array('/cruge/ui/usermanagementadmin'), 'visible' => Yii::app()->user->checkAccess('action_ui_usermanagementadmin')),
                        array('label' => 'Tipo de Activos', 'url' => array('/fcca/admin'), 'visible' => Yii::app()->user->checkAccess('action_fcca_admin')),
                        array('label' => 'Modelos de Activos', 'url' => array('/fcct/admin'), 'visible' => Yii::app()->user->checkAccess('action_fcct_admin')),
                        array('label' => 'Categorias de Activos*', 'url' => array('/fcuu/admin'), 'visible' => $admin),
                        array('label' => 'Operaciones con Activos', 'url' => array('/fccn/admin'), 'visible' => Yii::app()->user->checkAccess('action_fccn_admin')),
                        array('label' => 'Estado de Activos', 'url' => array('/fcci/admin'), 'visible' => Yii::app()->user->checkAccess('action_fcci_admin')),
                        array('label' => 'Operador de Lineas', 'url' => array('/fccd/admin'), 'visible' => Yii::app()->user->checkAccess('action_fccd_admin')),
                        array('label' => 'Migrar de 2.0', 'url' => array('/site/migrate'), 'visible' => Yii::app()->user->checkAccess('action_site_migrate')),
                    )),
            ),
        ));
        ?>
    </div>
    <div class="user">
        <div class="dropdown">
<?php
$var = !Yii::app()->user->isGuest ? Yii::app()->user->um->getFieldValue(Yii::app()->user->id, 'nombre') : "";

$this->widget('zii.widgets.CMenu', array(
    'htmlOptions' => array('class' => 'main-nav'),
    'submenuHtmlOptions' => array('class' => 'dropdown-menu pull-right'),
    'encodeLabel' => false,
    'items' => array(
        array('label' => '<i class="icon-user"></i>  ' . $var . '  <span class="caret"></span><img src="' . $baseUrl . '/img/demo/user-avatar.png" alt="">',
            'url' => '#', 'visible' => $visible,
            'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"),
            'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
            'items' => array(
                array('label' => 'Bitacora', 'url' => array('/pcue'), 'visible' => Yii::app()->user->checkAccess('controller_pcue')),
                array('label' => 'Editar Perfil', 'url' => array('/cruge/ui/editprofile'), 'visible' => Yii::app()->user->checkAccess('action_ui_editprofile')),
                array('label' => 'Salir (' . Yii::app()->user->name . ')', 'url' => Yii::app()->user->ui->logoutUrl, 'visible' => !Yii::app()->user->isGuest),
            )),
        array('label' => 'Entrar', 'url' => Yii::app()->user->ui->loginUrl, 'visible' => Yii::app()->user->isGuest),
)));
?>
        </div>
    </div> 



</div>
<div class="progress progress-striped active" style="margin: 0; height: 5px;background: #eee;">
    <div id="progress" class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">

    </div>
</div>

