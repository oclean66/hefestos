<?php
/* @var $this TccaController */
/* @var $model Tcca */
/* @var $form CActiveForm */
?>
<div class="box box-bordered box-color">
    <div class="box-title">
        <h3>
            <i class="fa fa-th-list"></i>Crear Tablero</h3>
    </div>
    <div class="box-content nopadding">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'tcca-form',
            'enableAjaxValidation'=>false,
            'htmlOptions' => array('class' => 'form-horizontal form-bordered'),
            )); ?>

        <?php echo $form->errorSummary($model); ?>

                    <div class="form-group">
                <?php echo $form->labelEx($model,'TCCA_Name', array('class' => 'control-label col-sm-2')); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'TCCA_Name',array('size'=>60,'maxlength'=>80)); ?>
                    <?php echo $form->error($model,'TCCA_Name'); ?>
                </div>
            </div>

                        <div class="form-group">
                <?php echo $form->labelEx($model,'TCCA_Type', array('class' => 'control-label col-sm-2')); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'TCCA_Type'); ?>
                    <?php echo $form->error($model,'TCCA_Type'); ?>
                </div>
            </div>

                        <div class="form-group">
                <?php echo $form->labelEx($model,'TCCA_BoardId', array('class' => 'control-label col-sm-2')); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'TCCA_BoardId'); ?>
                    <?php echo $form->error($model,'TCCA_BoardId'); ?>
                </div>
            </div>

            
        <div class="form-actions col-sm-offset-2 col-sm-10">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class'=>'btn btn-primary')); ?>
            <!-- <a href="admin" class="btn">Cancel</a> -->
        <!--</div>-->
        <?php $this->endWidget(); ?>
    </div>
</div>



