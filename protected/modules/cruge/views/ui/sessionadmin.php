<div class="form">
    <h1><?php echo ucwords(CrugeTranslator::t("sesiones de usuario")); ?></h1>
    <?php
    //$comboList = array();
//    foreach (Yii::app()->user->um->listUsers() as $user) {
//        // evitando al invitado
//        if ($user->primaryKey == CrugeUtil::config()->guestUserId)
//            break;
//        // en este caso 'firstname' y 'lastname' son campos personalizados
//        $firstName = Yii::app()->user->um->getFieldValue($user, 'iduser');
//        $lastName = Yii::app()->user->um->getFieldValue($user, 'username');
//        $comboList[$user->primaryKey] = $lastName . ", " . $firstName;
//    }
    //echo "Users: " . CHtml::dropDownList('userlist', '', $comboList) . "<hr/>";


    $this->widget(Yii::app()->user->ui->CGridViewClass, array(
        'dataProvider' => $dataProvider,
         'itemsCssClass' => 'table table-hover table-nomargin table-bordered',
    'pagerCssClass' => 'table-pagination',
    'pager' => array(
        'htmlOptions' => array('class' => 'pagination'),
        'selectedPageCssClass' => 'active',
    ),
        'columns' => array(
            array('name' => 'idsession', 'header' => 'Id', 'htmlOptions' => array('style' => 'width:25px;')),
            array('name' => 'iduser', 'header' => 'Usuario', 'value' => '$data->user->username', 'type' => 'text',
                'filter' => CHtml::listData(CrugeStoredUser::model()->findAll(' 1 order by username'), 'iduser', 'username'),
                'headerHtmlOptions' => array('style' => 'width:25px;'),
                'htmlOptions' => array('style' => 'width:75px;')),
            array('name' => 'status', 'header' => 'Estado', 'filter' => array(1 => 'Activa', 0 => 'Cerrada'),
                'value' => '$data->status==1 ? "activa":"cerrada"',
                'htmlOptions' => array('style' => 'width:25px;')),
            array('name' => 'created', 'header' => 'Creado', 'type' => 'datetime'),
            array('name' => 'lastusage', 'header' => 'Ultima vez', 'type' => 'datetime'),
            array('name' => 'expire', 'header' => 'Expira', 'type' => 'datetime'),
            'ipaddress',
            array(
                'class' => 'CButtonColumn',
                'template' => '{delete}',
                'headerHtmlOptions' => array('style' => 'width:16px;'),
                'deleteConfirmation' => CrugeTranslator::t("Esta seguro de eliminar esta sesion ?"),
                'buttons' => array(
                    'delete' => array(
                        'label' => CrugeTranslator::t("eliminar sesion"),
                        'imageUrl' => Yii::app()->user->ui->getResource("delete.png"),
                        'url' => 'array("sessionadmindelete","id"=>$data->getPrimaryKey())'
                    ),
                ),
            )
        ),
        'filter' => $model,
    ));
    ?>
</div>