<?php
/* @var $this GccaController */
/* @var $model Gcca */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'GCCA_Id'); ?>
		<?php echo $form->textField($model,'GCCA_Id',array('class'=>'','size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GCCD_Id'); ?>
		<?php echo $form->textField($model,'GCCD_Id',array('class'=>'','size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GCCA_Cod'); ?>
		<?php echo $form->textField($model,'GCCA_Cod',array('class'=>'','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GCCA_Nombre'); ?>
		<?php echo $form->textField($model,'GCCA_Nombre',array('class'=>'','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GCCA_Direccion'); ?>
		<?php echo $form->textField($model,'GCCA_Direccion',array('class'=>'','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GCCA_Status'); ?>
		<?php echo $form->textField($model,'GCCA_Status',array('class'=>'','size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GCCA_Rif'); ?>
		<?php echo $form->textField($model,'GCCA_Rif',array('class'=>'','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GCCA_Responsable'); ?>
		<?php echo $form->textField($model,'GCCA_Responsable',array('class'=>'','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GCCA_Telefono'); ?>
		<?php echo $form->textField($model,'GCCA_Telefono',array('class'=>'','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->