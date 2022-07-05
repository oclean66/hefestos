<?php
/* @var $this FccoController */
/* @var $model Fcco */

$xx = Yii::app()->user->checkAccess('action_gccd_assign') ?
    CHtml::link(
        $grupo->GCCD_Estado == 1 ? "<i class='fa fa-check'></i>Activo" : ($grupo->GCCD_Estado == 2 ? "<i class='fa fa-eye-slash'></i> Oculto" : "<i class=\"fa fa-times\"></i> Inactivo"),
        '#',
        array(
            'class' => 'btn btn-mini',
            'id' => 'grupobtn',
            'name' => 'grupobtn',
            'onClick' => CHtml::ajax(
                array(
                    'type' => 'GET',
                    'url' => array("gccd/assign", 'val1' => $grupo->GCCD_Id),
                    'beforesend' => "function(){
                $('#grupobtn').prop('disabled', true);                                
                
            }",
                    'success' => "function( data ){
                $('#grupobtn').html(data);                                        
                $('#grupobtn').prop('disabled', false);                                
            }",
                )
            ),
        )
    ) : '';



$this->menu = array(
    array(
        'label' => 'Ver grupo padre', 'visible' => isset($grupo->GCCD_IdSuperior),
        'url' => CController::createUrl('grupo', array('id' => !isset($grupo->GCCD_IdSuperior) ? "$grupo->GCCD_Id" : $grupo->GCCD_IdSuperior, 'type' => 1))
    ),
    array('label' => 'Asignar Activos', 'url' => array('create')),
);
foreach ($count as $key => $value) {
    $this->widget[] = array('label' => $key, 'data' => $value[$key][0]);
}
?>

<div class="row">
    <!-- Cabecera -->
    <div class="col-sm-12">
        <div class="box ">
            <div class="box-title">
                <h3>

                    <!-- <i class="fa fa-view"></i>-->
                    <i class="fa fa-users"></i>
                    GRUPO <?php echo $grupo->concatened; ?>
                </h3>
                <!-- <br /> -->

                <div class="actions">

                    <?php echo $xx; ?>
                    <?php echo Yii::app()->user->checkAccess('action_gccd_update') ?
                        CHtml::link(
                            '<i class="fa fa-pencil"></i> Editar',
                            array('/gccd/update', 'id' => $model->GCCD_Id),
                            array('class' => 'btn btn-success btn-mini', 'target' => '_blank')
                        ) :
                        "";
                    ?>

                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 ">
        <div class="box box-bordered box-small green box-color">
            <div class="box-title nomargin">
                <h3>
                    <i class="fa fa-th-list"></i> Datos Basicos
                </h3>
            </div>


            <?php $this->widget('zii.widgets.CDetailView', array(
                'data' => $grupo,
                'id' => 'view',
                'htmlOptions' => array('class' => 'table table-hover table-nomargin table-condensed'),
                'attributes' => array(
                    'GCCD_Id',
                    'GCCD_Cod',
                    'GCCD_Nombre',
                    array('name' => 'GCCD_IdSuperior', 'value' => isset($grupo->GCCD_IdSuperior) ? $grupo->gCCDIdSuperior->concatened : "Sin Padre"),

                    array(
                        'name' => 'GCCD_Estado',
                        'value' => $grupo->GCCD_Estado == 1 ? "Activa" : ($grupo->GCCD_Estado == 2 ? "Oculto" : "Inactivo")
                    ),
                    'GCCD_Responsable',
                    'GCCD_Telefono',
                ),
            )); ?>
        </div>
    </div>
    <form class="form-horizontal form-bordered" id="gccd-form" action="#" method="post">

        <div class="form-group">
            <div class="col-sm-6">

                <h6>Publicado:</h6>                
                <?php
                $list = GccaPublic::model()->findAll("GCCD_Id =:id", array(":id" => $grupo->GCCD_Id)); 
                foreach ($list as $key => $value) {
                    // echo '<span class="label label-info">'.$value->PUBLIC.'</span>';
                    echo '<div style="padding:5px;margin-bottom: 5px;" class="alert alert-warning alert-dismissable"><strong>'.$value->PUBLIC.'</strong></div>';                                    
                }
                ?>
            </div>
        </div>
    </form>
</div>



<div class="box box-bordered box-color box-small">
    <div class="box-title">
        <h3>
            <i class="fa fa-th-list"></i> Total de Asignaciones Activas
        </h3>
    </div>
    <div class="box-content nopadding">


        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'fcco-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'selectableRows'=>1,
            'htmlOptions' => array('style' => 'max-height:500px;overflow:auto'),
            'updateSelector'=>'custom-page-selector',
            'itemsCssClass' => 'table table-striped table-bordered table-hover',
            'pagerCssClass' => 'table-pagination', 
            'columns' => array(
                array('name' => 'FCCO_Timestamp', 'header' => 'Fecha de Asignacion', 'value' => 'date("d M Y h:i:s A" , strtotime($data->FCCO_Timestamp))'),
                array('name' => 'FCCU_Serial', 'header' => 'Serial', 'value' => '$data->fCCU->FCCU_Serial'),
                //veriicacion
                // array('name' => 'GCCA_Id', 'header' => 'Agencia','visible'=>Yii::app()->user->isSuperAdmin),
                //  array('name' => 'GCCD_Id','visible'=>Yii::app()->user->isSuperAdmin),
                //  array('name' => 'FCCN_Id', 'header' => 'tipo','visible'=>Yii::app()->user->isSuperAdmin),
                //   array('name' => 'FCCO_Enabled','visible'=>Yii::app()->user->isSuperAdmin),
                //campos de busqueda relacionada
                array(
                    'name' => 'FCCU_Numero', 'header' => 'Numero',
                    'filter' => CHtml::activeTextField($model, 'FCCU_Numero'),
                    'value' => '!isset($data->fCCU->FCCU_Numero)?"No aplica":$data->fCCU->FCCU_Numero',
                ),
                array(
                    'name' => 'FCUU_Descripcion', 'header' => 'Categoria',
                    'filter' => CHtml::activeTextField($model, 'FCUU_Descripcion'),
                    'value' => '$data->fCCU->fCCT->fCCA->fCUU->FCUU_Descripcion',
                ),
                // array(
                //     'name' => 'FCCA_Descripcion', 'header' => 'Tipo', 
                //     'filter' => CHtml::activeTextField($model, 'FCCA_Descripcion'),
                //     'value' => '$data->fCCU->fCCT->fCCA->FCCA_Descripcion',
                // ),
                array(
                    'name' => 'FCCT_Descripcion', 'header' => 'Modelo',
                    'filter' => CHtml::activeTextField($model, 'FCCT_Descripcion'),
                    'value' => '$data->fCCU->fCCT->fCCA->FCCA_Descripcion." - ".$data->fCCU->fCCT->FCCT_Descripcion',
                ),
                array(
                    'name' => 'GCCA_Nombre', 'header' => 'Agencia',
                    'filter' => CHtml::activeTextField($model, 'GCCA_Nombre'),
                    'value' => '$data->gCCA->GCCA_Nombre',
                    'type' => 'raw',
                    'value' => 'CHtml::link($data->gCCA->GCCA_Nombre, array("fcco/agencia","id"=>$data->GCCA_Id, "type"=>"view"))',
                ),
                // array(
                //     'name' => 'GCCD_Nombre', 'header' => 'Grupo',
                //     'filter' => CHtml::activeTextField($model, 'GCCD_Nombre'),
                //     'value' => '$data->gCCD->GCCD_Nombre',
                // ),
                'FCCO_Lote',
                //        array(
                //            'class' => 'CButtonColumn', 'headerHtmlOptions' => array('style' => 'width:83px'),
                //        ),
            ),
        ));
        ?>

    </div>
</div>

<script>
    $(function() {
        var board = $("#fcco-grid");
        var h = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
        board.css({
            "max-height": (h - 140)
        });
    })
</script>