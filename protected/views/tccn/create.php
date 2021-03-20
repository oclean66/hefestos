<?php
/* @var $this TccnController */
/* @var $model Tccn */

$this->breadcrumbs=array(
	'Tccns'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tccn', 'url'=>array('index')),
	array('label'=>'Manage Tccn', 'url'=>array('admin')),
);
?>

<!----<h1>Create Tccn</h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>