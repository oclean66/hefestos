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
			<?php echo CHtml::submitButton('Buscar', array("class" => "btn btn-primary")); ?>
		</div>
	</div>
	<div id="busq-avanz" style="display: none;">
		<div class="input-group input-group" bis_skin_checked="1">
			<span class="input-group-addon">
				<i class="fa fa-tag"></i>
			</span>
			<?php
			// echo $form->textField($model, 'FCCT_Id', array('class' => 'form-control', 'placeholder' => 'Marca/Modelo', 'size' => 45, 'maxlength' => 45)); 
			$modelos = Fcct::model()->findAll();
			$var = array();
			foreach ($modelos as $key => $value) {
				$var[$value->FCCT_Id] = $value->fCCA->FCCA_Descripcion . " - " . $value->FCCT_Descripcion;
			}
			?>
			<?php echo $form->dropDownList($model, 'FCCT_Id', $var, array('empty' => 'Seleccione', 'class' => '')); ?>
			<!-- <div class="input-group-btn" bis_skin_checked="1">
				<?php echo CHtml::submitButton('Buscar', array("class" => "btn btn-primary")); ?>
			</div> -->
		</div>

		
	</div>




	<?php $this->endWidget(); ?>

</div><!-- search-form -->