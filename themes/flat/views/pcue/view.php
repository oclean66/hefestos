<?php
/* @var $this PcueController */
/* @var $model Pcue */

$this->breadcrumbs=array(
	'Pcues'=>array('index'),
	$model->PCUE_Id,
);

$this->menu=array(array('label'=>'Ver Bitacora Completa', 'url'=>array('index')),
);
?>

<h1>Detalles de Bitacora</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
    
	'attributes'=>array(
		'PCUE_Id',
		'PCUE_Descripcion',
		'PCUE_Action',
		'PCUE_Model',
		'PCUE_IdModel',
		'PCUE_Field',
		'PCUE_Date',
		'PCUE_UserId',
		array('name'=>'PCUE_Detalles','type'=>'raw')
	),
)); ?>
