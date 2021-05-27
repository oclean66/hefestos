<?php
/* @var $this TccnController */
/* @var $data Tccn */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TCCN_Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TCCN_Id), array('view', 'id'=>$data->TCCN_Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TCCN_Title')); ?>:</b>
	<?php echo CHtml::encode($data->TCCN_Title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TCCN_Thread')); ?>:</b>
	<?php echo CHtml::encode($data->TCCN_Thread); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TCCN_Url')); ?>:</b>
	<?php echo CHtml::encode($data->TCCN_Url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TCCN_Created')); ?>:</b>
	<?php echo CHtml::encode($data->TCCN_Created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TCCN_Read')); ?>:</b>
	<?php echo CHtml::encode($data->TCCN_Read); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TCCN_IdUSer')); ?>:</b>
	<?php echo CHtml::encode($data->TCCN_IdUSer); ?>
	<br />


</div>