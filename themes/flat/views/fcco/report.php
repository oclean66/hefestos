<?php
/* @var $this FcciController */
/* @var $model Fcci */
?>
<div id="modal-1" class="modal fade" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- /.modal-header -->
            <div class="modal-body" id="modal-body">
                <div id="ticketVirtual" class="span3" style="min-height: 100px; width: 96%;"></div>
            </div>
            <!-- /.modal-body -->

            <!-- /.modal-footer -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="page-header">
    <div class="pull-left visible-imprimir">
        <h1>Reporte de <?php echo $model->FCCN_Id == 1 ? "Salidas" : "Entradas" ?></h1>
        <small><?php echo "Desde: " . strftime("%d-%m-%Y", strtotime($model->desde)) . " - Hasta: " . strftime("%d-%m-%Y", strtotime($model->hasta)); ?></small>
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
                    'value' => strftime("%d-%m-%Y", strtotime($model->desde)),
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
                    'value' => strftime("%d-%m-%Y", strtotime($model->hasta)),
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
                        'class' => 'btn', 'type' => 'submit', 'submit' => Yii::app()->createUrl("fcco/report", array("FCCN_Id" => $FCCN_Id)), 'onclick' => 'bootbox.alert("Espere mientras carga");'
                    ));
                    ?>

                </div>

                <?php $this->endWidget(); ?>

            </div>
        </div>
    </div>
</div>



<div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs remover" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Detalle por Activos</a></li>
        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Detalle por Agencias</a></li>
        <!-- <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li> -->
        <!-- <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li> -->
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'fcco-grid',
                'dataProvider' => $model->search(),
                'filter' => $model,
                // 'sort' => array(),
                'itemsCssClass' => 'table table-hover table-nomargin visible-',
                'pagerCssClass' => 'table-pagination',
                'afterAjaxUpdate' => 'ActivarSelects',
                'pager' => array(
                    'htmlOptions' => array('class' => 'pagination'),
                    'selectedPageCssClass' => 'active',
                ),
                'columns' => array(
                    array('name' => 'FCCO_Lote'),

                    array(
                        'name' => 'desde',
                        'header' => 'Fecha/Hora',
                        'type' => 'raw',
                        'value' => 'date("d M Y h:i:s A" , strtotime($data->FCCO_Timestamp))."<br/><b>".$data->username."</b>"'
                    ),
                    //array('name' => 'FCCO_Timestamp', 'value' => 'date("d M Y h:i:s A" , strtotime($data->FCCO_Timestamp))'),
                    //array('name' => 'hasta', 'value' => 'date("d M Y h:i:s A" , strtotime($data->FCCO_Timestamp))'),

                    array(
                        'name' => 'FCCU_Serial', 'type' => 'raw',
                        //'value' => '$data->fCCU->FCCU_Numero!=""?$data->fCCU->FCCU_Serial." (".$data->fCCU->FCCU_Numero.")":$data->fCCU->FCCU_Serial',
                        //'value'=>'"<a href=\"/fccu/".$data->FCCU_Id."\">".$data->fCCU->FCCU_Serial."</a>"',
                        'value' => 'CHtml::link($data->fCCU->FCCU_Numero!=""?$data->fCCU->FCCU_Serial." (".$data->fCCU->FCCU_Numero.")":$data->fCCU->FCCU_Serial,Yii::app()->createUrl(\'fccu/view\',array(\'id\'=>$data->FCCU_Id)))'
                    ),
                    //array('name' => 'FCCU_Numero', 'header' => 'Numero', 'value' => '$data->fCCU->FCCU_Numero'),
                    array(
                        'name' => 'FCUU_Descripcion', 'header' => 'Categoria',
                        'filter' => CHtml::activeTextField($model, 'FCUU_Descripcion'),
                        'value' => '$data->fCCU->fCCT->fCCA->fCUU->FCUU_Descripcion',
                    ),
                    array(
                        'name' => 'FCCA_Descripcion', 'header' => 'Tipo/Modelo',
                        'filter' => CHtml::activeTextField($model, 'FCCA_Descripcion'),
                        'value' => '$data->fCCU->fCCT->fCCA->FCCA_Descripcion." - ".$data->fCCU->fCCT->FCCT_Descripcion',
                    ),
                    //        array('name' => 'FCCO_Enabled', 'type' => 'raw', 'headerHtmlOptions' => array('style' => 'width:20%'),
                    //            'value' => '(($data->FCCO_Enabled==1 && $data->FCCN_Id==1)?"Actualmente en ":"")."<a href=\'agencia/".$data->GCCA_Id."?type=1\'>".$data->lugar."</a>"',
                    //        ),
                    //        array('name' => 'FCCO_Enabled', 'type' => 'raw', 'headerHtmlOptions' => array('style' => 'width:20%'),
                    //            'value' => '(($data->FCCO_Enabled==1 && $data->FCCN_Id==1)?"Activo ":"Inactivo")',
                    //        ),
                    //        'FCCO_Timestamp',
                    //        'FCCO_Lote',
                    //        'FCCU_Id',
                    //        'GCCA_Id',
                    array(
                        'name' => 'GCCA_Id', 'header' => 'Agencia',
                        'filter' => CMap::mergeArray(array('' => 'Todos'), CHtml::listData(Gcca::model()->findAll(), 'GCCA_Id', 'concatened')),
                        //'filter' => CHtml::listData(),

                        //'filter' => CHtml::activeTextField($model, 'GCCA_Nombre'),
                        'value' => '$data->gCCA? $data->gCCA->concatened:"-"',
                    ),
                    array('name' => 'GCCA_Nombre', 'value' => '$data->FCCN_Id'),
                    array(
                        'class' => 'CButtonColumn',
                        'headerHtmlOptions' => array('style' => 'width:83px'),
                        'template' => '{view}',
                        'buttons' => array(
                            'view' => array(
                                'imageUrl' => Yii::app()->theme->baseUrl . "/img/page.png",
                                'url' => '(isset($data->gCCA->GCCA_Id) && $data->gCCA->GCCA_Id != "-")? Yii::app()->createUrl("fcco/view",array("id"=>$data->FCCO_Lote,"tipo"=>$data->FCCN_Id,"view"=>1,"agencia"=>$data->gCCA->GCCA_Id)): Yii::app()->createUrl("fcco/view",array("id"=>$data->FCCO_Lote,"tipo"=>$data->FCCN_Id,"view"=>1,"grupo"=>$data->gCCD->GCCD_Id)) ',
                                'options' => array(
                                    'ajax' => array(
                                        'type' => 'GET',
                                        // ajax post will use 'url' specified above 
                                        'url' => "js:$(this).attr('href')",
                                        'update' => '#ticketVirtual',
                                        'beforeSend' => "function(){                                
                                                    $('#modal-1').modal('show');
                                                    $('#ticketVirtual').html('<div class=\"progress progress-striped active\"><div class=\"progress-bar\" role=\"progressbar\" aria-valuenow=\"100\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 100%\"><span class=\"sr-only\"></span></div></div>');                                      
                                                    }",
                                        'complete' => "function(){
                                                        $('#ticketVirtual').removeClass('loading');                                 
                                                    }",
                                    ),
                                ),
                            )
                        )
                    ),
                ),
            ));
            ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="profile">



            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'fcco-grid-agencia',
                'dataProvider' => new CArrayDataProvider($agencias, array(
                    'keyField' => 'FCCO_Id',
                    'pagination' => array('pageSize' => 500)
                )),
                'filter' => $model,
                // 'sort' => array(),
                'itemsCssClass' => 'table table-hover table-condensed table-mail visible-',
                'pagerCssClass' => 'table-pagination',
                'afterAjaxUpdate' => 'ActivarSelects',
                'pager' => array(
                    'htmlOptions' => array('class' => 'pagination'),
                    'selectedPageCssClass' => 'active',
                ),
                'columns' => array(
                    array(
                        'header' => '#',
                        'value' => 'date("d M",strtotime($data->FCCO_Timestamp))'
                    ),
                    array(
                        'name' => 'GCCA_Id',
                        'header' => 'Agencia',
                        'value' => '(isset($data->gCCA->GCCA_Id))? $data->GCCA_Id." - ".$data->gCCA->concatened: "-"'
                    ),
                    array(
                        'header' => 'Total Activos',
                        'type' => 'raw',
                        'value' =>  (isset($data->gCCA->GCCA_Id) && $data->gCCA->GCCA_Id != "-")?'
                       
                        CHtml::link(
                                $data->FCCO_Id, 
                               
                                Yii::app()->createUrl(
                                    "fcco/viewSalidaDia", 
                                    array(
                                        "tipo" => ' . $model->FCCN_Id . ',
                                        "agencia" => (isset($data->gCCA->GCCA_Id))? $data->gCCA->GCCA_Id:"-",
                                        "view" => 1,
                                        "desde" => "' . $model->desde . '",
                                        "hasta" => "' . $model->hasta . '"
                                    )
                                ),
                                array(
                                    "ajax" => array(
                                        "type" => "GET",
                                        "url" => "js:$(this).attr(\'href\')",
                                        "update" => "#ticketVirtual",
                                        "beforeSend" => "function(){
                                            $(\'#modal-1\').modal(\'show\');
                                            $(\'#ticketVirtual\').html(\'<div class=\"progress progress-striped active\"><div class=\"progress-bar\" role=\"progressbar\" aria-valuenow=\"100\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 100%\"<span class=\"sr-only\"></span></div></div>\');
                                        }",
                                        "complete" => "function(){
                                            $(\'#ticketVirtual\').removeClass(\'loading\');
                                        }",
                                    )
                                )
                            )':'$data->FCCO_Id',
                    ),
                ),
            ));
            ?>





            <!--  <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Agencia</th>
                        <th>Total Activos</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                  //  foreach ($agencias as $value) {
                        // echo $value['FCCO_Timestamp'];
                        // echo $value['GCCA_Id'];
                    ?>
                        <tr>
                            <th scope="row"><?php //echo date("d M", strtotime($value['FCCO_Timestamp'])) ?></th>
                            <td><?php //echo $value->gCCA->concatened; ?></td>
                            <td><?php /* echo CHtml::link(
                                    $value['FCCO_Id'],
                                    array(
                                        'viewSalidaDia',
                                        "tipo" => $model->FCCN_Id,
                                        "agencia" => $value->gCCA->GCCA_Id,
                                        "view" => 1,
                                        "desde" => $model->desde,
                                        "hasta" => $model->hasta
                                    ),
                                    array(
                                        'ajax' => array(
                                            'type' => 'GET',
                                            // ajax post will use 'url' specified above 
                                            'url' => "js:$(this).attr('href')",
                                            'update' => '#ticketVirtual',
                                            'beforeSend' => "function(){                                
                                $('#modal-1').modal('show');
                                $('#ticketVirtual').html('<div class=\"progress progress-striped active\"><div class=\"progress-bar\" role=\"progressbar\" aria-valuenow=\"100\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 100%\"><span class=\"sr-only\">45% Complete</span></div></div>');                                      
                                }",
                                            'complete' => "function(){
                                    $('#ticketVirtual').removeClass('loading');                                 
                                }",
                                        ),
                                    )
                                );*/ ?></td>
                        </tr>

                    <?php
                 //   }
                    ?>
                </tbody>
            </table>-->


        </div>
        <!-- <div role="tabpanel" class="tab-pane" id="messages">...</div> -->
        <!-- <div role="tabpanel" class="tab-pane" id="settings">...</div> -->
    </div>

</div>