<?php
/* @var $this GccaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Gccas',
);

$this->menu=array(
	array('label'=>'Create Gcca', 'url'=>array('create')),
	array('label'=>'Manage Gcca', 'url'=>array('admin')),
);
?>

<h1>Gccas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
