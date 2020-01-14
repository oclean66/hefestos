<?php
/* @var $this FcctController */
/* @var $model Fcct */

$this->breadcrumbs=array(
	'Fccts'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Fcct', 'url'=>array('index')),
	array('label'=>'Administrar Modelos', 'url'=>array('admin')),
);
?>

<!--- <h1>Create Fcct</h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>