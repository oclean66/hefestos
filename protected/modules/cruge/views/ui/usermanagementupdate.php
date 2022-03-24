<?php
/*
  $model:
  es una instancia que implementa a ICrugeStoredUser, y debe traer ya los campos extra 	accesibles desde $model->getFields()

  $boolIsUserManagement:
  true o false.  si es true indica que esta operandose bajo el action de adminstracion de usuarios, si es false indica que se esta operando bajo 'editar tu perfil'
 */
// print_r($model->attributes);
?>

<div class="row">
    <div class="col-sm-12">
        <div class="box box-bordered box-color">
            <div class="box-title">
                <h3>
                    <i class="fa fa-copy"></i>
                    <?php
                    echo ucwords(CrugeTranslator::t(
                        $boolIsUserManagement ? "editando usuario" : "editando tu perfil"
                    ));
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
                <div class="col-sm-2">
                    <div style="padding:30px 0px 0px 22px">
                        <div class="thumbnail" id="imagenpreview" style="width: 125px; height:125px; border:none; border-radius: 6px">
                            <img id="imgperfil" src="<?php echo Yii::app()->user->um->getFieldValueInstance($model->iduser, 'avatar')->value != '' ? Yii::app()->user->um->getFieldValueInstance($model->iduser, 'avatar')->value : Yii::app()->params->domain."/".Yii::app()->params->folder."/themes/flat/img/avatars/user-picture.png"; ?>" alt="<?php echo Yii::app()->user->um->getFieldValueInstance($model->iduser, 'avatar')->value; ?>">
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

                <div class="col-sm-10 ">
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
                            echo CHtml::ajaxbutton(
                                CrugeTranslator::t("Generar una nueva clave"),
                                Yii::app()->user->ui->ajaxGenerateNewPasswordUrl,
                                array(
                                    'success' => new CJavaScriptExpression('fnSuccess'),
                                    'error' => new CJavaScriptExpression('fnError'),

                                ),
                                array('class' => 'btn btn-small')
                            );
                            ?>
                        </div>
                    </div>

                    <div class='form-group'>
                        <?php echo $form->labelEx($model, 'GCCD_Id', array('class' => 'control-label col-sm-2')); ?>
                        <div class="col-sm-10">       
                            <?php
                            if (Yii::app()->user->isSuperAdmin) {
                                $var = Gccd::model()->getManagers();
                                echo $form->dropDownList($model, 'GCCD_Id', $var, array('empty' => '** Webmaster **', 'class' => ''));
                                //echo $form->textField($model,'GCCD_Id'); 
                            } else {
                                echo CHtml::textField('GCCD', isset($model->GCCD_Id)? $model->gccd->GCCD_Nombre:"** WEBMASTER **", 
                                    array(
                                        'disabled' => 'disabled', 
                                        'class' => 'form-control'
                                    )
                                );
                            }
                            ?>
                            <?php echo $form->error($model, 'GCCD_Id'); ?>
                        </div>
                    </div>
                    <div class='form-group'>
                        <?php echo $form->labelEx($model, 'Bussiness_Id', array('class' => 'control-label col-sm-2')); ?>
                        <div class="col-sm-10">       
                            <?php
                            if (Yii::app()->user->isSuperAdmin) {
                                $var = array("gana"=>"Gana", "kingdeportes"=>"Kingdeportes", "excelencia"=>"Excelencia");
                                echo $form->dropDownList($model, 'Bussiness_Id', $var, array('empty' => '** Webmaster **', 'class' => ''));
                                //echo $form->textField($model,'GCCD_Id'); 
                            } else {
                                echo CHtml::textField('Bussiness_Id', isset($model->Bussiness_Id)? $model->Bussiness_Id:"** WEBMASTER **", 
                                    array(
                                        'disabled' => 'disabled', 
                                        'class' => 'form-control'
                                    )
                                );
                            }
                            ?>
                            <?php echo $form->error($model, 'GCCD_Id'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'regdate', array('class' => 'control-label col-sm-2')); ?>
                        <div class="col-sm-10">
                            <?php
                            echo $form->textField($model, 'regdate', array(
                                'class' => 'form-control', 'readonly' => 'readonly',
                                'value' => Yii::app()->user->ui->formatDate($model->regdate),
                            ));
                            ?>
                            <?php echo $form->error($model, 'regdate'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'actdate', array('class' => 'control-label col-sm-2')); ?>
                        <div class="col-sm-10">
                            <?php
                            echo $form->textField($model, 'actdate', array(
                                'class' => 'form-control', 'readonly' => 'readonly',
                                'value' => Yii::app()->user->ui->formatDate($model->actdate),
                            ));
                            ?>
                            <?php echo $form->error($model, 'actdate'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'logondate', array('class' => 'control-label col-sm-2')); ?>
                        <div class="col-sm-10">
                            <?php echo $form->textField($model, 'logondate', array(
                                'class' => 'form-control', 'readonly' => 'readonly',
                                'value' => Yii::app()->user->ui->formatDate($model->logondate),
                            )); ?>
                            <?php echo $form->error($model, 'logondate'); ?>
                        </div>
                    </div>
                    <?php
                    if (count($model->getFields()) > 0) {


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


                    <div class="form-actions col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
if ($boolIsUserManagement)
    if (Yii::app()->user->checkAccess(
        'edit-advanced-profile-features',
        __FILE__ . " linea " . __LINE__
    ))
        $this->renderPartial(
            '_edit-advanced-profile-features',
            array('model' => $model, 'form' => $form),
            false
        );
?>






<?php echo $form->errorSummary($model); ?>
<?php $this->endWidget(); ?>
</div>
<script>
    $(function() {
        var $uploadCrop;

        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.upload-demo').addClass('ready');
                    $uploadCrop.croppie('bind', {
                        url: e.target.result
                    }).then(function() {
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                $.gritter.add({
                    position: 'bottom-left',
                    // (string | mandatory) the heading of the notification
                    title: 'Sorry',
                    sticky: true,
                    image: "<?= Yii::app()->params->domain."/".Yii::app()->params->folder ?>/themes/flat/img/icons/RegEdit.png",
                    time_alive: 1000,
                    // (string | mandatory) the text inside the notification
                    text: 'youre browser doesnt support the FileReader API',
                });
                // swal("Sorry - you're browser doesn't support the FileReader API");
            }
        }
        console.log("cargando");

        $uploadCrop = $('#upload-demo').croppie({
            enableExif: true,

            viewport: {
                width: 100,
                height: 100,
                type: 'circle'
            },
            boundary: {
                width: 100,
                height: 100
            }
        });

        $('#upload').on('change', function() {
            // console.log("cambio"),
            $('#imagenpreview').addClass('hide');
            $('#upload-demo').removeClass('hide');
            $('.upload-result').removeClass('hide');
            readFile(this);
        });
        $('.upload-result').on('click', function(ev) {
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(resp) {
                // popupResult({
                //     src: resp
                // });
                console.log(resp);

                $('#avatar').val(resp);
                $('#crugestoreduser-form').submit();
            });
        });

    });
</script>