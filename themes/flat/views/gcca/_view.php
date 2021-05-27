<?php
/* @var $this GccaController */
/* @var $data Gcca */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('GCCA_Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->GCCA_Id), array('view', 'id'=>$data->GCCA_Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GCCD_Id')); ?>:</b>
	<?php echo CHtml::encode($data->GCCD_Id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GCCA_Cod')); ?>:</b>
	<?php echo CHtml::encode($data->GCCA_Cod); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GCCA_Nombre')); ?>:</b>
	<?php echo CHtml::encode($data->GCCA_Nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GCCA_Direccion')); ?>:</b>
	<?php echo CHtml::encode($data->GCCA_Direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GCCA_Status')); ?>:</b>
	<?php echo CHtml::encode($data->GCCA_Status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GCCA_Rif')); ?>:</b>
	<?php echo CHtml::encode($data->GCCA_Rif); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('GCCA_Responsable')); ?>:</b>
	<?php echo CHtml::encode($data->GCCA_Responsable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GCCA_Telefono')); ?>:</b>
	<?php echo CHtml::encode($data->GCCA_Telefono); ?>
	<br />

	*/ ?>

</div>