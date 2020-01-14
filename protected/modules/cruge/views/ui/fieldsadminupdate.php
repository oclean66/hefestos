
<div class="box box-bordered box-color">
    <div class="box-title">
        <h3>
            <i class="fa fa-th-list"></i>
            <?php echo ucwords(CrugeTranslator::t((($model->isNewRecord == 1) ? "Creando nuevo campo personalizado" : "Editando campo personalizado"))); ?>
        </h3>
    </div>
    <div class="box-content nopadding">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'crugefield-form',
            'enableAjaxValidation' => false,
            'enableClientValidation' => false,
            'htmlOptions' => array('class' => "form-horizontal form-bordered form-column")
        ));
        ?>


        <div class="col-sm-6" style="padding: 0; margin: 0">
            <div class="breadcrumbs">
                <ul>
                    <li>
                        <a href="#"> <?php echo ucfirst(CrugeTranslator::t("Datos del campo")); ?></a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                </ul>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'fieldname', array('class' => 'control-label col-sm-3')); ?>
                <div class="col-sm-9">
                    <?php echo $form->textField($model, 'fieldname', array('size' => 15, 'maxlength' => 20, 'class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'fieldname', array('class' => 'label label-danger')); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'longname', array('class' => 'control-label col-sm-3')); ?>
                <div class="col-sm-9">
                    <?php echo $form->textField($model, 'longname', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'longname', array('class' => 'label label-danger')); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'position', array('class' => 'control-label col-sm-3')); ?>
                <div class="col-sm-9">                
                    <?php echo $form->textField($model, 'position', array('size' => 5, 'maxlength' => 3, 'class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'position', array('class' => 'label label-danger')); ?>
                </div>
            </div>
            <div class="form-group">

                <label class="control-label col-sm-3">Opciones

                </label>
                <div class="col-sm-9">
                    <div class="checkbox">
                        <label>
                            <?php echo $form->checkBox($model, 'required'); ?>
                            <?php echo $form->labelEx($model, 'required', array('class' => 'control-label col-sm-7')); ?>
                            <?php echo $form->error($model, 'required', array('class' => 'label label-danger')); ?>
                            <!--<input type="checkbox" name="checkbox">Lorem ipsum dolor.-->
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <?php echo $form->checkBox($model, 'showinreports'); ?>
                            <?php echo $form->labelEx($model, 'showinreports', array('class' => 'control-label col-sm-7')); ?>
                            <?php echo $form->error($model, 'showinreports', array('class' => 'label label-danger')); ?>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">

            <div class="breadcrumbs">
                <ul>
                    <li>
                        <a href="#"> <?php echo ucfirst(CrugeTranslator::t("datos del contenido")); ?></a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                </ul>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'fieldtype', array('class' => 'control-label col-sm-3')); ?>
                <div class="col-sm-9">                
                    <?php echo $form->dropDownList($model, 'fieldtype', Yii::app()->user->um->getFieldTypeOptions(), array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'fieldtype', array('class' => 'label label-danger')); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'maxlength', array('class' => 'control-label col-sm-3')); ?>
                <div class="col-sm-9">                
                    <?php echo $form->textField($model, 'maxlength', array('size' => 8, 'maxlength' => 20, 'class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'maxlength', array('class' => 'label label-danger')); ?>
                    <i><?php echo CrugeTranslator::t("maxlength = -1 causa que no se valide el tamano de este campo"); ?></i>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'predetvalue', array('class' => 'control-label col-sm-3')); ?>                 
                <div class="col-sm-9">                
                    <?php
                    echo $form->textArea($model, 'predetvalue', array('rows' => 5, 'cols' => 40, 'class' => 'form-control', 'rel' => 'popover',
                        'data-trigger' => 'hover', 'data-html' => true,
                        'title' => 'Ayuda', 'data-placement' => 'top', 'data-content' => 'Si el Tipo de campo es un Lista, ponga aqui las opciones una por cada linea,
                                        el valor coloquelo al inicio seguido de una coma, ejemplo:
                                        <ul style="list-style: none;">
                                        <li>1, azul</li>
                                        <li>2, rojo</li>
                                        <li>3, verde</li>
                                        </ul>'));
                    ?>

                    <?php echo $form->error($model, 'predetvalue', array('class' => 'label label-danger')); ?>
                </div>
            </div>

        </div>
        <div class="">
            <div class="breadcrumbs">
                <ul>
                    <li>
                        <a href="#"> <?php echo ucfirst(CrugeTranslator::t("datos de validacion")); ?></a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                </ul>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'useregexp', array('class' => 'control-label col-sm-3')); ?>
                <div class="col-sm-9">                       
                    <?php
                    echo $form->textArea($model, 'useregexp', array('rows' => 5, 'cols' => 40, 'class' => 'form-control', 'rel' => 'popover',
                        'data-trigger' => 'hover', 'data-html' => true,
                        'title' => 'Ayuda', 'data-placement' => 'top',
                        'data-content' => 'Dejar en blanco si no se quiere usar <br/>'
                        . 'La expresion regular (regexp) es una lista de caracteres
				 que validan la sintaxis de lo que el usuario ingrese en este campo.
				 por ejemplo:
                                 <br/><u>Telefono: </u><br/>^([0-9-.+ \(\)]{3,20})$
                                 <br/><u>Digitos y letras: </u><br/>^([a-zA-Z0-9]+)$
                                 '));
                    ?>

                    <?php echo $form->error($model, 'useregexp'); ?>                   
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'useregexpmsg', array('class' => 'control-label col-sm-3')); ?>
                <div class="col-sm-9">                
                    <?php echo $form->textField($model, 'useregexpmsg', array('size' => 50, 'maxlength' => 512, 'class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'useregexpmsg', array('class' => 'label label-danger')); ?>

                </div>
            </div>            
        </div>
        <div class="">
            <div class="form-actions col-sm-offset-2 col-sm-12">
                <?php Yii::app()->user->ui->tbutton(($model->isNewRecord ? "Crear Campo" : "Actualizar Campo")); ?>                
            </div>


        </div>

        <?php echo $form->errorSummary($model); ?>
        <?php $this->endWidget(); ?>
    </div>
</div>
