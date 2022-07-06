<?php
/* @var $this FccaController */
/* @var $model Fcca */

$this->breadcrumbs=array(
	'Fccl'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Fccl', 'url'=>array('index')),
	array('label'=>'Administrar Etiquetas', 'url'=>array('admin')),
);
?>

<!--- <h1>Create Fcca</h1>-->
<?php
echo isset($_GET['alert']) ? "<div class='alert alert-danger'><b>ATENCION: </b> {$_GET['alert']}</div>" : "";
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>