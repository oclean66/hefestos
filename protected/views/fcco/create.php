<style>

    @media (min-width:972px){
        .add {
            width: 90%;
            display: inline;
            margin-right: 9px;
        }
    } 


</style>

<?php
/* @var $this FccoController */
/* @var $model Fcco */
/* @var $form CActiveForm */
?>

<div class="col-sm-12">
    <div class="box box-bordered box-color">
        <div class="box-title">
            <h3><i class="fa fa-th-list"></i> #<?php echo $lote." - "; ?></h3>
            <h3  id="serialC"> Asignar Activos</h3>              
        </div>
        <!--content-->
        <div class="box-content nopadding" >

            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'fcco-form', //este envia todos los registros de la lista
                'enableAjaxValidation' => false,
                'htmlOptions' => array(
                    'onsubmit' => "return false;",
                    'class' => 'form-horizontal form-bordered'),
            ));
            ?>

            <!--GCCD/GCCA-->
            <div class="row">
                <div class="col-sm-6">

                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Grupo</label>
                        <div class="col-sm-10">
                            <?php
                            echo CHtml::dropDownList('Fcco[GCCD_Id]', 'Fcco[GCCD_Id]', CHtml::listData(Gccd::model()->findAll('1 order by GCCD_Nombre'), 'GCCD_Id', 'concatened'), 
                                    array('class' => 'select2-me','style'=>'width:100%',
                                'ajax' => array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('gccd/Rellenarmodos'),
                                    'update' => '#' . CHtml::activeId($model, 'GCCA_Id'),
                                    'beforeSend' => 'function(){                            
                                        var select = document.getElementById("Fcco_GCCA_Id");    				
                                        select.options.length = 0;
                                        select.options[select.options.length] = new Option("Cargando...", "");
                                    }',
                                ),
                                'prompt' => 'Seleccione un Grupo...'));
                            ?>
                        </div>
                    </div>


                </div>
                <div class="col-sm-6">

                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-2">Agencia</label>
                        <div class="col-sm-10">
                            <?php echo CHtml::dropDownList('Fcco[GCCA_Id]', 'Fcco[GCCA_Id]', array(), array('empty' => 'Selecciona', 'class' => 'select2-me','style'=>'width:100%'));
                            ?>
                        </div>
                    </div>


                </div>
            </div>

            <!--Serial-->
            <div id="master" style="    border-top: 1px solid gainsboro;">
                <div class="col-sm-12" style="margin-top:10px; margin-bottom: 10px;">
                    <?php echo CHtml::label('Serial', 'Serial', array('class' => 'control-label ')); ?>

                    <?php
                    echo CHtml::hiddenField('id', '');
                    echo CHtml::hiddenField('descrip', '');
                    ?>

                    <div class="input-group input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-search"></i>
                        </span>
                        <?php
                        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name' => 'serial',
                            // additional javascript options for the autocomplete plugin
                            'options' => array(
                                'minLength' => '1',
                                'autoFocus' => true,
                                'select' => "js:function(event, ui) { 
                                    $('#id').val(ui.item.id);                                    
                                    $('#descrip').val(ui.item.descrip); 

                            }"
                            ),
                            'source' => $this->createUrl("activos"),
                            'htmlOptions' => array(
                                'class' => 'form-control add',
                            ),
                        ));
                        ?> 

                        <div class="input-group-btn">
                            <button class="btn btn-primary" onclick="add()" type="button">Buscar</button>
                        </div>


                    </div>




<!--                    <button class="btn btn-success" onclick="add()" type="button">
                        <i class="fa fa-plus"></i>
                    </button>-->


                </div>
            </div>
            <!--Table visible-->
            <table class="table table-hover table-nomargin" style="padding-top: 5px">
                <thead>
                    <tr>
                        <th># Serial</th>
                        <th>Descripcion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="padre">
                </tbody>
            </table>
            <!--botones-->
            <div class="form-actions">
                <?php echo CHtml::submitButton('Guardar y confirmar', array('onclick' => 'reallySubmit(this,2)', 'id' => 'btn', 'class' => 'btn btn-success',)); ?>
                <?php echo CHtml::submitButton('Solo Guardar', array('onclick' => 'reallySubmit(this,1)', /* 'submit' => 'create/1', */ 'id' => 'btn', 'class' => 'btn btn-primary',)); ?>
                <button type="button" class="btn btn-inverse" onclick="cleaner()">Limpiar</button>
              
            </div>



            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
<!--tabla oculta-->
<table class="hidden">
    <tbody id="row">                
        <tr>
            <?php echo CHtml::hiddenField('Fcco[FCCU_Id][]', ''); ?>
            <td> <?php echo CHtml::textField('Fcco[FCCU_Serial][]', '', array('readonly' => 'readonly', 'class' => 'form-control ', 'size' => 45, 'maxlength' => 45)); ?></td>
            <td> <?php echo CHtml::textField('label', '', array('readonly' => 'readonly', 'class' => 'form-control ', 'size' => 45, 'maxlength' => 45)); ?> </td>

            <td> 
                <button id='del' class="btn btn-danger" onclick="delt($(this).parent().parent())" type="button">
                    <i class="fa fa-minus"></i>
                </button>
            </td>
        </tr>                                                      
    </tbody>
</table>
<!--Scripts-->
<script type="text/javascript">

    $("#serial").keyup(function (data) {
        //alert(data.keyCode);
        if (data.keyCode === 13) {
            add();
        }
        console.log($("ul#ui-id-1 li").first().children().html());

    });

    var hijo = $('#row').html();
    var i = 0;


    function add()
    {
        var FccuId = $('#master').find('#id').val();
        var FccuSerial = $('#master').find('#serial').val();
        var descrip = $('#descrip').val();


        if (FccuSerial != '' && FccuId != '' && descrip != '') {
            i++;
            $('#serialC').html('<i class="fa fa-th-list"></i>Asignar Equipos  (' + i + ") Elementos agregados");
            $('#padre').prepend(hijo);

            $('#padre').find('#Fcco_FCCU_Id').attr('id', 'Fcco_FCCU_Id' + i);
            $('#padre').find('#Fcco_FCCU_Id' + i).val(FccuId);

            $('#padre').find('#Fcco_FCCU_Serial').attr('id', 'Fcco_FCCU_Serial' + i);
            $('#padre').find('#Fcco_FCCU_Serial' + i).val(FccuSerial);

            $('#padre').find('#label').attr('id', 'label' + i);
            $('#padre').find('#label' + i).val(descrip);

            $('#master').find('#serial').val('');


        }



    }
    function delt(id)
    {
        i--;
        id.remove();
        $('#serialC').html('<i class="fa fa-th-list"></i>Asignar Equipos  (' + i + ") Elementos agregados");
        //console.log(id);
    }
    function cleaner() {
        $('#padre').children().remove();
        i = 0;
        $('#serialC').html('<i class="fa fa-th-list"></i>Asignar Equipos');
        $('select#Fccu_FCCA_Id').val(0);
        $('select#Fccu_FCCT_Id').val(0);

    }
    function reallySubmit(e, f) {
        console.log(e);
        $.gritter.add({
            position: 'bottom-left',
            title: 'Atencion',
            sticky: false,
            time_alive: 500,
            text: "Funciona",
        });
//        self.submit("create/"+f);        
    }
    jQuery("#fcco-form").submit(function (e) {
        var self = this;
        //console.log(this);
        e.preventDefault();
        // console.log(i);
        if ($('#Fcco_GCCD_Id option:selected').val() == "" || $('#Fcco_GCCA_Id option:selected').val() == "") {
            $.gritter.add({
                position: 'bottom-left',
                title: 'Atencion',
                sticky: false,
                time_alive: 500,
                text: "Seleccione Grupo y Agencia Correctamente",
            });
        } else if (i == 0) {
            return false;
        }
        else {
            self.submit();
        }

        return false; //is superfluous, but I put it here as a fallback
    });

//    $("#btn").click(function () {
//        console.log(i + " Registros para guardar");
//        if (i > 0) {
//            var data = $("#fcco-form").serialize();
//
//            $.ajax({
//                type: 'POST',
//                url: '<?php echo Yii::app()->createAbsoluteUrl("fcco/create"); ?>',
//                data: data,
//                success: function (data) {
//                    console.log(data);
//                    if (data !== 'error') {
//                        $.gritter.add({
//                            position: 'bottom-left',
//                            // (string | mandatory) the heading of the notification
//                            title: 'Actualizacion Completada',
//                            sticky: true, time_alive: 1000,
//                            // (string | mandatory) the text inside the notification
//                            text: data,
//                        });
//                        $('#padre').children().remove();
//                        i = 0;
//
//                    }
//                },
//                error: function (data) { // if error occured
//                    if (xhr.status === 401) {
//                        bootbox.alert('Operacion no completada, Se perdio la sesion');
//                        $(location).attr('href', '/hocitem/site');
//                    }
//                    console.log(data);
//                },
//                dataType: 'html'
//            });
//
//        }
//
//    });


</script>