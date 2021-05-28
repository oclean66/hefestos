<?php
/* @var $this TccnController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tccns',
);

$this->menu=array(
	array('label'=>'Create Tccn', 'url'=>array('create')),
	array('label'=>'Manage Tccn', 'url'=>array('admin')),
);
?>

<h1>Tccns</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
