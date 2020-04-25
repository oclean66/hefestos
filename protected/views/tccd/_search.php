<?php
/* @var $this TccdController */
/* @var $model Tccd */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'TCCD_Id'); ?>
		<?php echo $form->textField($model,'TCCD_Id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TCCD_Title'); ?>
		<?php echo $form->textField($model,'TCCD_Title',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TCCD_Description'); ?>
		<?php echo $form->textField($model,'TCCD_Description',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TCCD_Created'); ?>
		<?php echo $form->textField($model,'TCCD_Created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TCCD_Expired'); ?>
		<?php echo $form->textField($model,'TCCD_Expired'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TCCD_Order'); ?>
		<?php echo $form->textField($model,'TCCD_Order'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TCCA_Id'); ?>
		<?php echo $form->textField($model,'TCCA_Id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->