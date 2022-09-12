<style>
    @media (min-width:972px){
        .add {
            width: 80.3%;
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
/* @var $this FccoController */
/* @var $model Fcco */
/* @var $form CActiveForm */
?>
<div class="col-sm-12">
    <div class="box box-bordered box-color">
        <div class="box-title">
            <h3  id="serialC">
                <i class="fa fa-th-list"></i>Recibir Equipos</h3>
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
                    <?php
                    echo CHtml::hiddenField('id', '');
                    echo CHtml::hiddenField('descripcion', '');
                    echo CHtml::hiddenField('lugar', '');
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
                                    $('#descripcion').val(ui.item.descrip); 
                                    $('#lugar').val(ui.item.lugar); 

                            }"
                            ),
                            'source' => $this->createUrl("asignados"),
                            'htmlOptions' => array(
                                'class' => 'form-control',
                            ),
                        ));
                        ?> 

                        <div class="input-group-btn">
                            <button class="btn btn-primary" onclick="add()" type="button">Buscar</button>
                        </div>


                    </div>

                    <!--                    <button class="btn btn-success"  type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>-->


                </div>
            </div>

            <?php $this->endWidget(); ?>

            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'fcco-form', //este envia todos los registros de la lista
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
                        <th>Descripcion</th>
                        <th>Procedencia</th>
                        <th>Estado</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody id="padre">
                </tbody>
            </table>

            <div class="form-actions">
                <?php //echo CHtml::submitButton('Guardar', array('id' => 'btn', 'class' => 'btn btn-primary', 'onclick' => 'return false;')); ?>
                <?php echo CHtml::submitButton('Guardar', array(/*'onclick' => 'reallySubmit(this,1)',  'submit' => 'create/1', */ 'id' => 'btn', 'class' => 'btn btn-primary',)); ?>
                <button type="button" class="btn" onclick="cleaner()">Limpiar</button>
            </div>



            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>

<table class="hidden">
    <tbody id="row">        <?php
        if(!Yii::app()->user->rbac->isAssigned('receptor',Yii::app()->user->id)){  
            $estados=Fcci::model()->findAll();
            
        }else{ 
            $estados=Fcci::model()->findAll(array('condition'=>' FCCI_Id=12'));
        }
        $list_est=array();
        foreach($estados as $e){
            if($e['FCCI_Descripcion'] != 'De Baja'){
             $list_est[]=$e;
            }
        }
        ?>         
        <tr>
            <td class="hidden"> <?php echo CHtml::hiddenField('Fcco[FCCU_Id][]', '', array('class' => 'form-control ', 'size' => 45, 'maxlength' => 45)); ?></td>
            <td> <?php echo CHtml::textField('Fcco[FCCU_Serial][]', '', array('class' => 'form-control ', 'size' => 45, 'maxlength' => 45)); ?></td>
            <td> <?php echo CHtml::textField('Fcco[Descripcion][]', '', array('class' => 'form-control ', 'size' => 45, 'maxlength' => 45)); ?></td>
            <td> <?php echo CHtml::textField('Fcco[Lugar][]', '', array('class' => 'form-control ', 'size' => 45, 'maxlength' => 45)); ?></td>
            <td> <?php echo CHtml::dropDownList('Fcco[FCCI_Id][]', 'Fcco[FCCI_Id]', CHtml::listData($list_est, 'FCCI_Id', 'FCCI_Descripcion'), array('value' => 10, 'class' => 'form-control', 'options' => array('10' => array('selected' => true)))); ?></td>
            <td> 
                <button id='del' class="btn btn-danger" onclick="delt($(this).parent().parent())" type="button">
                    <i class="fa fa-minus"></i>
                </button>
            </td>
        </tr>                                                      
    </tbody>
</table>


<script type="text/javascript">

    $("#serial").keyup(function (data) {
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
        var FccuId = $('#master').find('#id').val();
        var FccuSerial = $('#master').find('#serial').val();
        var Descripcion = $('#master').find('#descripcion').val();
        var Lugar = $('#master').find('#lugar').val();

        if (FccuSerial != '' && FccuId!='' && Lugar!="") {
            i++;
            $('#serialC').html('<i class="fa fa-th-list"></i>Recibir Equipos  (' + i + ") Elementos agregados");
            $('#padre').prepend(hijo);

            $('#padre').find('#Fcco_FCCU_Id').attr('id', 'Fcco_FCCU_Id' + i);
            $('#padre').find('#Fcco_FCCU_Id' + i).val(FccuId);

            $('#padre').find('#Fcco_FCCU_Serial').attr('id', 'Fcco_FCCU_Serial' + i);
            $('#padre').find('#Fcco_FCCU_Serial' + i).val(FccuSerial);

            $('#padre').find('#Fcco_Descripcion').attr('id', 'Fcco_Descripcion' + i);
            $('#padre').find('#Fcco_Descripcion' + i).val(Descripcion);


            $('#padre').find('#Fcco_Lugar').attr('id', 'Fcco_Lugar' + i);
            $('#padre').find('#Fcco_Lugar' + i).val(Lugar);



            $('#master').find('#serial').val('');
            $('#master').find('#lugar').val('');
            $('#master').find('#descripcion').val('');


        }



    }
     function reallySubmit(e, f) {
        console.log(e);
            
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
    
    function delt(id)
    {
        i--;
        id.remove();
        $('#serialC').html('<i class="fa fa-th-list"></i>Recibir Equipos  (' + i + ") Elementos agregados");
        //console.log(id);
    }
    function cleaner() {
        $('#padre').children().remove();
        i = 0;
        $('#serialC').html('<i class="fa fa-th-list"></i>Recibir Equipos');


    }
//    $("#btn").click(function () {
//        // console.log(i + " Registros para guardar");
//        if (i > 0) {
//            var data = $("#fcco-form").serialize();
//            $.ajax({
//                type: 'POST',
//                url: '<?php echo Yii::app()->createAbsoluteUrl("fcco/less"); ?>',
//                data: data,
//                success: function (data) {
//                    //console.log(data);
//                    if (data !== 'error') {
//                        bootbox.alert('Guardando...');
//                        $('#padre').children().remove();
//                        i = 0;
//                        console.log(data);
//                    }
//                },
//                error: function (data) { // if error occured
//                    if (data.status === 401) {
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