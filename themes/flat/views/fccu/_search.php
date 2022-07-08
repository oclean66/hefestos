<?php
/* @var $this FccuController */
/* @var $model Fccu */
/* @var $form CActiveForm */
?>

<div class="wide form">

	<?php $form = $this->beginWidget('CActiveForm', array(
		'action' => Yii::app()->createUrl($this->route),
		'method' => 'get',
		'htmlOptions'=>array(
			'class'=>'form-horizontal form-column form-bordered'
		)
	)); ?>
 

 
	
 

 <div class="box box-color box-bordered" style="margin-bottom:10px ;">
							<div class="box-title">
								<h3>
									<i class="fa fa-search"></i>
									Filtrar
								</h3>
								<div class="actions">
								
									<a href="#" class="btn btn-mini content-slideUp not-link">
										<i class="fa fa-angle-down"></i>
									</a>
								</div>
							</div>
							<div class="box-content" <?php if(!empty($model->FCCA_Descripcion)|| !empty($model->FCCI_Id)){ ?> style="display: none;" <?php } ?> >
							<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
				<?php echo $form->labelEx($model, 'FCCU_Serial', array('class' => 'control-label col-sm-2')); ?>
					<div class="col-sm-10">
					<?php echo $form->textField($model, 'FCCU_Serial', array('class' => 'form-control', 'placeholder' => 'Serial', 'size' => 45, 'maxlength' => 45)); ?>
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="control-label col-sm-2">Tipo</label>
					<div class="col-sm-10">
					<?php
							echo $form->dropDownList($model, 'FCCA_Descripcion', CHtml::listData(Fcca::model()->findAll(), 'FCCA_Descripcion', 'FCCA_Descripcion'), array( 
								'class' => 'select2-me', 'style' => 'width:100%', 'id' => 'tipo',
								'prompt' => 'Todos',
				
							));
						?>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
				<?php echo $form->labelEx($model, 'FCCU_Timestamp', array('class' => 'control-label col-sm-2')); ?>
					<div class="col-sm-10">
					<?php echo $form->textField($model, 'FCCU_Timestamp', array('class' => 'form-control')); ?>
					</div>
				</div>
					
				<div class="form-group">
					<label class="control-label col-sm-2">Estatus
					</label>
					<div class="col-sm-10">
						<?= $form->dropDownList($model, 'FCCI_Id', CHtml::listData(Fcci::model()->findAll(), 'FCCI_Id', 'concatened'), array('prompt' => 'Todos')); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="form-actions">
				<?php echo CHtml::submitButton('Buscar', array("class" => "btn btn-primary")); ?>
				</div>
			</div>
		</div>
							</div>
						</div>
 



		
	<?php $this->endWidget(); ?>

</div><!-- search-form -->

