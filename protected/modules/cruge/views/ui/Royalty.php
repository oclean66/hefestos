<h1>Crear Mensaje de Royalty </h1>
 <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'gcca-form',
        'enableAjaxValidation' => false,
    ));?>
<div class="form">
    <div class="row">
        <?php echo CHtml::label('Email',"hola"); ?>
        <?php echo CHtml::textField('email', "");?>
    </div>
    <div class="row">
        <?php echo CHtml::label('Nombre',"hola"); ?>
        <?php echo CHtml::textField('nombre', "");?>
    </div>
    <div class="row">
        <?php echo CHtml::label('Informacion',"hola"); ?>
        <?php echo CHtml::textField('data', "");?>
    </div>
    <?php echo CHtml::submitButton('Crear', array('class' => 'btn btn-primary')); ?>

</div>

<?php $this->endWidget(); ?>