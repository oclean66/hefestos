<?php
/* @var $this FccuController */
/* @var $model Fccu */
/* @var $form CActiveForm */
?>

<div class="wide form">

	<?php $form = $this->beginWidget('CActiveForm', array(
		'action' => Yii::app()->createUrl($this->route),
		'method' => 'get',
	)); ?>



	<div class="input-group input-group" bis_skin_checked="1">
		<span class="input-group-addon">
			<i class="fa fa-search"></i>
		</span>
		<?php echo $form->textField($model, 'FCCU_Serial', array('class' => 'form-control', 'placeholder' => 'Serial', 'size' => 45, 'maxlength' => 45)); ?>
		<div class="input-group-btn" bis_skin_checked="1">
			<?php echo CHtml::submitButton('Search', array("class"=>"btn btn-primary")); ?>
		</div>
	</div>




	<?php $this->endWidget(); ?>

</div><!-- search-form -->