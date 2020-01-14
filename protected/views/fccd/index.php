<?php
/* @var $this FccdController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fccds',
);

$this->menu=array(
	array('label'=>'Create Fccd', 'url'=>array('create')),
	array('label'=>'Manage Fccd', 'url'=>array('admin')),
);
?>

<h1>Fccds</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
