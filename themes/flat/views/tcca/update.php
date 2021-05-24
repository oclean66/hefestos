<?php
/* @var $this TccaController */
/* @var $model Tcca */

$this->breadcrumbs=array(
	'Tccas'=>array('index'),
	$model->TCCA_Id=>array('view','id'=>$model->TCCA_Id),
	'Update',
);

$this->menu=array(
	array('label'=>'Lista de Tableros', 'url'=>array('index')),
	array('label'=>'Crear Tablero', 'url'=>array('create')),
	array('label'=>'Ver Tablero', 'url'=>array('view', 'id'=>$model->TCCA_Id)),
	array('label'=>'Administrar Tableros', 'url'=>array('admin')),
);
?>

<h1>Actualizar Tablero <?php echo $model->TCCA_Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>