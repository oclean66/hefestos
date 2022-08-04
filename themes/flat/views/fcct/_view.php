<?php
/* @var $this FcctController */
/* @var $data Fcct */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCT_Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->FCCT_Id), array('view', 'id'=>$data->FCCT_Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCT_Descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->FCCT_Descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCT_Costo')); ?>:</b>
	<?php echo CHtml::encode($data->FCCT_Costo); ?>
	<br />
	
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCT_Venta')); ?>:</b>
	<?php echo CHtml::encode($data->FCCT_Venta); ?>
	<br />
	
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCA_Id')); ?>:</b>
	<?php echo CHtml::encode($data->FCCA_Id); ?>
	<br />


</div>