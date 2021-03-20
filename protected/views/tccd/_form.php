<?php
/* @var $this TccdController */
/* @var $model Tccd */
/* @var $form CActiveForm */
?>
<div class="box box-bordered box-color">
    <div class="box-title">
        <h3>
            <i class="fa fa-th-list"></i>Crear Tccd</h3>
    </div>
    <div class="box-content nopadding">
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tccd-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('class' => 'form-horizontal form-bordered'),
            )); ?>

        <?php echo $form->errorSummary($model); ?>

                    <div class="form-group">
                <?php echo $form->labelEx($model,'TCCD_Title'); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'TCCD_Title',array('size'=>45,'maxlength'=>45)); ?>
                    <?php echo $form->error($model,'TCCD_Title'); ?>
                </div>
            </div>

                        <div class="form-group">
                <?php echo $form->labelEx($model,'TCCD_Description'); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'TCCD_Description',array('size'=>45,'maxlength'=>45)); ?>
                    <?php echo $form->error($model,'TCCD_Description'); ?>
                </div>
            </div>

                        <div class="form-group">
                <?php echo $form->labelEx($model,'TCCD_Created'); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'TCCD_Created'); ?>
                    <?php echo $form->error($model,'TCCD_Created'); ?>
                </div>
            </div>

                        <div class="form-group">
                <?php echo $form->labelEx($model,'TCCD_Expired'); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'TCCD_Expired'); ?>
                    <?php echo $form->error($model,'TCCD_Expired'); ?>
                </div>
            </div>

                        <div class="form-group">
                <?php echo $form->labelEx($model,'TCCD_Order'); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'TCCD_Order'); ?>
                    <?php echo $form->error($model,'TCCD_Order'); ?>
                </div>
            </div>

                        <div class="form-group">
                <?php echo $form->labelEx($model,'TCCA_Id'); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'TCCA_Id'); ?>
                    <?php echo $form->error($model,'TCCA_Id'); ?>
                </div>
            </div>

            
        <div class="form-actions col-sm-offset-2 col-sm-10">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class'=>'btn btn-primary')); ?>
            <a href="admin" class="btn">Cancel</a>
        <!--</div>-->
        <?php $this->endWidget(); ?>
    </div>
</div>



