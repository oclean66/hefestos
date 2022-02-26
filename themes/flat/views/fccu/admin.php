<?php
/* @var $this FccuController */
/* @var $model Fccu */
// $this->menu = array(
//     array(
//         'label' => CrugeTranslator::t('app', 'Agregar Activo'),
//         'url' => array('add'),
//         'visible' => Yii::app()->user->checkAccess('action_fccu_add')
//     ),
// );
?>


<div class="box">
    <div class="box-title">
        <h3>
            <i class="fa fa-thumb-tack"></i>Activos del Sistema
        </h3>
        <div class="actions">
            <a href="javascript:print()" class="btn">
                <i class="fa fa-print"></i> Imprimir
            </a>
        </div>
    </div>


    <div class="box box-content nopadding table-responsive" id="consulta">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'fccu-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'afterAjaxUpdate' => 'ActivarSelects',
            'itemsCssClass' => 'table table-hover table-nomargin table-condensed visible-imprimir',
            'pagerCssClass' => 'table-pagination remover',
            'rowCssClassExpression' => '$data->FCCI_Id==7?"alert-purple":($data->FCCI_Id==6?"alert-danger":($data->FCCI_Id==5?"alert-warning":(($data->FCCI_Id==4)?"alert-info":($data->FCCI_Id==3?"alert-alert":(($data->FCCI_Id==2 || $data->FCCI_Id==10)?"alert-default":($data->FCCI_Id==1?"alert-success":""))))))',
            'pager' => array(
                'htmlOptions' => array('class' => 'pagination'),
                'selectedPageCssClass' => 'active',
            ),
            'columns' => array(
                array(
                    'name' => 'FCCU_Timestamp', 'header' => 'Fecha de Ingreso',
                    'value' => 'date("d/m/Y, h:ia",strtotime($data->FCCU_Timestamp))',

                ),
                array('name' => 'FCCU_Serial', 'header' => 'Serial', 'value' => '$data->FCCU_Serial'),
                //campos de busqueda relacionada
                array(
                    'name' => 'FCCU_Numero',

                    'header' => 'Numero',
                    'headerHtmlOptions' => array('class' => 'remover'),

                    'value' => '!isset($data->FCCU_Numero)?"No aplica":$data->FCCU_Numero',
                    'htmlOptions' => array('class' => 'remover'),

                    'filter' => CHtml::activeTextField($model, 'FCCU_Numero'),
                ),
                // array(
                //     'name' => 'FCUU_Descripcion', 'header' => 'Categoria',
                //     'filter' => CHtml::activeTextField($model, 'FCUU_Descripcion'),
                //     'value' => '$data->fCCT->fCCA->fCUU->FCUU_Descripcion',
                // ),
                array(
                    'name' => 'FCCA_Descripcion', 'header' => 'Tipo',
                    'filter' => CHtml::activeTextField($model, 'FCCA_Descripcion'),
                    'value' => '$data->fCCT->fCCA->FCCA_Descripcion',
                ),
                array(
                    'name' => 'FCCT_Descripcion',
                    'header' => 'Modelo',
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
                    //'value' => '$data->FCCI_Id==5?CHtml::link(Fcco::model()->find(\'FCCU_Id=\'.$data->FCCU_Id)->lugar, Yii::app()->createUrl("fcco/agencia",array("id"=>Fcco::model()->find(\'FCCU_Id=\'.$data->FCCU_Id)->GCCA_Id,"type"=>1))):$data->fCCI->FCCI_Descripcion',
                    //'value' => '$data->FCCI_Id==5?Fcco::model()->findByPk($data->FCCU_Id)->lugar:$data->fCCI->FCCI_Descripcion',
                    //'value' => '"<a href=\"#\" rel=\'popover\' data-trigger=\'hover\' title=\'".$data->fCCI->FCCI_Descripcion."\' '
                    // . 'data-placement=\'top\' '
                    // . 'data-content=\'".($data->FCCI_Id==5?Fcco::model()->find(\'FCCU_Id=\'.$data->FCCU_Id)->lugar:$data->fCCI->FCCI_Descripcion)."\'>".$data->fCCI->FCCI_Descripcion."</a>"',
                    /* '"<a href=\"#\" 
                        rel=\'".( $data->FCCI_Id == 5 ? "popover" : "")."\' 
                        data-trigger=\'hover\' 
                        title=\'".$data->fCCI->FCCI_Descripcion."\' 
                        data-placement=\'top\' 
                        data-content=\'".( $data->FCCI_Id==5 ? Fcco::model()->find(\'FCCU_Id=\'.$data->FCCU_Id.\' order by FCCO_Id desc\')->lugar:$data->fCCI->FCCI_Descripcion)."\'>".$data->fCCI->FCCI_Descripcion."</a>"',
                        'type' => 'raw',
                        'headerHtmlOptions' => array('style' => 'width:120px'), */
                    'value' => '$data->FCCI_Id==5 ? Fcco::model()->find("FCCU_Id=".$data->FCCU_Id. " order by FCCO_Id desc")->cod:$data->fCCI->FCCI_Descripcion',
                ),
                array(
                    'header' => 'Acciones',
                    'class' => 'CButtonColumn',
                    'deleteButtonLabel' => "Dar de Baja",
                    'deleteConfirmation' => "Seguro desar dar de baja esta activo?",
                    // 'recibeConfirmation'=>"Seguro desar dar de baja esta activo?",

                    'headerHtmlOptions' => array('class' => 'remover', 'style' => 'width:90px'),
                    // 'template' => '{view} {update} {recibe} {report} {delete}',
                    'template' => '{view}
                                        <div class="btn-group ">                                           
                                            <a href="#" data-toggle="dropdown" class="btn btn-success btn-sm dropdown-toggle">
                                                <i class="fa fa-bars"></i>
                                            </a>
                                            <ul class="dropdown-menu pull-right" style="min-width:0">                                                                            
                                                <li>{update}</li>
                                                <li>{recibe}</li>                                            
                                                <li>{report}</li>                                            
                                                <li>{delete}</li>                                            
                                            </ul>
                                           
                                        </div>',
                    'buttons' => array(
                        'view' => array(
                            'imageUrl' => false,
                            'label' => '<i class="fa fa-eye"></i>',
                            'visible' => 'Yii::app()->user->checkAccess("action_fccu_view")',
                            'url' => 'Yii::app()->createUrl("fccu/view/",array("id"=>$data->FCCU_Id))',
                            'options' => array('target' => '_blank', 'class' => 'not-link remover btn btn-sm btn-orange', 'title' => 'Ver'),
                        ),
                        'update' => array(
                            'label' => '<i class="fa fa-pencil"></i> Editar',
                            'visible' => 'Yii::app()->user->checkAccess("action_fccu_update")',
                            'url' => 'Yii::app()->createUrl("fccu/update/",array("id"=>$data->FCCU_Id))',
                            'options' => array(
                                'target' => '_blank',
                                'class' => 'not-link remover btn btn-sm btn-info text-left',
                                'title' => 'Editar'
                            ),
                            'imageUrl' => false,
                        ),
                        'recibe' => array(
                            // 'label' => 'Recibir', // text label of the button
                            'label' => '<i class="fa fa-mail-reply"></i> Recibir',
                            // 'imageUrl' => Yii::app()->theme->baseUrl . '/img/computer_go.png', // image URL of the button. If not set or false, a text link is used
                            'imageUrl'=>false,
                            'options' => array(
                                // 'target' => '_blank', 
                                'class' => 'not-link btn btn-sm btn-satblue',
                                'title'=>'Enviar a...'    
                            ),
                            'visible' => 'Yii::app()->user->checkAccess("action_fccu_recibe") && $data->FCCI_Id == 5', // a PHP expression for determining whether the button is visible
                            'confirm' => "Seguro desea Recibir este activo?",
                            'confirmation' => "Seguro Desea Recibir este activo?",
                            'url' => 'Yii::app()->createUrl("fccu/recibe",array("id"=>$data->FCCU_Id))', // a PHP expression for generating the URL of the button
                            'click' => "function(){
                                    $.fn.yiiGridView.update('fccu-grid', {
                                        type:'POST',
                                        url:$(this).attr('href'),
                                        success:function(data) {
                                            $('#progress').attr('style', 'width:100%');
                                            $.fn.yiiGridView.update('fccu-grid');
                                        }
                                    })
                                    $('#progress').attr('style', 'width:0%');
                                    return false;
                                }"
                        ),
                        'report' => array( 

                            'visible' => 'Yii::app()->user->checkAccess("action_fccu_report")',
                            'url' => 'Yii::app()->createUrl("tccd/create", array("id"=>$data->FCCU_Id))',
                            'options' => array(
                                'target' => '_blank', 
                                'class' => 'not-link btn btn-sm btn-orange',
                                'title'=>'Enviar a...'    
                            ),
                            // 'imageUrl' => Yii::app()->theme->baseUrl . '/img/report1.png',
                            'imageUrl' => false, 
                            'label' => '<i class="fa fa-share-square-o"></i> Enviar a...',

                        ),
                        'delete' => array(
                            'visible' => 'Yii::app()->user->checkAccess("action_fccu_delete") && $data->FCCI_Id!=5',
                            'url' => 'Yii::app()->createUrl("fccu/delete/",array("id"=>$data->FCCU_Id))',
                            'imageUrl' => false,

                            'options' => array(
                               
                                'class' => 'not-link btn btn-sm btn-danger',
                                'title'=>'Dar de Baja'    
                            ), 
                            'label' => '<i class="fa fa-trash-o"></i> Dar de Baja',
                        ),
                    ),
                ),
            ),
        ));

        ?>

    </div>
</div>