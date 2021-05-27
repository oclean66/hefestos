<?php
/* @var $this FccnController */
/* @var $model Fccn */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'FCCN_Id'); ?>
		<?php echo $form->textField($model,'FCCN_Id',array('class'=>'','size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCCN_Operacion'); ?>
		<?php echo $form->textField($model,'FCCN_Operacion',array('class'=>'','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->