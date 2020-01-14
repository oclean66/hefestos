<?php
/* @var $this GccdController */
/* @var $model Gccd */

$this->breadcrumbs=array(
	'Gccds'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Gccd', 'url'=>array('index')),
	array('label'=>'Administrar Grupos', 'url'=>array('admin')),
);
?>

<!--- <h1>Create Gccd</h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model,'id'=>$id)); ?>