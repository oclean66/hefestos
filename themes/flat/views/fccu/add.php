<style>
    @media (min-width:972px) {
        .add {
            width: 25.3%;
            display: inline;
            margin-right: 9px;
        }

        .add-hall {
            width: 20%;
            display: inline;
            margin-right: 9px;
        }

        .add-group {
            width: 10%;
            display: inline-table;
            top: 10px;
            margin-right: 9px;
        }

        .add-label {
            margin-right: 4px;
        }
    }
</style>
<style>
    #main {
        margin-left: 0px;
    }

    .sidebar-fixed {
        display: none;
    }
</style>
<?php
/* @var $this FccuController */
/* @var $model Fccu */
/* @var $form CActiveForm */

?>
<div class="col-sm-12">
    <div class="box box-bordered box-color">
        <div class="box-title">
            <h3 id="serialC">
                <i class="fa fa-th-list"></i>Agregar Activo
            </h3>
        </div>
        <div class="box-content nopadding">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'fccu-form', //este envia todos los registros de la lista
                'enableAjaxValidation' => false,
                'htmlOptions' => array(
                    'onsubmit' => "return false;",

                    'class' => 'form-horizontal form-bordered'
                ),
            ));
            ?>
            <!--row1-->
            <div class="" id='row1'>
                <!--categoria-->
                <div class="col-sm-6 nopadding">

                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Categoria</label>
                        <div class="col-sm-10">
                            <?php
                            echo CHtml::dropDownList(
                                'Fccu[FCUU_Id]',
                                'Fccu[FCUU_Id]',
                                CHtml::listData(Fcuu::model()->findAll(), 'FCUU_Id', 'FCUU_Descripcion'),
                                array(
                                    'class' => 'select2-me', 'style' => 'width:100%', 'prompt' => 'Seleccione una Categoria...',
                                    'ajax' => array(
                                        'type' => 'POST',
                                        'url' => CController::createUrl('fcuu/Rellenarmodos'),
                                        'update' => '#tipo,#Fccu_FCCA_Id_Master',
                                        'beforeSend' => 'function(){
                                                var select = document.getElementById("tipo");    				
                                                select.options.length = 0;
                                                select.options[select.options.length] = new Option("Cargando...", "");}',
                                    )
                                )
                            );
                            ?>
                        </div>
                    </div>


                </div>
                <!--lugar-->
                <div class="col-sm-6 nopadding">

                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Lugar</label>
                        <div class="col-sm-10">
                            <?php
                            echo CHtml::dropDownList('Fccu[FCCI_Id]', 'Fccu[FCCI_Id]', CHtml::listData(Fcci::model()->findAll(), 'FCCI_Id', 'FCCI_Descripcion'), array('empty' => 'Selecciona', 'class' => 'select2-me', 'style' => 'width:100%'));
                            ?>
                        </div>
                    </div>


                </div>
            </div>

    
            <!--row2-->
            <div class=" hidden" id='row2'>
                <!--operador-->
                <div class="col-sm-6 nopadding">

                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Operador</label>
                        <div class="col-sm-10">
                            <?php
                            echo CHtml::dropDownList('Fccu[FCCD_Id]', 'Fccu[FCCD_Id]', CHtml::listData(Fccd::model()->findAll(), 'FCCD_Id', 'FCCD_Descripcion'), array('class' => 'select2-me', 'style' => 'width:100%', 'prompt' => 'Seleccione un Operador...'));
                            ?>
                        </div>
                    </div>


                </div>
                <!--servicio-->
                <div class="col-sm-6 nopadding">

                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Servicio</label>
                        <div class="col-sm-10">
                            <?php
                            echo CHtml::dropDownList('Fccu[FCCU_TipoServicio]', 'Fccu[FCCU_TipoServicio]', array('0' => 'No Posee', '1' => 'Pre-Pago', '2' => 'Corporativa'), array('empty' => 'Selecciona Servicio', 'class' => 'select2-me', 'style' => 'width:100%',));
                            ?>
                        </div>
                    </div>


                </div>
            </div>
            <!--row3-->
            <div class=" hidden" id='row3'>
                <!--Tipo-->
                <div class="col-sm-6 nopadding">
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Tipo</label>
                        <div class="col-sm-10">
                            <?php
                            echo CHtml::dropDownList('Fccu[FCCA]', 'Fccu[FCCA]', CHtml::listData(Fcca::model()->findAll(), 'FCCA_Id', 'FCCA_Descripcion'), array(
                                'class' => 'select2-me', 'style' => 'width:100%', 'id' => 'tipo',
                                'ajax' => array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('fccu/Rellenarmodos'),
                                    // 'success' => 'function(data){ console.log(data); }',
                                    'update' => '#modelo',
                                    'beforeSend' => 'function(){
                                            var select = document.getElementById("modelo");    				
                                            select.options.length = 0;
                                            select.options[select.options.length] = new Option("Cargando...", "");}',
                                ),
                                'prompt' => 'Seleccione un Tipo...'
                            ));
                            ?>


                        </div>
                    </div>


                </div>
                <!--Modelo-->
                <div class="col-sm-6 nopadding">
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Modelo</label>
                        <div class="col-sm-10">
                            <?php echo CHtml::dropDownList('Fccu[FCCT_Id]', 'Fccu[FCCT_Id]', array(), array('id' => 'modelo', 'empty' => 'Selecciona', 'class' => 'select2-me', 'style' => 'width:100%')); ?>

                        </div>
                    </div>


                </div>
            </div>
            <!--lote   1 (master)  -->
            <div id="master" class=' hidden'>
                <div class="col-sm-12 nopadding" style="margin-bottom: 0px; margin-top:0px">

                    <div class="col-sm-6 nopadding">
                        <div class="form-group nopadding">
                            <?php echo CHtml::label('Tipo', 'Tipo', array('class' => 'control-label add-label col-sm-2')); ?>
                            <div class="col-sm-10">
                                <?php
                                echo CHtml::dropDownList(
                                    'Fccu[FCCA_Id_Master]',
                                    'Fccu[FCCA_Id_Master]',
                                    CHtml::listData(Fcca::model()->findAll(), 'FCCA_Id', 'FCCA_Descripcion'),
                                    array(
                                        'class' => 'select2-me', 'style' => 'width:25.3% !important;background-color:blue;',
                                        'ajax' => array(
                                            'type' => 'POST',
                                            'url' => CController::createUrl('fccu/Rellenar'),
                                            // 'success' => 'function(data){ console.log(data); }',
                                            'update' => '#Fccu_FCCT_Id_Master',
                                            // 'success'=>'function(){ 
                                            // var select = document.getElementById("Fccu_FCCT_Id");                   
                                            //     select.prop("disabled", "disabled");
                                            // }',
                                            'beforeSend' => 'function(){
                                                    
                                                    var select = document.getElementById("Fccu_FCCT_Id");    				
                                                    select.options.length = 0;
                                                    // select.prop("disabled", "disabled");
                                                    select.options[select.options.length] = new Option("Cargando...", "");}',
                                        ),
                                        'prompt' => 'Seleccione un Tipo...'
                                    )
                                );
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 nopadding">
                        <div class="form-group">
                            <?php echo CHtml::label('Modelo', 'Modelo', array('class' => 'control-label add-label col-sm-2')); ?>
                            <div class="col-sm-10">
                                <?php echo CHtml::dropDownList('Fccu[FCCT_Id_Master]', 'Fccu[FCCT_Id_Master]', array(), array('empty' => 'Selecciona', 'class' => 'select2-me', 'style' => 'width:25.3% !important')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 nopadding" style="margin-top:0px; margin-bottom: 10px; padding: 0% 5%">
                        <div class="form-group">
                            <?php echo CHtml::label('Serial', 'Serial', array('class' => 'control-label add-label col-sm-1')); ?>
                            <div class="col-sm-11">
                                <div class="input-group">
                                    <?php echo CHtml::textField(
                                        'Fccu[FCCU_Serial_Master]',
                                        '',
                                        array(
                                            'placeholder' => 'Codigo de Barras', 'class' => 'form-control add ',
                                            'id' => 'serial_master', 'size' => 45, 'maxlength' => 45
                                        )
                                    ); ?>
                                    <div class="input-group-btn">
                                        <button class="btn btn-success " onclick="add('master')" type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-sm-6" style="margin-bottom: 0px; margin-top:0px;">
                        <div class="form-group">
                            <?php //echo CHtml::label('Serial', 'Serial', array('class' => 'control-label add-label col-sm-2')); 
                            ?>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" placeholder="Codigo de Barras" class="form-control add" id="serial_master" size="45" maxlength="45" style="width: 100%;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-success" onclick="add('master')" type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                             <div class="col-sm-10">
                                <?php /*echo CHtml::textField(
                                    'Fccu[FCCU_Serial_Master]',
                                    '',
                                    array(
                                        'placeholder' => 'Codigo de Barras', 'class' => 'form-control add ',
                                        'id' => 'serial_master', 'size' => 45, 'maxlength' => 45, 'style' => 'width:100%'
                                    )
                                ); */ ?>
                            </div>  
                        </div>
                    </div>  -->
                    <!-- <div class="col-sm-6">
                        <div class="form-group">
                            <button class="btn btn-success btn-large" onclick="add('master')" type="button">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div> -->

                </div>
            </div>
            <!--lote    2 (hall)  -->
            <div id="hall" class='hidden'>
                <div class="col-sm-12 nopadding" style="margin-top:0px; margin-bottom: 10px;">
                    <div class="col-sm-3 nopadding">
                        <div class="form-group">
                            <?php echo CHtml::label('Serial', 'Serial', array('class' => 'control-label add-label col-sm-2 ')); ?>
                            <div class="col-sm-10">
                                <?php echo CHtml::textField(
                                    'Fccu[FCCU_Serial_Hall]',
                                    '',
                                    array(
                                        'placeholder' => 'Serial/IMEI/SN', 'class' => 'form-control ',
                                        'id' => 'serial_hall', 'size' => 45, 'maxlength' => 45
                                    )
                                ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 nopadding">
                        <div class="form-group">
                            <?php echo CHtml::label('Numero', 'Numero', array('class' => 'control-label add-label col-sm-2')); ?>
                            <div class="col-sm-10">
                                <?php
                                echo CHtml::textField('Fccu[FCCU_Numero]', '', array(
                                    'placeholder' => 'Numero de telefono',
                                    'class' => 'form-control', 'id' => 'numero', 'size' => 45, 'maxlength' => 45
                                ));
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 nopadding">
                        <?php echo CHtml::label('Monto', 'Monto', array('class' => 'control-label add-label')); ?>

                        <div class="input-group add-group">
                            <?php
                            echo CHtml::textField('Fccu[FCCU_MontoMin]', '', array(
                                'placeholder' => '0', 'id' => 'monto',
                                'class' => 'form-control ', 'size' => 45, 'maxlength' => 45
                            ));
                            ?>
                            <span class="input-group-addon">Bs</span>
                        </div>


                    </div>
                    <div class="col-sm-3 nopadding">

                        <?php echo CHtml::label('Vence', 'Vence', array('class' => 'control-label add-label')); ?>

                        <div class="input-group add-group">
                            <?php echo CHtml::textField('Fccu[FCCU_DiaCorte]', '', array('placeholder' => '0', 'id' => 'renta', 'class' => 'form-control add', 'size' => 45, 'maxlength' => 45)); ?>
                            <span class="input-group-addon">c/mes</span>
                        </div>


                        <button class="btn btn-success" onclick="add('hall')" type="button">
                            <i class="fa fa-plus"></i>
                        </button>


                    </div>
                </div>
            </div>

            <!--Table-->
            <table class="table table-hover table-nomargin" style="padding-top: 5px" id="myTable">
                <thead>
                    <tr>
                        <th># Serial</th>


                    </tr>
                </thead>
                <tbody id="padre">
                </tbody>
            </table>
            <!--Botones-->
            <div class="form-actions">
                <button type="button" id='btn' class="btn btn-primary">Guardar</button>
                <?php //echo CHtml::submitButton('Guardar', array('id' => 'btn', 'class' => 'btn btn-primary'));   
                ?>
                <button type="button" class="btn" onclick="cleaner()">Limpiar</button>
            </div>



            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
<!--elemto hijo master-->
<table class="hidden">
    <tbody id="row_master">
        <tr>
            <td> <?php echo CHtml::textField('Fccu[FCCU_Serial][]', '', array('class' => 'form-control ', 'size' => 45, 'maxlength' => 45)); ?></td>
            <td>
                <?php echo CHtml::dropDownList('Fccu[FCCA_Id][]', 'Fccu[FCCA_Id][]', array(), array('class' => 'form-control ')); ?>
            </td>
            <td>
                <?php echo CHtml::dropDownList('Fccu[FCCT_Id][]', 'Fccu[FCCT_Id][]', array(), array('class' => 'form-control ')); ?>
            </td>
            <td>
                <button id='del' class="btn btn-danger" onclick="delt($(this).parent().parent())" type="button">
                    <i class="fa fa-minus"></i>
                </button>
            </td>
        </tr>
    </tbody>
</table>
<!--elemto hijo hall-->
<table class="hidden">
    <tbody id="row_hall">
        <tr>
            <td> <?php echo CHtml::textField('Fccu[FCCU_Serial][]', '', array('placeholder' => '0', 'class' => 'form-control ', 'size' => 45, 'maxlength' => 45)); ?></td>
            <td> <?php echo CHtml::textField('Fccu[FCCU_Numero][]', '', array('placeholder' => 'Sin Numero', 'class' => 'form-control ', 'size' => 45, 'maxlength' => 45)); ?></td>
            <td> <?php echo CHtml::textField('Fccu[FCCU_MontoMin][]', '', array('placeholder' => 'No aplica', 'class' => 'form-control ', 'size' => 45, 'maxlength' => 45)); ?></td>
            <td> <?php echo CHtml::textField('Fccu[FCCU_DiaCorte][]', '', array('placeholder' => 'No aplica', 'class' => 'form-control ', 'size' => 45, 'maxlength' => 45)); ?></td>
            <td>
                <button id='del' class="btn btn-danger" onclick="delt($(this).parent().parent())" type="button">
                    <i class="fa fa-minus"></i>
                </button>
            </td>
        </tr>
    </tbody>
</table>

<!--script-->
<script type="text/javascript">
    $("#serial_master").keyup(function(data) {
        // alert(data.keyCode);
        if (data.keyCode === 13) {
            add('master');
        }
        //console.log(data.keyCode);
    });
    $("#serial_hall").keyup(function(data) {
        // alert(data.keyCode);
        if (data.keyCode === 13) {
            add('hall');
        }
        //console.log(data.keyCode);
    });

    $("#Fccu_FCUU_Id").change(function(data) {
        cleaner();

        if ($("#Fccu_FCUU_Id option:selected").val() != '2') {
            $('#row2').addClass('hidden');
            $('#row3').addClass('hidden');
            $('#hall').addClass('hidden');
            $('#master').removeClass('hidden');

            $("#myTable thead tr th").remove();
            $("#myTable thead tr").append("<th>#Serial</th>");
            $("#myTable thead tr").append("<th>Tipo</th>");
            $("#myTable thead tr").append("<th>Modelo</th>");

            $("#myTable thead tr").append("<th>Acciones</th>");
        } else if ($("#Fccu_FCUU_Id option:selected").val() == '2') {
            $('#row2').removeClass('hidden');
            $('#row3').removeClass('hidden');
            $('#hall').removeClass('hidden');
            $('#master').addClass('hidden');

            $("#myTable thead tr th").remove();
            $("#myTable thead tr").append("<th>#Serial</th>");
            $("#myTable thead tr").append("<th>Num Telefonico</th>");
            $("#myTable thead tr").append("<th>Monto</th>");
            $("#myTable thead tr").append("<th>Vence</th>");
            $("#myTable thead tr").append("<th>Acciones</th>");

        } else {
            $('#row2').addClass('hidden');
            $('#row3').addClass('hidden');
            $('#hall').addClass('hidden');
            $('#master').addClass('hidden');
        }

        console.log($("#Fccu_FCUU_Id option:selected").val());
    });

    var master = $('#row_master').html();
    var hall = $('#row_hall').html();
    var i = 0;


    function add(tipo) {
        if (tipo == "master") {
            var FccuSerial = $('#master').find('#serial_master').val();
            var FccuTipo = $('select#Fccu_FCCA_Id_Master option:selected').sort().clone();
            var FccuModel = $('select#Fccu_FCCT_Id_Master option:selected').sort().clone();
            var Lugar = $('select#Fccu_FCCI_Id option:selected').sort().clone();
            console.log(Lugar.val());
            if (FccuSerial != '' && FccuTipo.val() != '' && FccuModel.val() != '' && Lugar.val() != '') {
                i++;
                $('#serialC').html('<i class="fa fa-th-list"></i>Agregar Equipos  (' + i + ") Elementos agregados");
                $('#padre').prepend(master);

                $('#padre').find('#Fccu_FCCU_Serial').attr('id', 'Fccu_FCCU_Serial' + i);
                $('#padre').find('#Fccu_FCCU_Serial' + i).val(FccuSerial);

                $('#padre').find('#Fccu_FCCA_Id').attr('id', 'Fccu_FCCA_Id' + i);
                $('select#Fccu_FCCA_Id' + i).append(FccuTipo);
                // $('#padre').find('#Fccu_FCCA_Id' + i).val(FccuTipo);

                $('#padre').find('#Fccu_FCCT_Id').attr('id', 'Fccu_FCCT_Id' + i);
                $('select#Fccu_FCCT_Id' + i).append(FccuModel);
                // $('#padre').find('#Fccu_FCCT_Id' + i).val(FccuModel);

                $('#master').find('#serial_master').val('');
            }

        } else if (tipo == 'hall') {

            var FccuSerial = $('#hall').find('#serial_hall').val();
            var FccuMonto = $('#hall').find('#monto').val();
            var FccuRenta = $('#hall').find('#renta').val();
            var FccuNumero = $('#hall').find('#numero').val();

            if (FccuSerial != '') {
                i++;
                $('#serialC').html('<i class="fa fa-th-list"></i>Agregar Equipos  (' + i + ") Elementos agregados");
                $('#padre').prepend(hall);

                $('#padre').find('#Fccu_FCCU_Serial').attr('id', 'Fccu_FCCU_Serial' + i);
                $('#padre').find('#Fccu_FCCU_Serial' + i).val(FccuSerial);

                $('#padre').find('#Fccu_FCCU_Numero').attr('id', 'Fccu_FCCU_Numero' + i);
                $('#padre').find('#Fccu_FCCU_Numero' + i).val(FccuNumero);

                $('#padre').find('#Fccu_FCCU_MontoMin').attr('id', 'Fccu_FCCU_MontoMin' + i);
                $('#padre').find('#Fccu_FCCU_MontoMin' + i).val(FccuMonto);

                $('#padre').find('#Fccu_FCCU_DiaCorte').attr('id', 'Fccu_FCCU_DiaCorte' + i);
                $('#padre').find('#Fccu_FCCU_DiaCorte' + i).val(FccuRenta);





                $('#hall').find('#serial_hall').val('');
                $('#hall').find('#numero').val('');
                $('#hall').find('#monto').val('');
                $('#hall').find('#renta').val('');
            }

        }




    }

    function delt(id) {
        i--;
        id.remove();
        $('#serialC').html('<i class="fa fa-th-list"></i>Agregar Equipos  (' + i + ") Elementos agregados");
        //console.log(id);
    }

    function cleaner() {
        $('#padre').children().remove();
        i = 0;
        $('#serialC').html('<i class="fa fa-th-list"></i>Agregar Equipos');
        $('select#Fccu_FCCA_Id').val(0);
        $('select#Fccu_FCCT_Id').val(0);

    }

    $("#btn").click(function() {
        console.log(i + " Registros para guardar");
        if (i > 0) {
            var data = $("#fccu-form").serialize();

            $.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->createAbsoluteUrl("fccu/add"); ?>',
                data: data,
                success: function(data) {
                    console.log(data);
                    if (data !== 'error') {
                        $.gritter.add({
                            position: 'bottom-left',
                            // (string | mandatory) the heading of the notification
                            title: 'Actualizacion Completada',
                            sticky: true,
                            time_alive: 1000,
                            // (string | mandatory) the text inside the notification
                            text: data,
                        });
                        $('#padre').children().remove();
                        i = 0;

                    }
                },
                error: function(data) { // if error occured
                    if (data.status === 401) {
                        bootbox.alert('Operacion no completada, Se perdio la sesion');
                        $(location).attr('href', '/hefestos/site');
                    }
                    console.log(data);
                },
                dataType: 'html'
            });

        }

    });
</script>