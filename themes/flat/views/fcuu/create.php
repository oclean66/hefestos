<?php
/* @var $this FcuuController */
/* @var $model Fcuu */

$this->breadcrumbs=array(
	'Fcuus'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Fcuu', 'url'=>array('index')),
	array('label'=>'Administrar Categoria', 'url'=>array('admin')),
);
?>

<!--- <h1>Create Fcuu</h1>-->
<?php
echo isset($_GET['alert']) ? "<div class='alert alert-danger'><b>ATENCION: </b> {$_GET['alert']}</div>" : "";
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>