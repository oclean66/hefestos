<?php
/* @var $this FccnController */
/* @var $model Fccn */

$this->breadcrumbs=array(
	'Fccns'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Fccn', 'url'=>array('index')),
	array('label'=>'Administrar Operacion', 'url'=>array('admin')),
);
?>

<!--- <h1>Create Fccn</h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>