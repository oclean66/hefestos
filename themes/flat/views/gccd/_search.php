<?php
/* @var $this GccdController */
/* @var $model Gccd */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'GCCD_Id'); ?>
		<?php echo $form->textField($model,'GCCD_Id',array('class'=>'','size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GCCD_Cod'); ?>
		<?php echo $form->textField($model,'GCCD_Cod',array('class'=>'','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GCCD_Nombre'); ?>
		<?php echo $form->textField($model,'GCCD_Nombre',array('class'=>'','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GCCD_IdSuperior'); ?>
		<?php echo $form->textField($model,'GCCD_IdSuperior',array('class'=>'','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GCCD_Estado'); ?>
		<?php echo $form->textField($model,'GCCD_Estado',array('class'=>'','size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GCCD_Responsable'); ?>
		<?php echo $form->textField($model,'GCCD_Responsable',array('class'=>'','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GCCD_Telefono'); ?>
		<?php echo $form->textField($model,'GCCD_Telefono',array('class'=>'','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->