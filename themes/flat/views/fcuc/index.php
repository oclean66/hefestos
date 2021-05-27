<?php
/* @var $this FcucController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fcucs',
);

$this->menu=array(
	array('label'=>'Create Fcuc', 'url'=>array('create')),
	array('label'=>'Manage Fcuc', 'url'=>array('admin')),
);
?>

<h1>Fcucs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
