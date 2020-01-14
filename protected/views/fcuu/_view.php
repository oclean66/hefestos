<?php
/* @var $this FcuuController */
/* @var $data Fcuu */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCUU_Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->FCUU_Id), array('view', 'id'=>$data->FCUU_Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCUU_Descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->FCUU_Descripcion); ?>
	<br />


</div>