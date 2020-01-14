<?php
/* @var $this FccuController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fccus',
);

$this->menu=array(
	array('label'=>'Create Fccu', 'url'=>array('create')),
	array('label'=>'Manage Fccu', 'url'=>array('admin')),
);
?>

<h1>Fccus</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
