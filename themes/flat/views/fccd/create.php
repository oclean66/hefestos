<?php
/* @var $this FccdController */
/* @var $model Fccd */

$this->breadcrumbs=array(
	'Fccds'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Fccd', 'url'=>array('index')),
	array('label'=>'Administrar Fccd', 'url'=>array('admin')),
);
?>

<!--- <h1>Create Fccd</h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>