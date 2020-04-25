<?php
/* @var $this TccdController */
/* @var $model Tccd */

$this->breadcrumbs=array(
	'Tccds'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tccd', 'url'=>array('index')),
	array('label'=>'Manage Tccd', 'url'=>array('admin')),
);
?>

<!----<h1>Create Tccd</h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>