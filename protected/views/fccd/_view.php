<?php
/* @var $this FccdController */
/* @var $data Fccd */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCD_Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->FCCD_Id), array('view', 'id'=>$data->FCCD_Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCD_Descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->FCCD_Descripcion); ?>
	<br />


</div>