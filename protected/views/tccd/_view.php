<?php
/* @var $this TccdController */
/* @var $data Tccd */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TCCD_Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TCCD_Id), array('view', 'id'=>$data->TCCD_Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TCCD_Title')); ?>:</b>
	<?php echo CHtml::encode($data->TCCD_Title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TCCD_Description')); ?>:</b>
	<?php echo CHtml::encode($data->TCCD_Description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TCCD_Created')); ?>:</b>
	<?php echo CHtml::encode($data->TCCD_Created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TCCD_Expired')); ?>:</b>
	<?php echo CHtml::encode($data->TCCD_Expired); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TCCD_Order')); ?>:</b>
	<?php echo CHtml::encode($data->TCCD_Order); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TCCA_Id')); ?>:</b>
	<?php echo CHtml::encode($data->TCCA_Id); ?>
	<br />


</div>