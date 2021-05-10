<?php
/* @var $this TccaController */
/* @var $model Tcca */

$this->breadcrumbs=array(
	'Tccas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Lista de Tableros', 'url'=>array('index')),
	array('label'=>'Administrar Tableros', 'url'=>array('admin')),
);
?>

<!----<h1>Create Tcca</h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>