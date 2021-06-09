<?php
/* @var $this FccoController */
/* @var $model Fcco */

$this->breadcrumbs = array(
    'Fccos' => array('index'),
    'Administrar',
);

$this->menu = array(
    array('label' => 'Ver grupo padre', 'visible' => isset($grupo->GCCD_IdSuperior),
        'url' => CController::createUrl('grupo', array('id' => !isset($grupo->GCCD_IdSuperior) ? "$grupo->GCCD_Id" : $grupo->GCCD_IdSuperior, 'type' => 1))),
    array('label' => 'Asignar Activos', 'url' => array('create')),
);
foreach ($count as $key => $value) {
    $this->widget[] = array('label' => $key, 'data' => $value[$key][0]);
}
?>



<div class="box box-bordered box-color">
    <div class="box-title">
        <h3>
            <i class="fa fa-th-list"></i>Grupo <?php echo '(' . $grupo->GCCD_Id . ') ' . $grupo->getConcatened(); ?></h3>
    </div>
    <div class="box-content nopadding" >


        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'fcco-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'htmlOptions' => array('style' => 'max-height:500px;overflow:auto'),
            'itemsCssClass' => 'table table-striped table-bordered table-hover',
            'pagerCssClass' => 'table-pagination',
            'pager' => array(
                'htmlOptions' => array('class' => 'pagination'),
                'selectedPageCssClass' => 'active',
            ),
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
                ),
                 array(
                   'name' => 'GCCD_Nombre', 'header' => 'Grupo',
                   'filter' => CHtml::activeTextField($model, 'GCCD_Nombre'),
                   'value' => '$data->gCCD->GCCD_Nombre',
                ),
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
    $(function(){
        var board = $("#fcco-grid" );
        var h = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
		board.css({"max-height":(h-140)});
    })
</script>
