<div class="box box-bordered box-color">
    <div class="box-title">
        <h3>
            <i class="fa fa-th-list"></i><?php echo ucwords(CrugeTranslator::t("crear nuevo usuario")); ?></h3>
    </div>
    <div class="box-content nopadding">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'crugestoreduser-form',
            'enableAjaxValidation' => false,
            'enableClientValidation' => false,
            'htmlOptions'=>array('class'=>'form-horizontal form-bordered') 
        ));
        
        ?>
         <?php // echo $form->errorSummary($model, array('class' => 'label label-danger')); ?>
        
        
        <div class="form-group">
            <?php echo $form->labelEx($model, 'username',array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'username', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'username', array('class' => 'label label-danger')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'email',array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'email', array('class' => 'label label-danger')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'newPassword',array('class'=>'control-label col-sm-2')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model, 'newPassword'); ?>

                <script>
                    function fnSuccess(data) {
                        $('#CrugeStoredUser_newPassword').val(data);
                    }
                    function fnError(e) {
                        alert("error: " + e.responseText);
                    }
                </script>
                <?php
                echo CHtml::ajaxbutton(
                        CrugeTranslator::t("Generar una nueva clave")
                        , Yii::app()->user->ui->ajaxGenerateNewPasswordUrl
                        , array('success' => 'js:fnSuccess', 'error' => 'js:fnError',array('class'=>'btn btn-success'))
                );
                ?>
                <?php echo $form->error($model, 'newPassword'); ?>
            </div>
        </div>      
        <div class="form-actions col-sm-offset-2 col-sm-10">
            <?php Yii::app()->user->ui->tbutton("Crear Usuario",array('btn btn-primary')); ?>
            
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
