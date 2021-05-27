<?php
/* @var $this FcctController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fccts',
);

$this->menu=array(
	array('label'=>'Create Fcct', 'url'=>array('create')),
	array('label'=>'Manage Fcct', 'url'=>array('admin')),
);
?>

<h1>Fccts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
