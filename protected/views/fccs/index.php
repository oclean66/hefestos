<?php
/* @var $this FccsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fccs',
);

$this->menu=array(
	array('label'=>'Create Fccs', 'url'=>array('create')),
	array('label'=>'Manage Fccs', 'url'=>array('admin')),
);
?>

<h1>Fccs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
