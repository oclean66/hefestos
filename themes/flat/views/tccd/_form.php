<?php
/* @var $this TccdController */
/* @var $model Tccd */
/* @var $form CActiveForm */
?>
<div class="box box-bordered box-color">
    <div class="box-title">
        <h3>
            <i class="fa fa-th-list"></i><?php echo $model->isNewRecord ? 'Crear ' : 'Actualizar '; ?> Tarea <?php echo $model->isNewRecord ? ' ' : $model->TCCD_Id; ?>
        </h3>
    </div>
    <div class="box-content nopadding">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'tccd-form',
            'enableAjaxValidation' => true,
            'htmlOptions' => array('class' => 'form-horizontal form-bordered'),
        )); ?>

        <?php echo $form->errorSummary($model, 'Corrija lo siguiente', '', array('class' => 'alert alert-danger alert-dismissable')); ?>




        <div class="form-group">
            <?php echo $form->labelEx($model, 'TCCD_Title', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'TCCD_Title', array('size' => 45, 'maxlength' => 45,'class'=>'form-control')); ?>
                <?php echo $form->error($model, 'TCCD_Title'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'TCCD_Description', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'TCCD_Description', array('size' => 255, 'maxlength' => 255,'class'=>'form-control')); ?>
                <?php echo $form->error($model, 'TCCD_Description'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'TCCD_Created', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'TCCD_Created',array('class'=>'form-control')); ?>
                <?php echo $form->error($model, 'TCCD_Created'); ?>
            </div>
        </div>

        <!-- <div class="form-group">
            <?php echo $form->labelEx($model, 'TCCD_Expired', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'TCCD_Expired'); ?>
                <?php echo $form->error($model, 'TCCD_Expired'); ?>
            </div>
        </div> -->

        <!-- <div class="form-group">
            <?php echo $form->labelEx($model, 'TCCD_Order', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'TCCD_Order'); ?>
                <?php echo $form->error($model, 'TCCD_Order'); ?>
            </div>
        </div> -->


        <!-- <div class="form-group">
            <?php echo $form->labelEx($model, 'Tablero', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->dropDownList(
                    $model,
                    'TCCA_Id',
                    CHtml::listData(Tcca::model()->findAll(), 'TCCA_BoardId', 'TCCA_Name'),
                    array(
                        'class' => 'select2-me form-control', 'style' => 'width:100%',
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => CController::createUrl('tcca/Lista'),
                            'update' => '#', Chtml::activeId($model, 'TCCA_Id'),
                        ),
                        'prompt' => 'Selecciona un Tablero...'
                    )
                ); ?>
                <?php echo $form->error($model, 'TCCA_Id'); ?>
            </div>
        </div>


        <div class="form-group">
            <?php echo $form->labelEx($model, 'Lista', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->dropDownList($model, 'TCCA_Id', array(), array('prompt' => 'Selecciona una Lista...')); ?>
                <?php echo $form->error($model, 'TCCA_Id'); ?>
            </div>
        </div> -->

        

        <div class="form-group">
            <label for="textfield" class="control-label col-sm-2">Tablero</label>
            <div class="col-sm-10">
                <?php
                echo CHtml::dropDownList(
                    'Tccd[TCCA]',
                    'Tccd[TCCA]',
                    CHtml::listData(Tcca::model()->findAll('TCCA_BoardId is null'), 'TCCA_Id', 'TCCA_Name'),
                    array(
                        'class' => 'select2-me  form-control', 'style' => 'width:100%', 'prompt' => 'Selecciona un Tablero...',
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => CController::createUrl('tccd/Lista'),
                            'update' => '#lista',
                            'beforeSend' => 'function(){
                                        var select = document.getElementById("lista");    				
                                        select.options.length = 0;
                                        select.options[select.options.length] = new Option("Cargando...", "");}',
                        )
                    )
                ); ?>
            </div>
        </div>


        <div class="form-group">
            <label for="textfield" class="control-label col-sm-2">Lista</label>
            <div class="col-sm-10">
                <?php
                echo CHtml::dropDownList('Tccd[TCCA_Id]', 'Tccd[TCCA_Id]', array(), array(
                    'id' => 'lista', 'empty' => 'Selecciona una Lista...', 'class' => 'select2-me ', 'style' => 'width:100%'
                ));
                ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($activo, 'FCCI_Id', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php
                echo $form->dropDownList($activo, 'FCCI_Id', CHtml::listData(Fcci::model()->findAll( Yii::app()->user->isSuperAdmin ? '':'FCCI_Id != 6'), 'FCCI_Id', 'concatened'), array('prompt' => $activo->FCCI_Id == 6 ?'# De Baja #':'Seleccione un estado...'));
                ?>
            </div>
        </div>


        <div class="form-actions col-sm-offset-2 col-sm-10">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class' => 'btn btn-primary')); ?>
            <!-- <a href="admin" class="btn">Cancel</a> -->
            <!--</div>-->
            <?php $this->endWidget(); ?>
        </div>
    </div>