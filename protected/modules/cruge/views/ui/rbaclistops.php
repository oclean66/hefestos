<h1><?php echo ucwords(CrugeTranslator::t("operaciones")); ?></h1>


<?php
echo CHtml::link(CrugeTranslator::t("Crear Nueva Operacion"), Yii::app()->user->ui->getRbacAuthItemCreateUrl(CAuthItem::TYPE_OPERATION), array('class' => 'btn btn-success')
);
?>


<?php
echo '<div class="row">' . CrugeTranslator::t("Filtrar por Controlador:") . '</div>';
$ar = array(
    '0' => CrugeTranslator::t('Ver Todo'),
    '1' => CrugeTranslator::t('Otras'),
    '2' => CrugeTranslator::t('Cruge'),
        //'3'=>CrugeTranslator::t('Controladoras'),
);
foreach (Yii::app()->user->rbac->enumControllers() as $c)
    $ar[$c] = $c;
// build list

//echo '</br>';
foreach ($ar as $filter => $text)
    echo '<div class="badge badge-info"  style=" display: inline-table; margin:4px;">' . CHtml::link(CrugeTranslator::t('classes',$text), array('/cruge/ui/rbaclistops',
        'filter' => $filter), array('style' => 'color:whitesmoke;')) . '</div>';
?>

<?php
$this->renderPartial('_listauthitems'
        , array('dataProvider' => $dataProvider)
        , false
);
?>
