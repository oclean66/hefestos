<style>
    #main {
        margin-left: 0px;
        height: 100%;
    }

    #left {
        display: none;
    }
</style>

<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl;
?>

<!--Logo de dashbord-->

<div class="page-header">
    <div class="pull-left visible-imprimir">
        <h1>Reporte de entradas y salidas</h1>
        <small><?php echo "Desde: " . strftime("%d-%m-%Y", strtotime($desde)) . " - Hasta: " . strftime("%d-%m-%Y", strtotime($hasta)); ?></small>
    </div>
    <div class="pull-right">
        <div class="input-group" id="dp3" data-date="12-02-2012" data-date-format="dd-mm-yyyy">

            <?php
            $this->beginWidget('CActiveForm', array(
                'id' => 'match-form',
                'htmlOptions' => array('class' => 'span6',),
                'enableAjaxValidation' => false,
            ));
            ?>
            <div class="input-group">
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'desde',
                    'value' => strftime("%d-%m-%Y", strtotime($desde)),
                    'language' => 'es',
                    'options' => array(
                        'showAnim' => 'puff', 'mode' => 'datetime',
                        'showButtonPanel' => true,
                        'dateFormat' => 'dd-mm-yy', //Date format 'mm/dd/yy','yy-mm-dd','d M, y','d MM, y','DD, d MM, yy'
                    ),
                    'htmlOptions' => array(
                        'class' => 'form-control',
                        'style' => '', 'type' => 'date'
                    ),
                ));

                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'hasta',
                    'value' => strftime("%d-%m-%Y", strtotime($hasta)),
                    'language' => 'es',
                    'options' => array(
                        'showAnim' => 'puff', 'mode' => 'datetime',
                        'showButtonPanel' => true,
                        'dateFormat' => 'dd-mm-yy', //Date format 'mm/dd/yy','yy-mm-dd','d M, y','d MM, y','DD, d MM, yy'
                    ),
                    'htmlOptions' => array(
                        'class' => 'form-control',
                        'style' => '', 'type' => 'date'
                    ),
                ));
                ?>
                <div class="input-group-btn">
                    <?php
                    echo CHtml::button('Enviar', array(
                        'style' => 'height:58px;',
                        'class' => 'btn', 'type' => 'submit', 'submit' => Yii::app()->createUrl("reportes/entradassalidas/" ), 'onclick' => 'bootbox.alert("Espere mientras carga");'
                    ));
                    ?>

                </div>

                <?php $this->endWidget(); ?>

            </div>
        </div>
    </div>
</div>


<div class="wide form">


<div class="row">
    <div class="col-sm-12">
        <div class="box box-color box-bordered">
            <div class="box-title">
                <h3>
                    <i class="fa fa-table"></i>
                    Salidas
                </h3>
            </div>
            <div class="box-content nopadding">
                <table class="table table-hover table-nomargin table-bordered dataTable-columnfilter dataTable dataTable-es">
                    <thead>
                        <tr class='thefilter'>
                            <th>Tipo de activo </th>
                            <th>Asignados </th>
                        </tr>
                        <tr class=''>
                            <th>Tipo de activo </th>
                            <th>Asignados </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($salidas as $r){ ?>
                        <tr ondblclick= >
                            <td><?= $r['FCCA_Descripcion'] ?></td>
                            <td style="width:100px;" >
                                <a href="javascript:;" class="not-link" ondblclick="listasalidas('<?= $r['FCCA_Id'] ?>','<?= $desde ?>','<?= $hasta ?>')" >
                                    <?= $r['total'] ?> 
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="box box-color box-bordered">
            <div class="box-title">
                <h3>
                    <i class="fa fa-table"></i>
                    Entradas
                </h3>
            </div>
            <div class="box-content nopadding">
                <table class="table table-hover table-nomargin table-bordered dataTable-columnfilter dataTable dataTable-es">
                    <thead>
                        <tr class='thefilter'>
                            <th>Tipo de activo </th>
                            <th>Asignados </th>
                        </tr>
                        <tr class=''>
                            <th>Tipo de activo </th>
                            <th>Asignados </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($entradas as $r){ ?>
                        <tr ondblclick= >
                            <td><?= $r['FCCA_Descripcion'] ?></td>
                            <td style="width:100px;" >
                                <a href="javascript:;" class="not-link" ondblclick="listaentradas('<?= $r['FCCA_Id'] ?>','<?= $desde ?>','<?= $hasta ?>')" >
                                    <?= $r['total'] ?> 
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>

<div id="modal-1" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Activos asignados</h4>
            </div>
            <!-- /.modal-header -->
            <div class="modal-body">
                    
            </div>
            <!-- /.modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> 
            </div>
            <!-- /.modal-footer -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

 <script> 
function listasalidas(id,desde,hasta){
    $('#myModalLabel').text("Activos asignados");
    $('#modal-1').modal('show');
    $('.modal-body').load('<?= Yii::app()->createUrl('fccu/movimientoactivos/',array('view'=>'index','tipo'=>1)) ?>&desde='+desde+'&hasta='+hasta+'&id='+id);       
}
function listaentradas(id,desde,hasta){
    $('#myModalLabel').text("Activos entregados");
    $('#modal-1').modal('show');
    $('.modal-body').load('<?= Yii::app()->createUrl('fccu/movimientoactivos/',array('view'=>'index','tipo'=>0)) ?>&desde='+desde+'&hasta='+hasta+'&id='+id);       
}
</script>