<?php
/* @var $this FccaController */
/* @var $model Fcca */

$this->breadcrumbs=array(
	'Fccas'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Fcca', 'url'=>array('index')),
	array('label'=>'Administrar Tipo', 'url'=>array('admin')),
);
?>

<!--- <h1>Create Fcca</h1>-->
<?php
echo isset($_GET['alert']) ? "<div class='alert alert-danger'><b>ATENCION: </b> {$_GET['alert']}</div>" : "";
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>