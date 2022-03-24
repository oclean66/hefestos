<?php
/* @var $this GccaController */
/* @var $model Gcca */
/* @var $form CActiveForm */
?>

<div class="box box-bordered box-color">
    <div class="box-title">
        <h3>
            <i class="fa fa-th-list"></i><?php echo $model->isNewRecord ? 'Crear ' : 'Actualizar '; ?>Agencia
        </h3>
    </div>
    <div class="box-content nopadding">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'gcca-form',
            'enableAjaxValidation' => true,
            'htmlOptions' => array('class' => 'form-horizontal form-bordered'),
        ));
        ?>



        <?php echo $form->errorSummary($model, 'Corrija lo siguiente', '', array('class' => 'alert alert-danger alert-dismissable')); ?>


        <div class="form-group">
            <?php echo $form->labelEx($model, 'GCCA_Cod', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'GCCA_Cod', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'GCCA_Cod', array('class' => 'label label-danger')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'GCCA_Nombre', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'GCCA_Nombre', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'GCCA_Nombre', array('class' => 'label label-danger')); ?>
            </div>
        </div>


        <!--//-------------------------------------------------->
        <?php
        if (!$model->isNewRecord) {
        ?>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'Grupo:', array('class' => 'control-label col-sm-2')); ?>
                <div class="col-sm-10">
                  
                    <?php
                    if (isset($model->gCCD->Concatened) && !Yii::app()->user->isSuperAdmin) {
                        // echo CHtml::textField('padre', $model->gccd->Concatened, array('class' => "form-control", 'disabled' => 'disabled'));
                        echo $form->dropDownList($model, 'GCCD_Id', CHtml::listData(Gccd::model()->findAll(' 1 and GCCD_Id in (' . implode(",", Gccd::model()->arrayHijos(Yii::app()->user->grupo)) . ') order by GCCD_Nombre'), 'GCCD_Id', 'concatened'), array('class' => "select2-me", 'style' => 'width:100%;', 'empty' => 'Sin Grupo'));
                        // echo Yii::app()->user->checkAccess('Administrador') ? 
                        // CHtml::button('Migrar',array('class'=>'btn btn-success','data-toggle'=>"modal", 'data-target'=>".bs-example-modal-sm")):"";
                    } else
                        echo $form->dropDownList($model, 'GCCD_Id', CHtml::listData(Gccd::model()->findAll(' 1 and GCCD_Id in (' . implode(",", Gccd::model()->arrayHijos(Yii::app()->user->grupo)) . ') order by GCCD_Nombre'), 'GCCD_Id', 'concatened'), array('class' => "select2-me", 'style' => 'width:100%;', 'empty' => 'Sin Grupo'));
                    ?>

                    <?php echo $form->error($model, 'GCCD_Id', array('class' => 'label label-danger')); ?>
                </div>
            </div>
        <?php
        } else if ($model->isNewRecord && $id != null) {
        ?>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'Grupo:', array('class' => 'control-label col-sm-2')); ?>
                <div class="col-sm-10">
                    <?php echo CHtml::textField('padre', $model->gCCD->Concatened, array('disabled' => 'disabled')); ?>
                    <?php echo $form->error($model, 'GCCD_Id', array('class' => 'label label-danger')); ?>
                </div>
            </div>
        <?php
        } else if ($model->isNewRecord && $id == null) {
        ?>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'Grupo:', array('class' => 'control-label col-sm-2')); ?>
                <div class="col-sm-10">
                  
                    <?php
                    if (isset($model->gCCD->Concatened) && !Yii::app()->user->isSuperAdmin) {
                        // echo CHtml::textField('padre', $model->gccd->Concatened, array('class' => "form-control", 'disabled' => 'disabled'));
                        echo $form->dropDownList($model, 'GCCD_Id', CHtml::listData(Gccd::model()->findAll(' 1 and GCCD_Id in (' . implode(",", Gccd::model()->arrayHijos(Yii::app()->user->grupo)) . ') order by GCCD_Nombre'), 'GCCD_Id', 'concatened'), array('class' => "select2-me", 'style' => 'width:100%;', 'empty' => 'Sin Grupo'));
                        // echo Yii::app()->user->checkAccess('Administrador') ? 
                        // CHtml::button('Migrar',array('class'=>'btn btn-success','data-toggle'=>"modal", 'data-target'=>".bs-example-modal-sm")):"";
                    } else
                        echo $form->dropDownList($model, 'GCCD_Id', CHtml::listData(Gccd::model()->findAll(' 1 and GCCD_Id in (' . implode(",", Gccd::model()->arrayHijos(Yii::app()->user->grupo)) . ') order by GCCD_Nombre'), 'GCCD_Id', 'concatened'), array('class' => "select2-me", 'style' => 'width:100%;', 'empty' => 'Sin Grupo'));
                    ?>
                    <?php echo $form->error($model, 'GCCD_Id', array('class' => 'label label-danger')); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!--//-------------------------------------------------->
        <div class="form-group">
            <?php echo $form->labelEx($model, 'GCCA_Direccion', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'GCCA_Direccion', array('class' => 'form-control', 'size' => 160, 'maxlength' => 160)); ?>
                <?php echo $form->error($model, 'GCCA_Direccion', array('class' => 'label label-danger')); ?>
            </div>
        </div>



        <div class="form-group">
            <?php echo $form->labelEx($model, 'GCCA_Rif', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'GCCA_Rif', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'GCCA_Rif', array('class' => 'label label-danger')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'GCCA_Responsable', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'GCCA_Responsable', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'GCCA_Responsable', array('class' => 'label label-danger')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'GCCA_Telefono', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'GCCA_Telefono', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'GCCA_Telefono', array('class' => 'label label-danger')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'GCCA_Email', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'GCCA_Email', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'GCCA_Email', array('class' => 'label label-danger')); ?>
            </div>
        </div>
        <?php if (Yii::app()->user->isSuperAdmin) { ?>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'GCCA_Status', array('class' => 'control-label col-sm-2')); ?>
                <div class="col-sm-10">
                    <?php

                    echo $form->dropDownList($model, 'GCCA_Status', array('0' => 'Inactivo', '1' => "Activa", "2" => "Oculta", "3" => "Borrado"));
                    ?>
                </div>
            </div>
        <?php } ?>
        <div class="form-actions col-sm-offset-2 col-sm-10">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class' => 'btn btn-primary')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->