<?php
/*
  $model:
  es una instancia que implementa a ICrugeStoredUser, y debe traer ya los campos extra 	accesibles desde $model->getFields()

  $boolIsUserManagement:
  true o false.  si es true indica que esta operandose bajo el action de adminstracion de usuarios, si es false indica que se esta operando bajo 'editar tu perfil'
 */
?>

<div class="row">
    <div class="col-sm-12">
        <div class="box box-bordered box-color">
            <div class="box-title">
                <h3>
                    <i class="fa fa-copy"></i><?php
                    echo ucwords(CrugeTranslator::t(
                                    $boolIsUserManagement ? "editando usuario" : "editando tu perfil"));
                    ?>
                </h3>
            </div>
            <div class="box-content nopadding">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'crugestoreduser-form',
                    'htmlOptions' => array('class' => 'form-horizontal form-bordered'),
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => false,
                ));
                ?>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'username', array('class' => 'control-label col-sm-2')); ?>
                    <div class="col-sm-10">                        
                        <?php echo $form->textField($model, 'username', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'username'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'email', array('class' => 'control-label col-sm-2')); ?>
                    <div class="col-sm-10">                        
                        <?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'email'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'newPassword', array('class' => 'control-label col-sm-2')); ?>
                    <div class="col-sm-10">                        
                        <?php echo $form->textField($model, 'newPassword', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'newPassword'); ?>
                        <script>
                            function fnSuccess(data) {
                                $('#CrugeStoredUser_newPassword').val(data);
                            }
                            function fnError(e) {
                                alert("error: " + e.responseText);
                            }
                        </script>
                        <?php
                        echo CHtml::ajaxbutton(CrugeTranslator::t("Generar una nueva clave"),
                                Yii::app()->user->ui->ajaxGenerateNewPasswordUrl, 
                                array('success' => new CJavaScriptExpression('fnSuccess'), 
                                      'error' => new CJavaScriptExpression('fnError'),
                                      
                                    ),
                                array('class'=>'btn btn-small')
                        );
                        ?>
                    </div>
                </div>


                 <div class="form-group">
                    <?php echo $form->labelEx($model, 'regdate', array('class' => 'control-label col-sm-2')); ?>
                    <div class="col-sm-10">                        
                        <?php
                        echo $form->textField($model, 'regdate', array('class' => 'form-control', 'readonly' => 'readonly',
                            'value' => Yii::app()->user->ui->formatDate($model->regdate),));
                        ?>
                        <?php echo $form->error($model, 'regdate'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'actdate', array('class' => 'control-label col-sm-2')); ?>
                    <div class="col-sm-10">                        
                        <?php
                        echo $form->textField($model, 'actdate', array('class' => 'form-control', 'readonly' => 'readonly',
                            'value' => Yii::app()->user->ui->formatDate($model->actdate),));
                        ?>
                        <?php echo $form->error($model, 'actdate'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'logondate', array('class' => 'control-label col-sm-2')); ?>
                    <div class="col-sm-10">                        
                        <?php echo $form->textField($model, 'logondate', array('class' => 'form-control','readonly'=>'readonly',
						'value'=>Yii::app()->user->ui->formatDate($model->logondate),)); ?>
                        <?php echo $form->error($model, 'logondate'); ?>
                    </div>
                </div>     
                <?php
                if (count($model->getFields()) > 0) {


                    foreach ($model->getFields() as $f) {
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
                ?>


                <div class="form-actions col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>

                </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
if ($boolIsUserManagement)
    if (Yii::app()->user->checkAccess('edit-advanced-profile-features'
                    , __FILE__ . " linea " . __LINE__))
        $this->renderPartial('_edit-advanced-profile-features'
                , array('model' => $model, 'form' => $form), false);
?>







<?php echo $form->errorSummary($model); ?>
<?php $this->endWidget(); ?>
</div>
