<?php
/* @var $this FccaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fccm',
);

$this->menu=array(
	array('label'=>'Create Fccm', 'url'=>array('create')),
	array('label'=>'Manage Fccm', 'url'=>array('admin')),
);
?>

<h1>Fccls</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
