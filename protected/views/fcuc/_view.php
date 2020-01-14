<?php
/* @var $this FcucController */
/* @var $data Fcuc */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCUC_Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->FCUC_Id), array('view', 'id'=>$data->FCUC_Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCUC_Timestamp')); ?>:</b>
	<?php echo CHtml::encode($data->FCUC_Timestamp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCUC_Monto')); ?>:</b>
	<?php echo CHtml::encode($data->FCUC_Monto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCU_Id')); ?>:</b>
	<?php echo CHtml::encode($data->FCCU_Id); ?>
	<br />


</div>