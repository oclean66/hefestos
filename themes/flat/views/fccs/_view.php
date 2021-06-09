<?php
/* @var $this FccsController */
/* @var $data Fccs */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCS_Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->FCCS_Id), array('view', 'id'=>$data->FCCS_Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCS_Fecha')); ?>:</b>
	<?php echo CHtml::encode($data->FCCS_Fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCS_Control')); ?>:</b>
	<?php echo CHtml::encode($data->FCCS_Control); ?>
	<br />


</div>