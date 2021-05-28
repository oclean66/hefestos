<?php
/* @var $this FcucController */
/* @var $model Fcuc */

$this->breadcrumbs = array(
    'Fcucs' => array('index'),
    'Administrar',
);

$this->menu = array(
    array('label' => 'Listar Fcuc', 'url' => array('index')),
    array('label' => 'Crear Fcuc', 'url' => array('create')),
);
?>

<h1>Administrar Fcucs</h1>



<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'fcuc-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'itemsCssClass' => 'table table-striped table-bordered table-hover',
    'pagerCssClass' => 'table-pagination',
    'pager' => array(
        'htmlOptions' => array('class' => 'pagination'),
        'selectedPageCssClass' => 'active',
    ),
    'columns' => array(
        'FCUC_Id',
        'FCUC_Timestamp',
        'FCUC_Monto',
        'FCCU_Id',
        array(
            'class' => 'CButtonColumn', 'headerHtmlOptions' => array('style' => 'width:83px'),
        ),
    ),
));
?>
