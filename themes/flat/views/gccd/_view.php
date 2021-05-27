<?php
/* @var $this GccdController */
/* @var $data Gccd */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('GCCD_Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->GCCD_Id), array('view', 'id'=>$data->GCCD_Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GCCD_Cod')); ?>:</b>
	<?php echo CHtml::encode($data->GCCD_Cod); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GCCD_Nombre')); ?>:</b>
	<?php echo CHtml::encode($data->GCCD_Nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GCCD_IdSuperior')); ?>:</b>
	<?php echo CHtml::encode($data->GCCD_IdSuperior); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GCCD_Estado')); ?>:</b>
	<?php echo CHtml::encode($data->GCCD_Estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GCCD_Responsable')); ?>:</b>
	<?php echo CHtml::encode($data->GCCD_Responsable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GCCD_Telefono')); ?>:</b>
	<?php echo CHtml::encode($data->GCCD_Telefono); ?>
	<br />


</div>