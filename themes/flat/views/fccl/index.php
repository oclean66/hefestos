<?php
/* @var $this FccaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fccas',
);

$this->menu=array(
	array('label'=>'Create Fccl', 'url'=>array('create')),
	array('label'=>'Manage Fccl', 'url'=>array('admin')),
);
?>

<h1>Fccls</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
