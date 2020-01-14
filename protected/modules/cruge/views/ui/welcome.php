<?php
// llamada cuando el actionRegistration ha insertado a un usuario
?>
<div class='form'>
    <div class="header">
        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logo.png">
    </div>
    <h1><?php echo CrugeTranslator::t("Bienvenido"); ?></h1>

    <p><b><?php if (!isset($text)) echo CrugeTranslator::t('registration', 'The account has been created!'); else echo $text;; ?></b></p>
    <p><?php echo CrugeTranslator::t('registration', 'Click here to login using new credentials:'); ?>
        <?php echo Yii::app()->user->ui->loginLink; ?>
    </p>
</div>