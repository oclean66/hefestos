<?php
/* @var $this GccdController */
/* @var $model Gccd */
/* @var $form CActiveForm */
?>

<div class="box box-bordered box-color">
    <div class="box-title">
        <h3>
            <i class="fa fa-th-list"></i><?php echo $model->isNewRecord ? 'Crear ' : 'Actualizar '; ?>Grupo</h3>
    </div>
    <div class="box-content nopadding">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'gccd-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array('class' => 'form-horizontal form-bordered'),
        ));
        ?>



        <?php echo $form->errorSummary($model, 'Corriga lo siguiente', '', array('class' => 'alert alert-danger alert-dismissable')); ?>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'GCCD_Cod', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'GCCD_Cod', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'GCCD_Cod', array('class' => 'label label-danger')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'GCCD_Nombre', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'GCCD_Nombre', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'GCCD_Nombre', array('class' => 'label label-danger')); ?>
            </div>
        </div>

       <!--//-------------------------------------------------->
                <?php
                if (!$model->isNewRecord) {
                    ?>
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'Grupo Padre:', array('class' => 'control-label col-sm-2')); ?>
                         <div class="col-sm-10">
                        <?php echo isset($model->GCCD_Id)?$form->dropDownList($model, 'GCCD_IdSuperior', CHtml::listData(Gccd::model()->findAll(''), 'GCCD_Id', 'concatened'), array('empty' => 'Sin Grupo','class'=>'select2-me','style'=>'width:100%')):'Sin Padre';      ?>                         
                        <?php echo $form->error($model, 'GCCD_IdSuperior',array('class' => 'label label-danger')); ?>
                    </div>  </div>
                    <?php
                } else if ($model->isNewRecord && $id != null) {
                    ?>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'Grupo Padre:', array('class' => 'control-label col-sm-2')); ?>
                         <div class="col-sm-10">
                        <?php echo CHtml::textField('padre', $model->gCCDIdSuperior->Concatened, array('disabled' => 'disabled')); ?>
                        <?php echo $form->error($model, 'GCCD_IdSuperior',array('class' => 'label label-danger')); ?>
                    </div>  </div>
                    <?php
                } else if ($model->isNewRecord && $id == null) {
                    ?>
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'Grupo Padre:', array('class' => 'control-label col-sm-2')); ?>
                         <div class="col-sm-10">
                        <?php echo $form->dropDownList($model, 'GCCD_IdSuperior', CHtml::listData(Gccd::model()->findAll(''), 'GCCD_Id', 'concatened'), array('empty' => 'Sin Grupo','class'=>'select2-me','style'=>'width:100%')); ?>
                        <?php echo $form->error($model, 'GCCD_IdSuperior',array('class' => 'label label-danger')); ?>
                    </div>  </div>
                    <?php
                }
                ?>
                <!--//-------------------------------------------------->

        <!-- <div class="form-group">
            <?php echo $form->labelEx($model, 'GCCD_Estado', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->dropDownList($model, 'GCCD_Estado', array('0' => 'Inactiva', '1' => 'Activa'), array('empty' => 'Seleccione','class'=>'')); ?>                    
                <?php echo $form->error($model, 'GCCD_Estado', array('class' => 'label label-danger')); ?>
            </div>
        </div> -->

        <div class="form-group">
            <?php echo $form->labelEx($model, 'GCCD_Responsable', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'GCCD_Responsable', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'GCCD_Responsable', array('class' => 'label label-danger')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'GCCD_Telefono', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'GCCD_Telefono', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'GCCD_Telefono', array('class' => 'label label-danger')); ?>
            </div>
        </div>

        <div class="form-actions col-sm-offset-2 col-sm-10">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class' => 'btn btn-primary')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->