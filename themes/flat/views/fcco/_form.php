<?php
/* @var $this FccoController */
/* @var $model Fcco */
/* @var $form CActiveForm */
?>

<div class="box box-bordered box-color">
    <div class="box-title">
        <h3>
            <i class="fa fa-th-list"></i><?php echo $model->isNewRecord ? 'Crear ' : 'Actualizar '; ?>Fcco</h3>
    </div>
    <div class="box-content nopadding">

        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'fcco-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('class' => 'form-horizontal form-bordered'),
)); ?>



        <?php echo $form->errorSummary($model,'Corrija lo siguiente','', array('class' => 'alert alert-danger alert-dismissable')); ?>

                    <div class="form-group">
                <?php echo $form->labelEx($model,'FCCO_Timestamp',array('class'=>'control-label col-sm-2')); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'FCCO_Timestamp',array('class'=>'form-control','size'=>45,'maxlength'=>45)); ?>
                    <?php echo $form->error($model,'FCCO_Timestamp',array('class' => 'label label-danger')); ?>
                </div>
            </div>

                        <div class="form-group">
                <?php echo $form->labelEx($model,'FCCO_Lote',array('class'=>'control-label col-sm-2')); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'FCCO_Lote',array('class'=>'form-control','size'=>45,'maxlength'=>45)); ?>
                    <?php echo $form->error($model,'FCCO_Lote',array('class' => 'label label-danger')); ?>
                </div>
            </div>

                        <div class="form-group">
                <?php echo $form->labelEx($model,'FCCO_Descripcion',array('class'=>'control-label col-sm-2')); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'FCCO_Descripcion',array('class'=>'form-control','size'=>45,'maxlength'=>45)); ?>
                    <?php echo $form->error($model,'FCCO_Descripcion',array('class' => 'label label-danger')); ?>
                </div>
            </div>

                        <div class="form-group">
                <?php echo $form->labelEx($model,'FCCO_Enabled',array('class'=>'control-label col-sm-2')); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'FCCO_Enabled',array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'FCCO_Enabled',array('class' => 'label label-danger')); ?>
                </div>
            </div>

                        <div class="form-group">
                <?php echo $form->labelEx($model,'FCCN_Id',array('class'=>'control-label col-sm-2')); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'FCCN_Id',array('class'=>'form-control','size'=>10,'maxlength'=>10)); ?>
                    <?php echo $form->error($model,'FCCN_Id',array('class' => 'label label-danger')); ?>
                </div>
            </div>

                        <div class="form-group">
                <?php echo $form->labelEx($model,'FCCU_Id',array('class'=>'control-label col-sm-2')); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'FCCU_Id',array('class'=>'form-control','size'=>10,'maxlength'=>10)); ?>
                    <?php echo $form->error($model,'FCCU_Id',array('class' => 'label label-danger')); ?>
                </div>
            </div>

                        <div class="form-group">
                <?php echo $form->labelEx($model,'GCCA_Id',array('class'=>'control-label col-sm-2')); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'GCCA_Id',array('class'=>'form-control','size'=>10,'maxlength'=>10)); ?>
                    <?php echo $form->error($model,'GCCA_Id',array('class' => 'label label-danger')); ?>
                </div>
            </div>

                        <div class="form-group">
                <?php echo $form->labelEx($model,'GCCD_Id',array('class'=>'control-label col-sm-2')); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'GCCD_Id',array('class'=>'form-control','size'=>10,'maxlength'=>10)); ?>
                    <?php echo $form->error($model,'GCCD_Id',array('class' => 'label label-danger')); ?>
                </div>
            </div>

                    <div class="form-actions col-sm-offset-2 col-sm-10">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class' => 'btn btn-primary')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->