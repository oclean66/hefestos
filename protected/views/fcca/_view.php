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


</div>