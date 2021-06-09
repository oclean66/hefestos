<?php
/* @var $this FcctController */
/* @var $model Fcct */
/* @var $form CActiveForm */
?>

<div class="box box-bordered box-color">
    <div class="box-title">
        <h3>
            <i class="fa fa-th-list"></i><?php echo $model->isNewRecord ? 'Crear ' : 'Actualizar '; ?>Modelo</h3>
    </div>
    <div class="box-content nopadding">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'fcct-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array('class' => 'form-horizontal form-bordered'),
        ));
        ?>



        <?php echo $form->errorSummary($model, 'Corriga lo siguiente', '', array('class' => 'alert alert-danger alert-dismissable')); ?>

        

        <div class="form-group">
            <?php echo $form->labelEx($model, 'FCCA_Id', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->dropDownList($model, 'FCCA_Id', CHtml::listData(Fcca::model()->findAll('1 order by FCCA_Descripcion'), 'FCCA_Id', 'FCCA_Descripcion'), array('empty' => 'Selecciona', 'class' => 'select2-me','style'=>'width:100%')); ?>
                <?php echo $form->error($model, 'FCCA_Id', array('class' => 'label label-danger')); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'FCCT_Descripcion', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'FCCT_Descripcion', array('class' => 'form-control', 'size' => 150, 'maxlength' => 150)); ?>
                <?php echo $form->error($model, 'FCCT_Descripcion', array('class' => 'label label-danger')); ?>
            </div>
        </div>
        

        <div class="form-actions col-sm-offset-2 col-sm-10">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class' => 'btn btn-primary')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->