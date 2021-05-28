<?php
/* @var $this FccoController */
/* @var $model Fcco */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'FCCO_Id'); ?>
		<?php echo $form->textField($model,'FCCO_Id',array('class'=>'','size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCCO_Timestamp'); ?>
		<?php echo $form->textField($model,'FCCO_Timestamp',array('class'=>'','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCCO_Lote'); ?>
		<?php echo $form->textField($model,'FCCO_Lote',array('class'=>'','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCCO_Descripcion'); ?>
		<?php echo $form->textField($model,'FCCO_Descripcion',array('class'=>'','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCCO_Enabled'); ?>
		<?php echo $form->textField($model,'FCCO_Enabled',array('class'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCCN_Id'); ?>
		<?php echo $form->textField($model,'FCCN_Id',array('class'=>'','size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCCU_Id'); ?>
		<?php echo $form->textField($model,'FCCU_Id',array('class'=>'','size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GCCA_Id'); ?>
		<?php echo $form->textField($model,'GCCA_Id',array('class'=>'','size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GCCD_Id'); ?>
		<?php echo $form->textField($model,'GCCD_Id',array('class'=>'','size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->