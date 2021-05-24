<?php
/* @var $this TccaController */
/* @var $model Tcca */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'TCCA_Id'); ?>
		<?php echo $form->textField($model,'TCCA_Id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TCCA_Name'); ?>
		<?php echo $form->textField($model,'TCCA_Name',array('size'=>60,'maxlength'=>80)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TCCA_Type'); ?>
		<?php echo $form->textField($model,'TCCA_Type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TCCA_BoardId'); ?>
		<?php echo $form->textField($model,'TCCA_BoardId'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->