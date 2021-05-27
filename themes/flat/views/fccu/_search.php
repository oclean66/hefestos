<?php
/* @var $this FccuController */
/* @var $model Fccu */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'FCCU_Id'); ?>
		<?php echo $form->textField($model,'FCCU_Id',array('class'=>'','size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCCU_Serial'); ?>
		<?php echo $form->textField($model,'FCCU_Serial',array('class'=>'','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCCU_Timestamp'); ?>
		<?php echo $form->textField($model,'FCCU_Timestamp',array('class'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCCU_Numero'); ?>
		<?php echo $form->textField($model,'FCCU_Numero',array('class'=>'','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCCU_ClaveDatos'); ?>
		<?php echo $form->textField($model,'FCCU_ClaveDatos',array('class'=>'','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCCU_ClaveMovil'); ?>
		<?php echo $form->textField($model,'FCCU_ClaveMovil',array('class'=>'','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCCU_DiaCorte'); ?>
		<?php echo $form->textField($model,'FCCU_DiaCorte',array('class'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCCU_MontoMin'); ?>
		<?php echo $form->textField($model,'FCCU_MontoMin',array('class'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCCU_TipoServicio'); ?>
		<?php echo $form->textField($model,'FCCU_TipoServicio',array('class'=>'','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCCU_Descripcion'); ?>
		<?php echo $form->textField($model,'FCCU_Descripcion',array('class'=>'','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCCU_Cantidad'); ?>
		<?php echo $form->textField($model,'FCCU_Cantidad',array('class'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCCU_Facturado'); ?>
		<?php echo $form->textField($model,'FCCU_Facturado',array('class'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCCD_Id'); ?>
		<?php echo $form->textField($model,'FCCD_Id',array('class'=>'','size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCCT_Id'); ?>
		<?php echo $form->textField($model,'FCCT_Id',array('class'=>'','size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCCI_Id'); ?>
		<?php echo $form->textField($model,'FCCI_Id',array('class'=>'','size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCCS_Id'); ?>
		<?php echo $form->textField($model,'FCCS_Id',array('class'=>'','size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCUU_Id'); ?>
		<?php echo $form->textField($model,'FCUU_Id',array('class'=>'','size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->