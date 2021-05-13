<?php
/* @var $this FccuController */
/* @var $model Fccu */

$this->breadcrumbs = array(
    'Fccus' => array('index'),
    'Administrar',
);


?>
<link rel="stylesheet" type="text/css" href="/themes/flat/css/print.css" media="print" />


<script language="Javascript">
	function imprSelec(nombre) {
	  var ficha = document.getElementById(nombre);
	  var ventimp = window.open(' ', 'popimpr');
	  ventimp.document.write( ficha.innerHTML );
	  ventimp.document.close();
	  ventimp.print( );
	  ventimp.close();
	}
	</script>
<!--  <div class="col-sm-12">
    <div class="page-header"> 
        <div class="pull-right">
            <ul class="minitiles">
                <li class="orange">
                    <a href="print.html" target="_blank">
                        <i class="fa fa-print"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div> -->
<div class="box box-bordered box-color">
    <div class="box-title">
        <h3>
            <i class="fa fa-th-list"></i>Administrar Activos del Sistema
        </h3>
        
        <?php
        /* echo CHtml::link('<i class="fa fa-print"></i>  Imprimir', array('print'), array('class' => 'btn btn-primary', 'style' => 'float:right', 'target' => '_blank')); */
        ?>
        
        <a href="javascript:print()">
        <button class="btn btn-primary" style="float:right" target="_blank">
                <i class="fa fa-print"></i>  Imprimir
        </button>
        </a>

    </div>


    <div class="box box-content nopadding" id="consulta">
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
                        'headerHtmlOptions' => array('class'=>'remover'),
                        
                        'value' => '!isset($data->FCCU_Numero)?"No aplica":$data->FCCU_Numero',
                        'htmlOptions' => array('class'=>'remover'),

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
                        
                        'headerHtmlOptions' => array('class' => 'remover','style' => 'width:90px'),
                        'template' => '{view} {update} {recibe} {report} {delete}',
                        'buttons' => array(
                            'view' => array(
                                'htmlOptions' => array('class' => 'remover'),
                                'label' => "Detalles",
                                'visible' => 'Yii::app()->user->checkAccess("action_fccu_view")',
                                'url' => 'Yii::app()->createUrl("fccu/view/",array("id"=>$data->FCCU_Id))',
                                'options' => array('target' => '_blank'),
                            ),
                            'update' => array(
                                'label' => "Actualizar",
                                'visible' => 'Yii::app()->user->checkAccess("action_fccu_update")',
                                'url' => 'Yii::app()->createUrl("fccu/update/",array("id"=>$data->FCCU_Id))',
                                'options' => array('target' => '_blank'),
                            ),
                            'recibe' => array(
                                'label' => 'Recibir', // text label of the button
                                'imageUrl' => Yii::app()->theme->baseUrl . '/img/computer_go.png', // image URL of the button. If not set or false, a text link is used
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
                                'label' => 'Reportar',
                                'visible' => 'Yii::app()->user->checkAccess("action_fccu_report")',
                                'url' => 'Yii::app()->createUrl("tccd/create", array("id"=>$data->FCCU_Id))',
                                'options' => array('target' => '_blank'),
                                'imageUrl' => Yii::app()->theme->baseUrl . '/img/report1.png',
                            ),
                            'delete' => array(
                                'visible' => 'Yii::app()->user->checkAccess("action_fccu_delete") && $data->FCCI_Id!=5',
                                'url' => 'Yii::app()->createUrl("fccu/delete/",array("id"=>$data->FCCU_Id))',
                            ),
                        ),
                    ),
                ),
            ));
            
            ?>

        </div>
    </div>
