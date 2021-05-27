<?php
/* @var $this FcciController */
/* @var $model Fcci */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'FCCI_Id'); ?>
		<?php echo $form->textField($model,'FCCI_Id',array('class'=>'','size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FCCI_Descripcion'); ?>
		<?php echo $form->textField($model,'FCCI_Descripcion',array('class'=>'','size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->