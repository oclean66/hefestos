<?php
if (!Yii::app()->user->isGuest)
    $this->redirect('/hocitem/site');
?>
<?php if (Yii::app()->user->hasFlash('loginflash')) { ?>
    <div class="flash-error">
        <div class="">
            <div class="jumbotron">
                <h3 class="lighter smaller">
                    <?php echo Yii::app()->user->getFlash('loginflash'); ?>
                </h3>

                <div class="space"></div>

                <div>
                    <h4 class="lighter smaller">Mientras tanto, intente lo siguiente:</h4>

                    <ul class="unstyled spaced inline bigger-110">
                        <li>
                            <i class="icon-hand-right blue"></i>
                            Verifique su URL
                        </li>
                        <li>
                            <i class="icon-hand-right blue"></i>
                            Contactenos e indiquenos mas informacion sobre este error!
                        </li>
                    </ul>
                    <a href="login" class="btn btn-primary" style="display: block;"> Reintentar</a>
                </div>

                <hr />
                <div class="space"></div>


            </div>
        </div>

    </div>
    <?php
} else {

   
   
    ?>
       <div class="login-body">
                <h2>INICIE SESION</h2>
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'logon-form',
                    'enableClientValidation' => false,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
                ));
                ?>

                <div class="form-group">
                    <div class="email controls">
                            <!--<input type="text" name='uemail' placeholder="Email address" class='form-control' data-rule-required="true" data-rule-email="true">-->
                        <?php //echo $form->labelEx($model, 'username'); ?>
                        <?php echo $form->textField($model, 'username', array('placeholder' => "Usuario o Email", 'class' => 'form-control', 'data-rule-required' => "true", 'data-rule-email' => "true")); ?>
                        <?php echo $form->error($model, 'username',array('class'=>'label label-danger')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="pw controls">
                            <!--<input type="password" name="upw" placeholder="Password" class='form-control' data-rule-required="true">-->
                        <?php //echo $form->labelEx($model, 'password'); ?>
                        <?php echo $form->passwordField($model, 'password', array('placeholder' => "Contraseña", 'class' => 'form-control', 'data-rule-required' => "true", 'data-rule-email' => "true")); ?>
                        <?php echo $form->error($model, 'password',array('class'=>'label label-danger')); ?>
                    </div>
                </div>
                <div class="submit">
<!--                    <div class="remember">

                        <?php echo $form->checkBox($model, 'rememberMe', array('name' => "remember", 'class' => 'icheck-me', 'data-skin' => "square", 'data-color' => "blue", 'id' => "remember")); ?>
                        <label for="remember">Recordarme</label><?php //echo $form->label($model, 'rememberMe');   ?>
                        <?php echo $form->error($model, 'rememberMe',array('class'=>'label label-danger')); ?>
                    </div>-->
                    <?php // Yii::app()->user->ui->tbutton(CrugeTranslator::t('logon', "Login")); ?>
                    <?php echo CHtml::submitButton('Iniciar Sesion' , array('class' => 'btn btn-primary','style'=>'width:120px;')); ?>
                </div>

                <?php
		if (Yii::app()->getComponent('crugeconnector') != null) {
                    if (Yii::app()->crugeconnector->hasEnabledClients) {
                        ?>
                        <div class='crugeconnector'>
                            <span><?php echo CrugeTranslator::t('logon', 'You also can login with'); ?>:</span>
                            <ul>
                                <?php
                                $cc = Yii::app()->crugeconnector;
                                foreach ($cc->enabledClients as $key => $config) {
                                    $image = CHtml::image($cc->getClientDefaultImage($key));
                                    echo "<li>" . CHtml::link($image, $cc->getClientLoginUrl($key)) . "</li>";
                                }
                                ?>
                            </ul>
                        </div>
                        <?php
                    }
                }
                ?>

                <?php $this->endWidget(); ?>
                <div class="forget">
                    <a href="#">
                        <span></span>
                    </a>
                </div>
            </div>
        

    <?php
}?>