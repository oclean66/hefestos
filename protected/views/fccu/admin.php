<?php
/* @var $this FccuController */
/* @var $model Fccu */

$this->breadcrumbs = array(
    'Fccus' => array('index'),
    'Administrar',
);


?>

<h1>Administrar Activos del Sistema</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'fccu-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'afterAjaxUpdate' => 'ActivarSelects',
    'itemsCssClass' => 'table table-hover table-nomargin table-condensed',
    'pagerCssClass' => 'table-pagination',
    'rowCssClassExpression' => '$data->FCCI_Id==7?"alert-purple":($data->FCCI_Id==6?"alert-danger":($data->FCCI_Id==5?"alert-warning":($data->FCCI_Id==4?"alert-info":($data->FCCI_Id==3?"alert-alert":($data->FCCI_Id==2?"alert-default":($data->FCCI_Id==1?"alert-success":""))))))',
    'pager' => array(
        'htmlOptions' => array('class' => 'pagination'),
        'selectedPageCssClass' => 'active',
    ),
    'columns' => array(
        array('name' => 'FCCU_Timestamp', 'header' => 'Fecha de Ingreso'),
        array('name' => 'FCCU_Serial', 'header' => 'Serial', 'value' => '$data->FCCU_Serial'),
        //campos de busqueda relacionada
        array(
            'name' => 'FCCU_Numero', 'header' => 'Numero',
            'filter' => CHtml::activeTextField($model, 'FCCU_Numero'),
            'value' => '!isset($data->FCCU_Numero)?"No aplica":$data->FCCU_Numero',
        ),
        array(
            'name' => 'FCUU_Descripcion', 'header' => 'Categoria',
            'filter' => CHtml::activeTextField($model, 'FCUU_Descripcion'),
            'value' => '$data->fCCT->fCCA->fCUU->FCUU_Descripcion',
        ),
        array(
            'name' => 'FCCA_Descripcion', 'header' => 'Tipo',
            'filter' => CHtml::activeTextField($model, 'FCCA_Descripcion'),
            'value' => '$data->fCCT->fCCA->FCCA_Descripcion',
        ),
        array(
            'name' => 'FCCT_Descripcion', 'header' => 'Modelo',
            'filter' => CHtml::activeTextField($model, 'FCCT_Descripcion'),
            'value' => '$data->fCCT->FCCT_Descripcion',
        ),
        // array(
        //     'name' => 'FCCI_Id', 'header' => 'Estado',
        //     'filter' => CHtml::listData(Fcci::model()->findAll(), 'FCCI_Id', 'FCCI_Descripcion'),
        //     'value' => '"<a href=\"#\" rel=\'popover\' data-trigger=\'hover\' title=\'".$data->fCCI->FCCI_Descripcion."\' '
        //     . 'data-placement=\'top\' '
        //     . 'data-content=\'".($data->FCCI_Id==5?Fcco::model()->find(\'FCCU_Id=\'.$data->FCCU_Id)->lugar:$data->fCCI->FCCI_Descripcion)."\'>".$data->fCCI->FCCI_Descripcion."</a>"',
        //     'type' => 'raw', 'visible' => false,
        // ),
        array(
            'name' => 'FCCI_Id', 'header' => 'Estado',
            'filter' => CHtml::listData(Fcci::model()->findAll(), 'FCCI_Id', 'FCCI_Descripcion'),
//            'value' => '$data->FCCI_Id==5?CHtml::link(Fcco::model()->find(\'FCCU_Id=\'.$data->FCCU_Id)->lugar, Yii::app()->createUrl("fcco/agencia",array("id"=>Fcco::model()->find(\'FCCU_Id=\'.$data->FCCU_Id)->GCCA_Id,"type"=>1))):$data->fCCI->FCCI_Descripcion',
            // 'value' => '$data->FCCI_Id==5?Fcco::model()->findByPk($data->FCCU_Id)->lugar:$data->fCCI->FCCI_Descripcion',
            'value' => '$data->fCCI->FCCI_Descripcion',
            'type' => 'raw',
            'headerHtmlOptions' => array('style' => 'width:120px'),
        ),
        array(
            'header' => 'Acciones',
            'class' => 'CButtonColumn',
            'headerHtmlOptions' => array('style' => 'width:83px'),
            'template' => '{view} {update} {recibe}',
            'buttons' => array(
                'view' => array(
                    'label' => "Detalles",
                    'url' => 'Yii::app()->createUrl("fccu/view/",array("id"=>$data->FCCU_Id))',
                    'options' => array('target' => '_new'),
                ),
                'recibe' => array(
                    'label' => 'Recibir', // text label of the button
                    'url' => 'Yii::app()->createUrl("fccu/recibe",array("id"=>$data->FCCU_Id))', // a PHP expression for generating the URL of the button
                    'imageUrl' => Yii::app()->theme->baseUrl . '/img/computer_go.png', // image URL of the button. If not set or false, a text link is used
                    'visible' => '$data->FCCI_Id==5?true:false', // a PHP expression for determining whether the button is visible
                    'options' => array('confirm' => 'Esta Seguro que quiere recibir este activo?',
                        'ajax' => array(
                            'type' => 'get',
                            'url' => "js:$(this).attr('href')",                           
                            'success' => " function(html){
                                 alert(html);
                                }",
                        ),
                    ),
                ),
            ),
        ),
    ),
));
// Yii::app()->clientScript->registerScript('search', " 
//     var timer;
//         $('#fccu-grid .filters input[type=text] ').live('keyup', function(e){
//             var focusedId = $(document.activeElement).attr('id');
//             clearTimeout(timer);
//             timer = setTimeout(function() {
//                         $.fn.yiiGridView.update('fccu-grid', {
//                             data: $('#grid-form').serialize(),
//                             complete: function(jqXHR, status) {
//                                 if (status=='success'){
//                                     //refocus last filter input box.
//                                     $('#' + focusedId).focus();
//                                     tmpStr = $('#' + focusedId).val();
//                                     $('#' + focusedId).val('');
//                                     $('#' + focusedId).val(tmpStr);
//                                 }
//                             }

//                         });
//                     }, 1000);
//         }); ");
?>



