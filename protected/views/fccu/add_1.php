<style>
    @media (min-width:972px){
        .add {
            width: 25.3%;
            display: inline;
            margin-right: 9px;
        }
    } 

</style>
<style>
    #main{
        margin-left: 0px;
    }   
    .sidebar-fixed{
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
            <h3  id="serialC">
                <i class="fa fa-th-list"></i>Agregar Equipos</h3>
        </div>
        <div class="box-content nopadding" >

            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'sin Proposito en la vida de los formularios',
                'enableAjaxValidation' => false,
                'htmlOptions' => array(
                    'onsubmit' => "return false;"),
            ));
            ?>

            <div id="master">
                <div class="col-sm-12" style="margin-top:10px; margin-bottom: 10px;">
                    <?php echo CHtml::label('Serial', 'Serial', array('class' => 'control-label ')); ?>
                    <?php echo CHtml::textField('Fccu[FCCU_Serial][]', '', array('class' => 'form-control add ', 'size' => 45, 'maxlength' => 45)); ?>
                    <?php echo CHtml::label('Tipo', 'Tipo', array('class' => 'control-label')); ?>
                    <?php
                    echo CHtml::dropDownList('Fccu[FCCA_Id][]', 'Fccu[FCCA_Id][]', CHtml::listData(Fcca::model()->findAll(), 'FCCA_Id', 'FCCA_Descripcion'), array('class' => 'form-control add',
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => CController::createUrl('fccu/Rellenarmodos'),
                            // 'success' => 'function(data){ console.log(data); }',
                            'update' => '#' . CHtml::activeId($model, 'FCCT_Id'),
                            'beforeSend' => 'function(){
                            
                            var select = document.getElementById("Fccu_FCCT_Id");    				
                                select.options.length = 0;
                                select.options[select.options.length] = new Option("Cargando...", "");}',
                        ),
                        'prompt' => 'Seleccione un Tipo...'));
                    ?>
                    <?php echo CHtml::label('Modelo', 'Modelo', array('class' => 'control-label')); ?>
                    <?php echo CHtml::dropDownList('Fccu[FCCT_Id][]', 'Fccu[FCCT_Id][]', array(), array('empty' => 'Selecciona', 'class' => 'form-control add')); ?>
                    <?php //echo CHtml::label('$model', '', array('class' => 'control-label')); ?>
                    <button class="btn btn-success" onclick="add()" type="button">
                        <i class="fa fa-plus"></i>
                    </button>


                </div>
            </div>

            <?php $this->endWidget(); ?>

            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'fccu-form', //este envia todos los registros de la lista
                'enableAjaxValidation' => false,
                'htmlOptions' => array(
                    'onsubmit' => "return false;",
                    'onkeyup' => "if(event.keyCode=='13'){"
                    . " add();} ",
                    'class' => 'form-vertical form-bordered'),
            ));
            ?>


            <table class="table table-hover table-nomargin" style="padding-top: 5px">
                <thead>
                    <tr>
                        <th># Serial</th>
                        <th>Tipo</th>
                        <th>Modelo</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody id="padre">
                </tbody>
            </table>
            <div class="form-actions">
                <?php echo CHtml::submitButton('Guardar', array('id' => 'btn', 'class' => 'btn btn-primary', 'onclick' => 'return false;')); ?>
                <button type="button" class="btn" onclick="cleaner()">Limpiar</button>
            </div>



            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>

<table class="hidden">
    <tbody id="row">                
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


<script type="text/javascript">

    $("#Fccu_FCCU_Serial").keyup(function (data) {
        //alert(event.data.keyCode);
        if (data.keyCode === 13) {
            add();
        }
        //console.log(data.keyCode);
    });

    var hijo = $('#row').html();
    var i = 0;


    function add()
    {
        var FccuSerial = $('#master').find('#Fccu_FCCU_Serial').val();
        var FccuTipo = $('select#Fccu_FCCA_Id option:selected').sort().clone();
        var FccuModel = $('select#Fccu_FCCT_Id option:selected').sort().clone();

        if (FccuSerial != '' && FccuTipo.val() != '' && FccuModel.val() != '') {
            i++;
            $('#serialC').html('<i class="fa fa-th-list"></i>Agregar Equipos  (' + i + ") Elementos agregados");
            $('#padre').prepend(hijo);

            $('#padre').find('#Fccu_FCCU_Serial').attr('id', 'Fccu_FCCU_Serial' + i);
            $('#padre').find('#Fccu_FCCU_Serial' + i).val(FccuSerial);

            $('#padre').find('#Fccu_FCCA_Id').attr('id', 'Fccu_FCCA_Id' + i);
            $('select#Fccu_FCCA_Id' + i).append(FccuTipo);
            // $('#padre').find('#Fccu_FCCA_Id' + i).val(FccuTipo);

            $('#padre').find('#Fccu_FCCT_Id').attr('id', 'Fccu_FCCT_Id' + i);
            $('select#Fccu_FCCT_Id' + i).append(FccuModel);
            // $('#padre').find('#Fccu_FCCT_Id' + i).val(FccuModel);

            $('#master').find('#Fccu_FCCU_Serial').val('');


        }



    }
    function delt(id)
    {
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
    $("#btn").click(function () {
       // console.log(i + " Registros para guardar");
        if (i > 0) {
            var data = $("#fccu-form").serialize();

            $.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->createAbsoluteUrl("fccu/add"); ?>',
                data: data,
                success: function (data) {
                    //console.log(data);
                    if (data !== 'error') {
                        $.gritter.add({
                            position: 'bottom-left',
                            // (string | mandatory) the heading of the notification
                            title: 'Actualizacion Completada',
                            sticky: true, time_alive: 1000,
                            // (string | mandatory) the text inside the notification
                            text: data,
                        });
                        $('#padre').children().remove();
                        i = 0;

                    }
                },
                error: function (data) { // if error occured
                    if (xhr.status === 401) {
                        bootbox.alert('Operacion no completada, Se perdio la sesion');
                        $(location).attr('href', '/hocitem/site');
                    }
                    console.log(data);
                },
                dataType: 'html'
            });

        }

    });


</script>