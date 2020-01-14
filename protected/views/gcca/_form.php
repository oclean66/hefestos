<?php
/* @var $this GccaController */
/* @var $model Gcca */
/* @var $form CActiveForm */
?>

<div class="box box-bordered box-color">
    <div class="box-title">
        <h3>
            <i class="fa fa-th-list"></i><?php echo $model->isNewRecord ? 'Crear ' : 'Actualizar '; ?>Agencia</h3>
    </div>
    <div class="box-content nopadding">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'gcca-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array('class' => 'form-horizontal form-bordered'),
        ));
        ?>



        <?php echo $form->errorSummary($model, 'Corriga lo siguiente', '', array('class' => 'alert alert-danger alert-dismissable')); ?>


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
                    <?php echo isset($model->GCCD_Id) ?  $form->dropDownList($model, 'GCCD_Id', CHtml::listData(Gccd::model()->findAll(''), 'GCCD_Id', 'concatened'), array('empty' => 'Sin Grupo', 'class' => 'form-control')) : 'Sin Padre'; ?>                         
                    <?php echo $form->error($model, 'GCCD_Id', array('class' => 'label label-danger')); ?>
                </div>  </div>
            <?php
        } else if ($model->isNewRecord && $id != null) {
            ?>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'Grupo:', array('class' => 'control-label col-sm-2')); ?>
                <div class="col-sm-10">
                    <?php echo CHtml::textField('padre', $model->gCCD->Concatened, array('disabled' => 'disabled')); ?>
                    <?php echo $form->error($model, 'GCCD_Id', array('class' => 'label label-danger')); ?>
                </div>  </div>
            <?php
        } else if ($model->isNewRecord && $id == null) {
            ?>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'Grupo:', array('class' => 'control-label col-sm-2')); ?>
                <div class="col-sm-10">
                    <?php echo $form->dropDownList($model, 'GCCD_Id', CHtml::listData(Gccd::model()->findAll(''), 'GCCD_Id', 'concatened'), array('empty' => 'Sin Grupo', 'class' => 'form-control'));
                    ?>
                    <?php echo $form->error($model, 'GCCD_Id', array('class' => 'label label-danger')); ?>
                </div>  </div>
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
            <?php echo $form->labelEx($model, 'GCCA_Status', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->dropDownList($model, 'GCCA_Status', array('0' => 'Inactiva', '1' => 'Activa'), array('empty' => 'Seleccione','class'=>'form-control')); ?>   
                <?php echo $form->error($model, 'GCCA_Status', array('class' => 'label label-danger')); ?>
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

        <div class="form-actions col-sm-offset-2 col-sm-10">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class' => 'btn btn-primary')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->