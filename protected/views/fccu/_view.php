<?php
/* @var $this FccuController */
/* @var $data Fccu */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCU_Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->FCCU_Id), array('view', 'id'=>$data->FCCU_Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCU_Serial')); ?>:</b>
	<?php echo CHtml::encode($data->FCCU_Serial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCU_Timestamp')); ?>:</b>
	<?php echo CHtml::encode($data->FCCU_Timestamp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCU_Numero')); ?>:</b>
	<?php echo CHtml::encode($data->FCCU_Numero); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCU_ClaveDatos')); ?>:</b>
	<?php echo CHtml::encode($data->FCCU_ClaveDatos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCU_ClaveMovil')); ?>:</b>
	<?php echo CHtml::encode($data->FCCU_ClaveMovil); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCU_DiaCorte')); ?>:</b>
	<?php echo CHtml::encode($data->FCCU_DiaCorte); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCU_MontoMin')); ?>:</b>
	<?php echo CHtml::encode($data->FCCU_MontoMin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCU_TipoServicio')); ?>:</b>
	<?php echo CHtml::encode($data->FCCU_TipoServicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCU_Descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->FCCU_Descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCU_Cantidad')); ?>:</b>
	<?php echo CHtml::encode($data->FCCU_Cantidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCU_Facturado')); ?>:</b>
	<?php echo CHtml::encode($data->FCCU_Facturado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCD_Id')); ?>:</b>
	<?php echo CHtml::encode($data->FCCD_Id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCT_Id')); ?>:</b>
	<?php echo CHtml::encode($data->FCCT_Id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCI_Id')); ?>:</b>
	<?php echo CHtml::encode($data->FCCI_Id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCS_Id')); ?>:</b>
	<?php echo CHtml::encode($data->FCCS_Id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCUU_Id')); ?>:</b>
	<?php echo CHtml::encode($data->FCUU_Id); ?>
	<br />

	*/ ?>

</div>