<?php
/* @var $this FccoController */
/* @var $data Fcco */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCO_Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->FCCO_Id), array('view', 'id'=>$data->FCCO_Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCO_Timestamp')); ?>:</b>
	<?php echo CHtml::encode($data->FCCO_Timestamp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCO_Lote')); ?>:</b>
	<?php echo CHtml::encode($data->FCCO_Lote); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCO_Descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->FCCO_Descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCO_Enabled')); ?>:</b>
	<?php echo CHtml::encode($data->FCCO_Enabled); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCN_Id')); ?>:</b>
	<?php echo CHtml::encode($data->FCCN_Id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCU_Id')); ?>:</b>
	<?php echo CHtml::encode($data->FCCU_Id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('GCCA_Id')); ?>:</b>
	<?php echo CHtml::encode($data->GCCA_Id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GCCD_Id')); ?>:</b>
	<?php echo CHtml::encode($data->GCCD_Id); ?>
	<br />

	*/ ?>

</div>