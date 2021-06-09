<?php
/* @var $this FccsController */
/* @var $model Fccs */

$this->breadcrumbs=array(
	'Fccs'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Fccs', 'url'=>array('index')),
	array('label'=>'Administrar Fccs', 'url'=>array('admin')),
);
?>

<!--- <h1>Create Fccs</h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>