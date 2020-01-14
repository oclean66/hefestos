<?php
/* @var $this FccaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fccas',
);

$this->menu=array(
	array('label'=>'Create Fcca', 'url'=>array('create')),
	array('label'=>'Manage Fcca', 'url'=>array('admin')),
);
?>

<h1>Fccas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
