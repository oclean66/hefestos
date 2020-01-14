<?php
/* @var $this FccuController */
/* @var $model Fccu */

$this->breadcrumbs=array(
	'Fccus'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Fccu', 'url'=>array('index')),
	array('label'=>'Administrar Fccu', 'url'=>array('admin')),
);
?>

<!--- <h1>Create Fccu</h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>