<?php
/* @var $this FcuuController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fcuus',
);

$this->menu=array(
	array('label'=>'Create Fcuu', 'url'=>array('create')),
	array('label'=>'Manage Fcuu', 'url'=>array('admin')),
);
?>

<h1>Fcuus</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
