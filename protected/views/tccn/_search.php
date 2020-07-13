<?php
/* @var $this TccnController */
/* @var $model Tccn */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'TCCN_Id'); ?>
		<?php echo $form->textField($model,'TCCN_Id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TCCN_Title'); ?>
		<?php echo $form->textField($model,'TCCN_Title',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TCCN_Thread'); ?>
		<?php echo $form->textField($model,'TCCN_Thread'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TCCN_Url'); ?>
		<?php echo $form->textField($model,'TCCN_Url',array('size'=>60,'maxlength'=>160)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TCCN_Created'); ?>
		<?php echo $form->textField($model,'TCCN_Created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TCCN_Read'); ?>
		<?php echo $form->textField($model,'TCCN_Read'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TCCN_IdUSer'); ?>
		<?php echo $form->textField($model,'TCCN_IdUSer'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->