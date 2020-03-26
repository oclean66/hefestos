<?php
/* @var $this FccoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fccos',
);

$this->menu=array(
	array('label'=>'Create Fcco', 'url'=>array('create')),
	array('label'=>'Manage Fcco', 'url'=>array('admin')),
);
?>

<h1>Fccos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
