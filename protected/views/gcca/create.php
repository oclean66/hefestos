<?php
/* @var $this GccaController */
/* @var $model Gcca */

$this->breadcrumbs=array(
	'Gccas'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Gcca', 'url'=>array('index')),
	array('label'=>'Administrar Agencia', 'url'=>array('admin')),
);
?>

<!--- <h1>Create Gcca</h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model,'id'=>$id)); ?>