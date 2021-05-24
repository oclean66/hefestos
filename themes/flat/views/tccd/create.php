<?php
/* @var $this TccdController */
/* @var $model Tccd */

$this->breadcrumbs=array(
	'Tccds'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Lista de Tareas', 'url'=>array('index')),
	array('label'=>'Administrar Tareas', 'url'=>array('admin')),
);
?>

<!----<h1>Create Tccd</h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>