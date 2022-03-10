<?php
/* @var $this TccdController */
/* @var $model Tccd */

$this->breadcrumbs=array(
	'Tccds'=>array('index'),
	'Create',
); 
$this->menu=array(
	//array('label'=>'Ver Activo ', 'url'=>Yii::app()->createUrl("fccu/view/",array("id"=>$activo->FCCU_Id))),
	array('label'=>'Activos', 'url'=>Yii::app()->createUrl("fccu/admin/")),
	array('label'=>'Lista de Tareas', 'url'=>array('index')),
	array('label'=>'Administrar Tareas', 'url'=>array('admin')),
	
);
?>

<!----<h1>Create Tccd</h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model,'activo'=>$activo)); ?>