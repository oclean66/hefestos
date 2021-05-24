<?php
/* @var $this FcciController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fccis',
);

$this->menu=array(
	array('label'=>'Create Fcci', 'url'=>array('create')),
	array('label'=>'Manage Fcci', 'url'=>array('admin')),
);
?>

<h1>Fccis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
