<?php
/* @var $this FccnController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fccns',
);

$this->menu=array(
	array('label'=>'Create Fccn', 'url'=>array('create')),
	array('label'=>'Manage Fccn', 'url'=>array('admin')),
);
?>

<h1>Fccns</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
