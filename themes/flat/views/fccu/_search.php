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
		<?php echo $form->textField($model,'FCCU_Serial', array('class' => 'form-control', 'placeholder' => 'Serial', 'size' => 45, 'maxlength' => 45)); ?>
		<div class="input-group-btn" bis_skin_checked="1">
			<?php echo CHtml::submitButton('Buscar', array("class"=>"btn btn-primary")); ?>
		</div>
	</div>
	<div id="busq-avanz" style="display: none;">

 
		<?php
			echo $form->dropDownList($model, 'FCCA_Descripcion', CHtml::listData(Fcca::model()->findAll(), 'FCCA_Descripcion', 'FCCA_Descripcion'), array( 
				'class' => 'select2-me', 'style' => 'width:100%', 'id' => 'tipo',
				'prompt' => 'Todos',
 
			));

        	echo $form->dropDownList($model, 'FCCI_Id', CHtml::listData(Fcci::model()->findAll(), 'FCCI_Id', 'concatened'), array('prompt' => 'Todos'));
        ?>
		
	</div>




	<?php $this->endWidget(); ?>

</div><!-- search-form -->