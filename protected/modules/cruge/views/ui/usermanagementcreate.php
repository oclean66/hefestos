<div class="box box-bordered box-color">
    <div class="box-title">
        <h3>
            <i class="fa fa-th-list"></i><?php echo ucwords(CrugeTranslator::t("crear nuevo usuario")); ?>
        </h3>
    </div>
    <div class="box-content nopadding">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'crugestoreduser-form',
            'enableAjaxValidation' => false,
            'enableClientValidation' => false,
            'htmlOptions' => array('class' => 'form-horizontal form-bordered')
        ));

        ?>
        <?php // echo $form->errorSummary($model, array('class' => 'label label-danger')); 
        ?>
        <div class="col-sm-2">
            <div style="padding:30px 0px 0px 22px">
                <div class="thumbnail" id="imagenpreview" style="width: 125px; height:125px; border:none; border-radius: 6px">
                    <img id="imgperfil" src="<?php echo  Yii::app()->params->domain . "/" . Yii::app()->params->folder . "/themes/flat/img/avatars/user-picture.png"; ?>" alt="<?php echo  Yii::app()->params->domain . "/" . Yii::app()->params->folder . "/themes/flat/img/avatars/user-picture.png"; ?>">
                </div>

                <div id="upload-demo" class="hide"></div>
            </div>
            <div class="btn btn-orange btn-block" style="overflow: hidden; width:160px">
                <input id="upload" name="subir" type="file" style="opacity: 0; position: absolute; padding:0px 0px 0px 20px" />
                <i class="fa fa-camera"></i> Subir Imagen
            </div>
            <div class="upload-result btn btn-orange btn-block hide" style="overflow: hidden; width:160px">
                <input id="avatar" name="avatar" type="hidden" style="opacity: 0; position: absolute" />
                <i class="fa fa-check"></i> Finalizar
            </div>
            <?php //}  
            ?>
        </div>
        <div class="col-md-10">

            <div class="form-group">
                <?php echo $form->labelEx($model, 'username', array('class' => 'control-label col-sm-2')); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model, 'username', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'username', array('class' => 'label label-danger')); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'email', array('class' => 'control-label col-sm-2')); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'email', array('class' => 'label label-danger')); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'newPassword', array('class' => 'control-label col-sm-2')); ?>
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
                        CrugeTranslator::t("Generar una nueva clave"),
                        Yii::app()->user->ui->ajaxGenerateNewPasswordUrl,
                        array('success' => 'js:fnSuccess', 'error' => 'js:fnError', array('class' => 'btn btn-success'))
                    );
                    ?>
                    <?php echo $form->error($model, 'newPassword'); ?>
                </div>
            </div>

            <div class='form-group'>
                <?php echo $form->labelEx($model, 'GCCD_Id', array('class' => 'control-label col-sm-2')); ?>
                <div class="col-sm-10">
                    <?php
                   
                        echo CHtml::textField(
                            'GCCD',
                            isset(Yii::app()->user->grupo) ? Yii::app()->user->grupo : "** WEBMASTER **",
                            array(
                                'disabled' => 'disabled',
                                'class' => 'form-control'
                            )
                        );
                    
                    ?>
                    <?php echo $form->error($model, 'GCCD_Id'); ?>
                </div>
            </div>

            <div class='form-group'>
                <?php echo $form->labelEx($model, 'Bussiness_Id', array('class' => 'control-label col-sm-2')); ?>
                <div class="col-sm-10">
                    <?php

                    echo CHtml::textField(
                        'Bussiness_Id',
                        isset(Yii::app()->user->bussiness) ? Yii::app()->user->bussiness : "** WEBMASTER **",
                        array(
                            'disabled' => 'disabled',
                            'class' => 'form-control'
                        )
                    );

                    ?>
                    <?php echo $form->error($model, 'GCCD_Id'); ?>
                </div>
            </div>
            <?php if (count($model->getFields()) > 0) {


                foreach ($model->getFields() as $f) {
                    if ($f->fieldname != 'avatar') {

                        echo "<div class='form-group'>";
                        // aqui $f es una instancia que implementa a: ICrugeField
                        echo Yii::app()->user->um->getLabelField($f);
                        echo "<div class='col-sm-10'>";
                        echo Yii::app()->user->um->getInputField($model, $f);
                        echo $form->error($model, $f->fieldname);
                        echo "</div>";
                        echo "</div>";
                    }
                }
            }
            ?>
        </div>
        <div class="form-actions col-sm-offset-2 col-sm-10">
            <?php Yii::app()->user->ui->tbutton("Crear Usuario", array('btn btn-primary')); ?>

        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>