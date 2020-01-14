<?php
/* @var $this FcciController */
/* @var $model Fcci */

$this->breadcrumbs = array(
    'Fccis' => array('index'),
    'Administrar',
);

$this->menu = array(
    array('label' => 'Listar Fcci', 'url' => array('index')),
    array('label' => 'Crear Fcci', 'url' => array('create')),
);
?>

<h1>Administrar Estado</h1>



<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'fcci-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'itemsCssClass' => 'table table-striped table-bordered table-hover',
    'pagerCssClass' => 'table-pagination',
    'pager' => array(
        'htmlOptions' => array('class' => 'pagination'),
        'selectedPageCssClass' => 'active',
    ),
    'columns' => array(
        'FCCI_Id',
        'FCCI_Descripcion',
        array(
            'class' => 'CButtonColumn', 'headerHtmlOptions' => array('style' => 'width:83px'),
        ),
    ),
));
?>
