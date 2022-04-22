<?php
/* @var $this FccaController */
/* @var $model Fcca */
/* @var $form CActiveForm */
?>

<div class="box box-bordered box-color">
    
    <div class="box-title">
        <h3>
            <i class="fa fa-th-list"></i><?php echo $model->isNewRecord ? 'Crear ' : 'Actualizar '; ?>Tipo
        </h3>
    </div>
    <div class="box-content nopadding">

        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'fcca-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array('class' => 'form-horizontal form-bordered'),
        )); ?>



        <?php echo $form->errorSummary($model, 'Corriga lo siguiente', '', array('class' => 'alert alert-danger alert-dismissable')); ?>



        <div class="form-group">
            <?php echo $form->labelEx($model, 'FCUU_Id', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->dropDownList($model, 'FCUU_Id', CHtml::listData(Fcuu::model()->findAll('1 order by FCUU_Descripcion'), 'FCUU_Id', 'FCUU_Descripcion'), array('empty' => 'Selecciona', 'class' => 'select2-me', 'style' => 'width:100%')); ?>
                <?php echo $form->error($model, 'FCUU_Id', array('class' => 'label label-danger')); ?>
            </div>
        </div>


        <div class="form-group">
            <?php echo $form->labelEx($model, 'FCCA_Descripcion', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'FCCA_Descripcion', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'FCCA_Descripcion', array('class' => 'label label-danger')); ?>
            </div>
        </div>


        <div class="form-actions col-sm-offset-2 col-sm-10">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class' => 'btn btn-primary')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->