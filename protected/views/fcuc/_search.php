<?php
/* @var $this FcucController */
/* @var $model Fcuc */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'FCUC_Id'); ?>
		<?php echo $form->textField($model,'FCUC_Id',array('class'=>'','size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCUC_Timestamp'); ?>
		<?php echo $form->textField($model,'FCUC_Timestamp',array('class'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCUC_Monto'); ?>
		<?php echo $form->textField($model,'FCUC_Monto',array('class'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCCU_Id'); ?>
		<?php echo $form->textField($model,'FCCU_Id',array('class'=>'','size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->