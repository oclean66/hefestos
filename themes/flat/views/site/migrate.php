<style>
    #main{
        margin-left: 0;
    }
</style>
<div class="col-sm-12">
    <div class="box box-bordered box-color">
        <div class="box-title">
            <h3>
                <i class="fa fa-th-list"></i>Migrar 2.0</h3>
        </div>
        <div class="box-content">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array('class' => 'form-horizontal form-bordered'),
            ));
            ?>
            <div class="form-group">
                <label for="textfield" class="control-label">Codigo de Agencia: <?php echo " " . $dato; ?></label>


                <div class="input-group input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-search"></i>
                    </span>
                    <?php
                    $bool = "";
//                    if ($agencia['idagencia'] != "" && $agencia['idagencia'] != "No encontrada") {
//                        $bool = "readonly";
//                    }

                    echo CHtml::textField('cod', $agencia['idagencia'], array('autocomplete' => 'off', 'placeholder' => "Codigo de Agencia", 'class' => 'form-control', 'readonly' => $bool));
                    echo CHtml::textField('gr', $agencia['codgrupo'], array('autocomplete' => 'off', 'placeholder' => "Codigo de grupo", 'class' => 'form-control', 'readonly' => $bool));
                    echo CHtml::dropDownList('banca', $agencia['idbanca'], array('1'=>'Banca: 001 - XXX','202'=>'Banca: 202 - Fon'), array('empty' => 'Sin Banca',  'class' => 'select2-me','style'=>'width:100%'));
                    ?> 
                    <?php if ($bool != "readonly") {
                        ?>
                        <div class="input-group-btn">
                            <button class="btn btn-primary" style="height: 100%" type="submit">Buscar</button>
                        </div>
                    <?php }
                    ?>

                </div>
            </div>
            <?php if ($agencia['idagencia'] != "" && $agencia['idagencia'] != "No encontrada") {
                ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2">Grupo</label>
                            <div class="col-sm-10">
                                <?php
                                echo CHtml::dropDownList('GCCD_Id', 'GCCD_Id', CHtml::listData(Gccd::model()->findAll('1 order by GCCD_Cod'), 'GCCD_Id', 'concatened'), array('empty' => 'Sin Grupo', 'options' => array($agencia['idgrupo'] => array('selected' => true)), 'class' => 'select2-me','style'=>'width:100%; background-color: rgba(240, 128, 128, 0.490196);'));
                                ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2">Nombre</label>
                            <div class="col-sm-10">
                                <?php echo CHtml::textField('nombre', $agencia['nombre'], array('class' => 'form-control ')); ?> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label col-sm-2">RIF</label>
                            <div class="col-sm-10">
                                <?php echo CHtml::textField('rif', $agencia['cedula'], array('class' => 'form-control ')); ?> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label col-sm-2">Direccion</label>
                            <div class="col-sm-10">
                                <?php echo CHtml::textField('direccion', $agencia['direccion'], array('class' => 'form-control ')); ?> 
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2">Responsable</label>
                            <div class="col-sm-10">
                                <?php echo CHtml::textField('responsable', $agencia['responsable'], array('class' => 'form-control ')); ?> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label col-sm-2">Telefono</label>
                            <div class="col-sm-10">
                                <?php echo CHtml::textField('telefono', $agencia['telefono'], array('class' => 'form-control ')); ?> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label col-sm-2">E-mail</label>
                            <div class="col-sm-10">
                                <?php echo CHtml::textField('email', $agencia['email'], array('class' => 'form-control ')); ?> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="summary" style="float: right;">Desplegando <?php echo count($inventario); ?> resultados.</div>
                <table class="table table-hover table-nomargin">
                    <thead>
                        <tr>
                            <th>Fecha Prestamo </th>
                            <th>Serial</th>
                            <th>Modelo</th>
                            <th>Transaccion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($inventario as $value) {
                            ?>
                            <tr>
                                <td><label>
                                        <input id="item[<?php echo $value['idcomputador'] ?>]" class='checkbox_check' type="checkbox"
                                               name="checkbox[<?php echo $value['idcomputador'] ?>]"> <?php echo date("d-m-Y h:ia", strtotime($value['fechaprestamo'])) ?>
                                    </label>
                                </td>
                                <td><?php
                    $con = Yii::app()->excelencia->createCommand("select IMEI from conexion where idconexion = '" . $value['idconexion'] . "'")->queryRow();
                    echo $con['IMEI'] . $value['iditem'];
                            ?>
                                </td>
                                <td>
                                    <?php
                                    echo CHtml::dropDownList('FCCT_Id[' . $value['idcomputador'] . ']', 'FCCT_Id[' . $value['idcomputador'] . ']', CHtml::listData(Fcct::model()->findAll('1 order by FCCT_Descripcion'), 'FCCT_Id', 'concatened'), array('empty' => 'Sin modelo', 'options' =>
                                        array($value['modelo_idmodelo'] => array('selected' => true)), 'class' => 'select2-me','style'=>'width:100%;'));
                                    ?>
                                </td>
                                <td><?php echo $value['idtransaccion'] ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>


                <div class="form-actions">
                    <button id='submit' class="btn btn-primary disabled" type="submit">Migrar</button>
                    <div class="btn-group">
                        <a href="migrate" class="btn"> Reiniciar </a>
                    </div>

                </div>
            <?php }
            ?>

            <?php
            $this->endWidget();
            echo $notas;
            ?>

        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function ($) {
        console.log("Doc listo");
        var target = $('.select2-chosen').each(function () {

            if ($(this).html() == "Sin modelo" || $(this).html() == "0001 - XXX"  ) {

                $(this).parent().css("background-color", "rgba(240, 128, 128, 0.49)");

                $(this).focusin(function () {
                    $(this).parent().css("background-color", "rgba(240, 128, 128, 0)");
                });

                $(this).focusout(function () {
                    console.log("saliendo")
                    if ($(this).html() == 'Sin modelo')
                        $(this).parent().css("background-color", "rgba(240, 128, 128, 0.49)");
                    else
                        $(this).parent().css("background-color", "rgba(240, 128, 128, 0)");
                });

            }
            
            
        });
    });


  $('.select2-chosen').focusout(function () {
                    console.log("saliendo")
                    if ($(this).html() == 'Sin modelo')
                        $(this).parent().css("background-color", "rgba(240, 128, 128, 0.49)");
                    else
                        $(this).parent().css("background-color", "rgba(240, 128, 128, 0)");
                });

//    if (target == "add")
//        $("#add").show(selectedEffect, options, 500, callback);
//    else if ($('#target option:selected').text() == "exit")
//        $("#exit").show(selectedEffect, options, 500, callback);
//    else if ($('#target option:selected').text() == "refuse")
//        $("#refuse").show(selectedEffect, options, 500, callback);


    $("input.checkbox_check").change(function () {
        console.log("cambio");
        var bool = 1;
        $("input.checkbox_check").each(function () {
            // console.log(this);
            if (this.checked) {
                //console.log(this);
                bool = bool * 0;
            } else {
                bool = bool * 1;
            }
        });
        if (bool == 0) {
            //Do stuff
            $('#submit').removeClass("disabled");
        } else {
            $('#submit').addClass("disabled");
        }




    });

</script>