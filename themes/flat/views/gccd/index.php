<?php
/* @var $this GccdController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Gccds',
);

$this->menu=array(
	array('label'=>'Create Gccd', 'url'=>array('create')),
	array('label'=>'Manage Gccd', 'url'=>array('admin')),
);
?>

<h1>Gccds</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
