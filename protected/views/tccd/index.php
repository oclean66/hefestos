<?php
/* @var $this TccdController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tccds',
);

$this->menu=array(
	array('label'=>'Create Tccd', 'url'=>array('create')),
	array('label'=>'Manage Tccd', 'url'=>array('admin')),
);
?>

<h1>Tccds</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
