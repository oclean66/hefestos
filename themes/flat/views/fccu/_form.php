<?php
/* @var $this FccuController */
/* @var $model Fccu */
/* @var $form CActiveForm */
?>

<div class="box box-bordered box-color">
    <div class="box-title nomargin">
        <h3>
            <i class="fa fa-th-list"></i><?php echo $model->isNewRecord ? 'Crear ' : 'Actualizar '; ?> Activo</h3>
    </div>
    <div class="box-content nopadding">

        <?php
            $editable = false;
            if($model->isNewRecord || Yii::app()->user->isSuperAdmin){$editable = true;} 
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'fccu-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array('class' => 'form-horizontal form-bordered'),
            ));
        ?>



        <?php echo $form->errorSummary($model, 'Corrija lo siguiente', '', array('class' => 'alert alert-danger alert-dismissable')); ?>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'FCCU_Serial', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'FCCU_Serial', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45, 'disabled'=>$model->isNewRecord ?false:'disabled')); ?>
                <?php echo $form->error($model, 'FCCU_Serial', array('class' => 'label label-danger')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'FCCU_Timestamp', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'FCCU_Timestamp', array('class' => 'form-control', 'disabled'=>'disabled')); ?>
                <?php echo $form->error($model, 'FCCU_Timestamp', array('class' => 'label label-danger')); ?>
            </div>
        </div>
    

        <div class="form-group">
            <?php echo $form->labelEx($model, 'FCCU_Numero', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'FCCU_Numero', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'FCCU_Numero', array('class' => 'label label-danger')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'FCCU_ClaveDatos', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'FCCU_ClaveDatos', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'FCCU_ClaveDatos', array('class' => 'label label-danger')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'FCCU_ClaveMovil', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'FCCU_ClaveMovil', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'FCCU_ClaveMovil', array('class' => 'label label-danger')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'FCCU_DiaCorte', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'FCCU_DiaCorte', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'FCCU_DiaCorte', array('class' => 'label label-danger')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'FCCU_MontoMin', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'FCCU_MontoMin', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'FCCU_MontoMin', array('class' => 'label label-danger')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'FCCU_TipoServicio', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php //echo $form->textField($model, 'FCCU_TipoServicio', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45)); ?>
                <?php
                echo $form->dropDownList($model, 'FCCU_TipoServicio', array('0' => 'No Posee', '1' => 'Pre-Pago', '2' => 'Corporativa'), array('empty' => 'Selecciona Servicio','class'=>'form-control'));
                ?>
                <?php echo $form->error($model, 'FCCU_TipoServicio', array('class' => 'label label-danger')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'FCCU_Descripcion', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'FCCU_Descripcion', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'FCCU_Descripcion', array('class' => 'label label-danger')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'FCCU_Cantidad', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'FCCU_Cantidad', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'FCCU_Cantidad', array('class' => 'label label-danger')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'FCCU_Facturado', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php
                echo $form->dropDownList($model, 'FCCU_Facturado', array('0' => 'No', '1' => 'Si', '2' => 'No aplica'), array('empty' => 'Selecciona Servicio','class'=>'form-control' ));
                ?>
                <?php echo $form->error($model, 'FCCU_Facturado', array('class' => 'label label-danger')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'FCCD_Id', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php
                echo $form->dropDownList($model, 'FCCD_Id', CHtml::listData(Fccd::model()->findAll(), 'FCCD_Id', 'FCCD_Descripcion'), array( 'prompt' => 'Seleccione un Operador...','class'=>'form-control'));
                ?>
                <?php echo $form->error($model, 'FCCD_Id', array('class' => 'label label-danger')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'FCCT_Id', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->dropDownList($model, 'FCCT_Id', CHtml::listData(Fcct::model()->findAll(), 'FCCT_Id', 'concatened'), array('class' => 'select2-me', 'style' => 'width:100%', 'prompt' => 'Seleccione un Operador...','class'=>'form-control')); ?>
                <?php //echo $form->textField($model, 'FCCT_Id', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10)); ?>
                <?php echo $form->error($model, 'FCCT_Id', array('class' => 'label label-danger')); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="textfield" class="control-label col-sm-2">Marca</label>
            <div class="col-sm-10">
                 <?php $marcas=Fccm::model()->findAll(); ?>
                <select class="select2-me select2-offscreen" style="width:100%" name="Fccu[FCCM_Id]" id="Fccm_FCCM_Id" >
                    <?php foreach($marcas as $m){ ?>
                    <option <?php if($m->FCCM_Id==$model->FCCM_Id ){ ?>selected <?php } ?> value="<?= $m->FCCM_Id ?>"><?= $m->FCCM_Descripcion ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="textfield" class="control-label col-sm-2">Etiquetas</label>
            <div class="col-sm-10">
                 <?php $labels=Fccl::model()->findAll(); ?>
                <select class="select2-me select2-offscreen" style="width:100%" multiple="multiple" name="Fccl[FCCL_Id][]" id="Fccl_FCCL_Id"  multiple="multiple">
                    <?php foreach($labels as $l){ ?>
                    <option <?php if(FcclHasFccu::model()->find("fccu_FCCU_Id=" . $model->FCCU_Id ." and fccl_FCCL_Id =".$l->FCCL_Id )){ ?>selected <?php } ?> value="<?= $l->FCCL_Id ?>"><?= $l->FCCL_Descripcion ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>


        
        <div class="form-group">
            <?php echo $form->labelEx($model, 'FCCI_Id', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php
                echo $form->dropDownList($model, 'FCCI_Id', CHtml::listData(Fcci::model()->findAll('FCCI_Id != 6'), 'FCCI_Id', 'concatened'), array('prompt' => $model->FCCI_Id == 6 ?'# De Baja #':'Seleccione un estado...','class'=>'form-control'));
                ?>
                <?php //echo $form->textField($model, 'FCCI_Id', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10)); ?>
                <?php echo $form->error($model, 'FCCI_Id', array('class' => 'label label-danger')); ?>
                <?php echo $model->FCCI_Id == 6 ? "<b>Se Encuentra de Baja, editarlo lo reincorpora.</b>":"";?>
            </div>
        </div>

        <div class="form-group hide">
            <?php //echo $form->labelEx($model, 'FCCU_Hogar', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php //echo $form->textField($model, 'FCCU_Hogar', array('class' => 'form-control', 'size' => 45, 'maxlength' => 45)); ?>
                <?php
                //echo $form->dropDownList($model, 'FCCU_Hogar', array('10' => 'Deposito Tecnico', '11' => 'Centro Comercial', ), array('empty' => 'Selecciona Hogar'));
                ?>
                <?php //echo $form->error($model, 'FCCU_Hogar', array('class' => 'label label-danger')); ?>
            </div>
        </div>


        <div class="form-group">
            <?php echo $form->labelEx($model, 'FCCS_Id', array('class' => 'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'FCCS_Id', array('class' => 'form-control', 'size' => 10, 'maxlength' => 10)); ?>
                <?php echo $form->error($model, 'FCCS_Id', array('class' => 'label label-danger')); ?>
            </div>
        </div>



        <div class="form-actions col-sm-offset-2 col-sm-10">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class' => 'btn btn-primary')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->