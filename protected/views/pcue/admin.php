<?php
//
/* @var $this PcueController */
/* @var $model Pcue */

$this->breadcrumbs = array(
    'Bitacora' => array('index'),
    'Administrar',
);
?>

<div class="page-header">
    <div class="pull-left">
        <h1>Bitacora del Sistema</h1>
    </div>
    
</div>


<div class="row">
    <div class="col-sm-12">
        <div class="box box-color box-bordered">

            <?php
            $datap = $model->search();
            $datap->sort = array(
                'defaultOrder' => 'PCUE_Date DESC'
            );

            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'pcue-grid',
                'dataProvider' => $datap,
                'filter' => $model,
                //------------
                'itemsCssClass' => 'table table-hover table-nomargin table-bordered',
                'pagerCssClass' => 'table-pagination',
                'pager' => array(
                    'htmlOptions' => array('class' => 'pagination'),
                    'selectedPageCssClass' => 'active',
                ),
                //-------------
                'columns' => array(
                    //'PCUE_Id',
                    'PCUE_Descripcion',
                    //'PCUE_Action',
                    array(
                        'name' => 'PCUE_Action',
                        'value' => '$data->PCUE_Action',
                        'filter' => CHtml::listData(Pcue::model()->findAll(' 1 group by PCUE_Action'), 'PCUE_Action', 'PCUE_Action'),
                    //'filter' => CHtml::listData(Pcue::model()->findAll(' 1 group by PCUE_Action'), 'PCUE_Action', 'PCUE_Action')
                    ),
                    //'PCUE_Model',
                    array(
                        'name' => 'PCUE_Model',
                        'value' => 'CrugeTranslator::t("classes", $data->PCUE_Model)',
                        'filter' => CHtml::listData(Pcue::model()->findAll(' 1 group by PCUE_Model'), 'PCUE_Model', 'traduccion'),
                    ),
                    'PCUE_IdModel',
                    //'PCUE_Field',
                    'PCUE_Date',
                    //'PCUE_UserId',
                    array(
                        'name' => 'PCUE_UserId',
                        'value' => '$data->PCUE_UserId',
                        'filter' => CHtml::listData(Pcue::model()->findAll(' 1 group by PCUE_UserId'), 'PCUE_UserId', 'PCUE_UserId'),
                    ),
                    //'PCUE_Detalles',
                    array(
                        'header' => 'Detalles',
                        'class' => 'CButtonColumn',
                        'template' => '{view}',
                    ),
                ),
            ));
            ?>

        </div>
    </div>
</div>