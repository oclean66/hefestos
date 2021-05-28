<?php
/* @var $this FccnController */
/* @var $data Fccn */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCN_Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->FCCN_Id), array('view', 'id'=>$data->FCCN_Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCN_Operacion')); ?>:</b>
	<?php echo CHtml::encode($data->FCCN_Operacion); ?>
	<br />


</div>