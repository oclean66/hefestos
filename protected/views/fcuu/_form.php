<?php
/* @var $this FcuuController */
/* @var $model Fcuu */
/* @var $form CActiveForm */
?>

<div class="box box-bordered box-color">
    <div class="box-title">
        <h3>
            <i class="fa fa-th-list"></i><?php echo $model->isNewRecord ? 'Crear ' : 'Actualizar '; ?>Categoria</h3>
    </div>
    <div class="box-content nopadding">

        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'fcuu-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('class' => 'form-horizontal form-bordered'),
)); ?>



        <?php echo $form->errorSummary($model,'Corriga lo siguiente','', array('class' => 'alert alert-danger alert-dismissable')); ?>

                    <div class="form-group">
                <?php echo $form->labelEx($model,'FCUU_Descripcion',array('class'=>'control-label col-sm-2')); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'FCUU_Descripcion',array('class'=>'form-control','size'=>45,'maxlength'=>45)); ?>
                    <?php echo $form->error($model,'FCUU_Descripcion',array('class' => 'label label-danger')); ?>
                </div>
            </div>

                    <div class="form-actions col-sm-offset-2 col-sm-10">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class' => 'btn btn-primary')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->