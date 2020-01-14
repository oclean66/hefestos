<?php
/* @var $this FcciController */
/* @var $data Fcci */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCI_Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->FCCI_Id), array('view', 'id'=>$data->FCCI_Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCI_Descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->FCCI_Descripcion); ?>
	<br />


</div>