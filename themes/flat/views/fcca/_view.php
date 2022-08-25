<?php
/* @var $this FccaController */
/* @var $data Fcca */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCA_Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->FCCA_Id), array('view', 'id'=>$data->FCCA_Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCA_Descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->FCCA_Descripcion); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCA_StockMin')); ?>:</b>
	<?php echo CHtml::encode($data->FCCA_StockMin); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCA_StockMax')); ?>:</b>
	<?php echo CHtml::encode($data->FCCA_StockMax); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCA_Stock')); ?>:</b>
	<?php echo CHtml::encode($data->FCCA_Stock); ?>
	<br />


</div>