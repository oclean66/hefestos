<?php
/* formulario de edicion de CrugeSystem

  argumento:

  $model: instancia de ICrugeSession
 */
?>

<?php
if (Yii::app()->user->hasFlash('systemFormFlash')) {
    echo "<div class='alert alert-success'>";
    echo Yii::app()->user->getFlash('systemFormFlash');
    echo "</div>";
}
?>

<div class="box box-bordered box-color">
    <div class="box-title">
        <h3>
            <i class="fa fa-th-list"></i><?php echo ucwords(CrugeTranslator::t("Variables del sistema")); ?></h3>
    </div>
    <div class="box-content nopadding">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'crugestoreduser-form',
            'enableAjaxValidation' => false,
            'enableClientValidation' => false,
            'htmlOptions' => array('class' => 'form-horizontal form-bordered form-column')
        ));
        ?>
        <?php // echo $form->errorSummary($model, array('class' => 'label label-danger')); ?>
        <div class="col-sm-6" style="padding: 0; margin: 0">
            <div class="breadcrumbs">
                <ul>
                    <li>
                        <a href="#"> <?php echo ucfirst(CrugeTranslator::t("opciones de sesion")); ?></a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                </ul>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="checkbox">
                        <label>
                            <?php echo $form->checkBox($model, 'systemdown'); ?>
                            <?php echo $form->labelEx($model, 'systemdown', array('class' => 'control-label col-sm-7')); ?>
                            <?php echo $form->error($model, 'systemdown', array('class' => 'label label-danger')); ?>
                            <!--<input type="checkbox" name="checkbox">Lorem ipsum dolor.-->
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <?php echo $form->checkBox($model, 'systemnonewsessions'); ?>
                            <?php echo $form->labelEx($model, 'systemnonewsessions', array('class' => 'control-label col-sm-7')); ?>
                            <?php echo $form->error($model, 'systemnonewsessions', array('class' => 'label label-danger')); ?>
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'sessionmaxdurationmins', array('class' => 'control-label col-sm-7')); ?>
                <div class="col-sm-5">
                    <?php echo $form->textField($model, 'sessionmaxdurationmins', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'sessionmaxdurationmins', array('class' => 'label label-danger')); ?>
                </div>
            </div>          

        </div>        
        <div class="col-sm-6" style="padding: 0; margin: 0">
            <div class="breadcrumbs">
                <ul>
                    <li>
                        <a href="#"> <?php echo ucfirst(CrugeTranslator::t("Registro de Usuarios")); ?></a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                </ul>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    <div class="checkbox">
                        <label>
                            <?php echo $form->checkBox($model, 'registerusingcaptcha'); ?>
                            <?php echo $form->labelEx($model, 'registerusingcaptcha', array('class' => 'control-label col-sm-7')); ?>
                            <?php echo $form->error($model, 'registerusingcaptcha', array('class' => 'label label-danger')); ?>
                            <!--<input type="checkbox" name="checkbox">Lorem ipsum dolor.-->
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <?php echo $form->checkBox($model, 'registrationonlogin'); ?>
                            <?php echo $form->labelEx($model, 'registrationonlogin', array('class' => 'control-label col-sm-7')); ?>
                            <?php echo $form->error($model, 'registrationonlogin', array('class' => 'label label-danger')); ?>
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'registerusingactivation', array('class' => 'control-label col-sm-7')); ?>
                <div class="col-sm-5">
                    <?php echo $form->dropDownList($model, 'registerusingactivation', Yii::app()->user->um->getUserActivationOptions(), array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'registerusingactivation', array('class' => 'label label-danger')); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'defaultroleforregistration', array('class' => 'control-label col-sm-7')); ?>
                <div class="col-sm-5">
                    <?php echo $form->dropDownList($model, 'defaultroleforregistration', Yii::app()->user->rbac->getRolesAsOptions(CrugeTranslator::t("-- No asignar ningun rol --")), array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'defaultroleforregistration', array('class' => 'label label-danger')); ?>
                </div>
            </div>        


        </div>
        <div class="">
            <div class="breadcrumbs">
                <ul>
                    <li>
                        <a href="#"> <?php echo ucfirst(CrugeTranslator::t("terminos y condiciones de registro")); ?></a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                </ul>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="checkbox">
                        <label>
                            <?php echo $form->checkBox($model, 'registerusingterms'); ?>
                            <?php echo $form->labelEx($model, 'registerusingterms', array('class' => 'control-label col-sm-7')); ?>
                            <?php echo $form->error($model, 'registerusingterms', array('class' => 'label label-danger')); ?>
                        </label>
                    </div>


                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'registerusingtermslabel', array('class' => 'control-label col-sm-3')); ?>
                <div class="col-sm-9">                
                    <?php echo $form->textField($model, 'registerusingtermslabel', array('size' => 50, 'maxlength' => 512, 'class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'registerusingtermslabel', array('class' => 'label label-danger')); ?>

                </div>
            </div> 
            <div class="form-group">
                <?php echo $form->labelEx($model, 'terms', array('class' => 'control-label col-sm-3')); ?>
                <div class="col-sm-9">                       
                    <?php echo $form->textArea($model, 'terms', array('rows' => 5, 'cols' => 40, 'class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'terms'); ?>                   
                </div>
            </div>
        </div>
         <div class="">
            <div class="form-actions col-sm-offset-2 col-sm-12">
                <?php Yii::app()->user->ui->tbutton(("Guardar Cambios")); ?>                
            </div>


        </div>

        <?php echo $form->errorSummary($model); ?>
        <?php $this->endWidget(); ?>
    </div>
    
</div>

<!--<div>
    <h2>Variables del Sistema</h2>
<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'CrugeSystem-Form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
    ));
    ?>
    <div class="form-group">
        <h6><?php echo ucwords(CrugeTranslator::t("opciones de sesion")); ?></h6>
        <div class='row'>

            <?php echo $form->checkBox($model, 'systemdown', array('style' => 'margin-top:0;top:1px')); ?>
            <?php echo $form->labelEx($model, 'systemdown'); ?>
            <?php echo $form->error($model, 'systemdown'); ?>
        </div>
        <div class='row'>

            <?php echo $form->checkBox($model, 'systemnonewsessions'); ?>
            <?php echo $form->labelEx($model, 'systemnonewsessions', array('style' => 'width:187px;')); ?>
            <?php echo $form->error($model, 'systemnonewsessions'); ?>
        </div>
        <div class='row'>
            <?php echo $form->labelEx($model, 'sessionmaxdurationmins', array('style' => 'width:230px;')); ?>
            <?php
            echo $form->textField($model, 'sessionmaxdurationmins'
                    , array('size' => 5, 'maxlength' => 4, 'style' => 'width:80px'));
            ?>
            <?php echo $form->error($model, 'sessionmaxdurationmins'); ?>
        </div>
    </div>
    <div class="form-group">
        <h6><?php echo ucwords(CrugeTranslator::t("opciones de registro de usuarios")); ?></h6>
        <div class='row'>

            <?php echo $form->checkBox($model, 'registerusingcaptcha'); ?>
            <?php echo $form->labelEx($model, 'registerusingcaptcha', array('style' => 'width:340px;')); ?>
            <?php echo $form->error($model, 'registerusingcaptcha'); ?>
        </div>
        <div class='row'>
            <?php echo $form->labelEx($model, 'registerusingactivation', array('style' => 'width:340px;')); ?>
            <?php
            echo $form->dropDownList($model, 'registerusingactivation'
                    , Yii::app()->user->um->getUserActivationOptions());
            ?>
            <?php echo $form->error($model, 'registerusingactivation'); ?>
        </div>
        <div class='row'>
            <?php echo $form->labelEx($model, 'defaultroleforregistration', array('style' => 'width:340px;')); ?>
            <?php
            echo $form->dropDownList($model, 'defaultroleforregistration'
                    , Yii::app()->user->rbac->getRolesAsOptions(CrugeTranslator::t(
                                    "--no asignar ningun rol--")));
            ?>
            <?php echo $form->error($model, 'defaultroleforregistration'); ?>
        </div>
        <div class='row'>

            <?php echo $form->checkBox($model, 'registrationonlogin'); ?> 
            <?php echo $form->labelEx($model, 'registrationonlogin', array('style' => 'width:340px;')); ?>
            <?php echo $form->error($model, 'registrationonloginn'); ?>
        </div>
    </div>

    <div class="row form-group">
        <h6><?php echo ucwords(CrugeTranslator::t("terminos y condiciones de registro")); ?></h6>
        <div class='row'>
            <div class='row'>

                <?php echo $form->checkBox($model, 'registerusingterms'); ?>
                <?php echo $form->labelEx($model, 'registerusingterms', array('style' => 'width:250px;')); ?>
                <?php echo $form->error($model, 'registerusingterms'); ?>
            </div>
            <div class='row'>
                <?php echo $form->labelEx($model, 'registerusingtermslabel', array('style' => 'width:250px;')); ?>
                <?php
                echo $form->textField($model, 'registerusingtermslabel'
                        , array('size' => 45, 'maxlength' => 100));
                ?>
                <?php echo $form->error($model, 'registerusingtermslabel'); ?>
            </div>
        </div>
        <hr/>
        <div class='row'>
            <?php echo $form->labelEx($model, 'terms', array('style' => 'width:250px;')); ?>
            <?php
            echo $form->textArea($model, 'terms'
                    , array('rows' => 10, 'cols' => 50));
            ?>
            <?php echo $form->error($model, 'terms'); ?>
        </div>
    </div>


    <div class="row buttons">
        <?php Yii::app()->user->ui->tbutton("Actualizar"); ?>
    </div>
    <?php echo $form->errorSummary($model); ?>
    <?php $this->endWidget(); ?>
</div>
</div>-->
