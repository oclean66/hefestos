<?php
/* @var $this FcciController */
/* @var $model Fcci */

$this->breadcrumbs=array(
	'Fccis'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Fcci', 'url'=>array('index')),
	array('label'=>'Administrar Fcci', 'url'=>array('admin')),
);
?>

<!--- <h1>Create Fcci</h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>