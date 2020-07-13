<?php
/* @var $this TccnController */
/* @var $model Tccn */
/* @var $form CActiveForm */
?>
<div class="box box-bordered box-color">
    <div class="box-title">
        <h3>
            <i class="fa fa-th-list"></i>Crear Tccn</h3>
    </div>
    <div class="box-content nopadding">
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tccn-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('class' => 'form-horizontal form-bordered'),
            )); ?>

        <?php echo $form->errorSummary($model); ?>

                    <div class="form-group">
                <?php echo $form->labelEx($model,'TCCN_Title', array('class'=>'col-sm-2 control-label')); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'TCCN_Title',array('size'=>45,'maxlength'=>45)); ?>
                    <?php echo $form->error($model,'TCCN_Title'); ?>
                </div>
            </div>

                        <div class="form-group">
                <?php echo $form->labelEx($model,'TCCN_Thread', array('class'=>'col-sm-2 control-label')); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'TCCN_Thread'); ?>
                    <?php echo $form->error($model,'TCCN_Thread'); ?>
                </div>
            </div>

                        <div class="form-group">
                <?php echo $form->labelEx($model,'TCCN_Url', array('class'=>'col-sm-2 control-label')); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'TCCN_Url',array('size'=>60,'maxlength'=>160)); ?>
                    <?php echo $form->error($model,'TCCN_Url'); ?>
                </div>
            </div>

                        <div class="form-group">
                <?php echo $form->labelEx($model,'TCCN_Created', array('class'=>'col-sm-2 control-label')); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'TCCN_Created'); ?>
                    <?php echo $form->error($model,'TCCN_Created'); ?>
                </div>
            </div>

                        <div class="form-group">
                <?php echo $form->labelEx($model,'TCCN_Read', array('class'=>'col-sm-2 control-label')); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'TCCN_Read'); ?>
                    <?php echo $form->error($model,'TCCN_Read'); ?>
                </div>
            </div>

                        <div class="form-group">
                <?php echo $form->labelEx($model,'TCCN_IdUSer', array('class'=>'col-sm-2 control-label')); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'TCCN_IdUSer'); ?>
                    <?php echo $form->error($model,'TCCN_IdUSer'); ?>
                </div>
            </div>

            
        <div class="form-actions col-sm-offset-2 col-sm-10">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class'=>'btn btn-primary')); ?>
            <a href="admin" class="btn">Cancel</a>
        <!--</div>-->
        <?php $this->endWidget(); ?>
    </div>
</div>



