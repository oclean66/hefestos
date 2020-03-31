<?php
/* @var $this TccaController */
/* @var $data Tcca */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TCCA_Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TCCA_Id), array('view', 'id'=>$data->TCCA_Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TCCA_Name')); ?>:</b>
	<?php echo CHtml::encode($data->TCCA_Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TCCA_Type')); ?>:</b>
	<?php echo CHtml::encode($data->TCCA_Type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TCCA_BoardId')); ?>:</b>
	<?php echo CHtml::encode($data->TCCA_BoardId); ?>
	<br />


</div>