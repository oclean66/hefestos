<?php
/* @var $this FccoController */
// print_r($errores);
/* @var $model Fcco */
$botonEstado = Yii::app()->user->checkAccess('action_gcca_assign') ?
    CHtml::link(
        $agencia->GCCA_Status == 1 ?
            "<i class=\"fa fa-check\"></i> Activa" : ($agencia->GCCA_Status == 2 ? "<i class='fa fa-eye-slash'></i> Oculta" :
                "<i class=\"fas fa-print\"></i>  Inactiva"),
        '#',
        array(
            'class' => "btn not-link",
            'id' => 'agenciabtn',
            'name' => 'agenciabtn',
            'onClick' => CHtml::ajax(array(
                'type' => 'GET',
                'url' => array("gcca/assign", 'val1' => $agencia->GCCA_Id, 'val2' => $agencia->GCCD_Id),
                'beforeSend' => "function(){
                                $('#agenciabtn').prop('disabled', 'disabled');                                

                            }",
                'success' => "function( data ){
                                $('#agenciabtn').html(data);   
                                // $('#agenciabtn').prop('disabled', false);                                
                            }"
            ))
        )
    ) : '';


$this->breadcrumbs = array(
    'Fccos' => array('index'),
    'Administrar',
);


$this->menu = array(
    array(
        'label' => 'Ver Datos de Agencia',
        'linkOptions' => array('target' => '_blank'),
        'url' => CController::createUrl('gcca/view', array('id' => $agencia->GCCA_Id)),
        'visible' => Yii::app()->user->checkAccess("action_gcca_view")

    ),
    // array('label' => 'Ver Grupo Padre', 'url' => CController::createUrl('grupo', array('id' => $agencia->GCCD_Id, 'type' => 1))),
    // array('label' => 'Asignar Activos', 'url' => array('create')),

    array(
        'label' => 'Actualizar Agencia',
        'url' => array('gcca/update', 'id' => $model->GCCA_Id),
        'visible' => Yii::app()->user->checkAccess("action_gcca_update")
    ),
    array(
        'label' => 'Ocultar Agencia',
        'url' => '#',
        'linkOptions' => array(
            'submit' => array('gcca/delete', 'id' => $model->GCCA_Id),
            'confirm' => 'Seguro quieres OCULTAR esta agencia?'
        ),
        'visible' => Yii::app()->user->checkAccess("action_gcca_delete")
    ),
    array(
        'label' => 'Administrar Agencias',
        'url' => array('gcca/admin'),
        'visible' => Yii::app()->user->checkAccess("action_gcca_admin")
    ),

    array('label' => '<i class="fa fa-print" aria-hidden="true"></i> Imprimir <span class="label label-warning">NUEVO</span>', 'url' => array('agencia', 'id' => $agencia->GCCA_Id, 'print' => true), 'linkOptions' => array('target' => '_blank', 'class' => 'active not-link')),
);
foreach ($count as $key => $value) {
    $this->widget[] = array('label' => $key, 'data' => $value[$key][0]);
}
?>


<!-- Informacion Basica  -->

<div class="row">
    <div class="col-sm-12">
        <div class="box ">
            <div class="box-title">
                <h3>

                    <!-- <i class="fa fa-view"></i>-->
                    <i class="fa fa-desktop"></i>
                    AGENCIA <?php echo $agencia->concatened; ?>
                </h3>
                <!-- <br /> -->

                <div class="actions">

                    <?php echo $botonEstado; ?>
                    <?php echo Yii::app()->user->checkAccess('action_gcca_update') ?
                        CHtml::link(
                            '<i class="fa fa-pencil"></i> Editar',
                            array('/gcca/update', 'id' => $model->GCCA_Id),
                            array('class' => 'btn btn-success btn-mini', 'target' => '_blank')
                        ) :
                        "";
                    ?>

                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6" style="margin-bottom: 5px;">
        <div class="box box-bordered box-color box-small print">
            <div class="box-title nomargin">
                <h3><i class="fa fa-th-list"></i> Datos Basicos</h3>
            </div>


            <?php $this->widget('zii.widgets.CDetailView', array(
                'data' => $agencia,
                'id' => 'view',
                'htmlOptions' => array('class' => 'table table-hover table-nomargin table-condensed', 'style' => ''),
                'attributes' => array(
                    //'GCCA_Id',

                    'GCCA_Cod',
                    'GCCA_Nombre',
                    array('name' => 'GCCD_Id', 'value' => $agencia->gCCD->concatened),
                    'GCCA_Direccion',
                    // 'GCCA_Status',
                    array(
                        'name' => 'GCCA_Status', 'value' => $agencia->GCCA_Status == 1 ? "Activa" : ($agencia->GCCA_Status == 2 ? "Oculta" : "Inactiva")
                    ),
                    'GCCA_Rif',
                    'GCCA_Responsable',
                    'GCCA_Telefono',
                ),
            ));
            ?>
        </div>
    </div>
    <div class="col-sm-6 " style="margin-top: 0px;">

        <div class="box box-color box-bordered orange box-small">
            <div class="box-title" style="margin: 0;">

                <ul class="tabs tabs-left">
                    <li class="active">
                        <a href="#t7" class='not-link' data-toggle="tab"><i class="fa fa-comment"></i> Comentarios</a>
                    </li>
                    <li class="">
                        <a href="#t8" class='not-link' data-toggle="tab"><i class="fa fa-bullhorn"></i> Actualizaciones</a>
                    </li>

                </ul>
            </div>
            <div class="box-content">
                <div class="tab-content">
                    <div class="tab-pane active" id="t7">
                        <div id="activity" style="padding:0;min-height:165px;max-height: 165px;overflow: auto;">

                            <table class="table table-nohead" id="activityTable">
                                <tbody>
                                    <?php foreach ($agencia->comments as $value) {
                                        echo "<tr><td><b>" . date("d M H:i", strtotime($value->PCUE_Date)) . ": </b> " . $value->PCUE_Descripcion . " - " . $value->PCUE_Detalles . "</td></tr>";
                                    } ?>

                                </tbody>
                            </table>
                        </div>
                        <form action="<?php echo Yii::app()->createUrl('/fcco/agencia', array('id' => $agencia->GCCA_Id, 'type' => 1)); ?>" method="POST" class="form-vertical">
                            <div class="form-group" style="padding:0px; margin:0; margin-top:5px">

                                <div class="input-group">

                                    <input id="comentInput" name="comment" type="text" placeholder="Escribe un comentario.." value="" class="form-control">
                                    <div class="input-group-btn">
                                        <button id="commentSend" class="btn btn-success" type="submit">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="t8">
                        <div id="alerts" style="padding:0;min-height:200px;max-height: 200px;overflow: auto;">
                            <table class="table table-nohead" id="aletsTable">
                                <tbody>
                                    <?php foreach ($agencia->alerts as $value) {
                                        echo "<tr><td><b>" . date("d M H:i", strtotime($value->PCUE_Date)) . ": </b> " . $value->PCUE_Descripcion . " - " . $value->PCUE_Detalles . "</td></tr>";
                                    } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="box box-color box-bordered orange box-small">
            <div class="box-title " style="margin: 0;">
                <h3>
                    <i class="fa fa-bullhorn"></i> Actividad Reciente
                </h3>

            </div>
            <div class="box-content" id="activity" style="padding:0;min-height:165px;max-height: 165px;overflow: auto;">
                <table class="table table-nohead" id="activityTable">
                    <tbody>
                        <?php foreach ($agencia->comments as $value) {
                            echo "<tr><td><b>" . date("d M H:i", strtotime($value->PCUE_Date)) . ": </b> " . $value->PCUE_Descripcion . " - " . $value->PCUE_Detalles . "</td></tr>";
                        } ?>

                    </tbody>
                </table>

            </div>
            <form action="<?php echo Yii::app()->createUrl('/fcco/agencia', array('id' => $agencia->GCCA_Id, 'type' => 1)); ?>" method="POST" class="form-vertical" style="border-left:2px solid #f8a31f; border-right:2px solid #f8a31f; border-bottom:2px solid #f8a31f">
                <div class="form-group" style="padding:5px; margin:0">

                    <div class="input-group">

                        <input id="comentInput" name="comment" type="text" placeholder="Escribe un comentario.." value="" class="form-control">
                        <div class="input-group-btn">
                            <button id="commentSend" class="btn btn-success" type="submit">Enviar</button>
                        </div>
                    </div>
                </div>
            </form>

        </div> -->

    </div>

    <div class="col-sm-12 hide" style="display: table-row-group;">
        <ul class="stats" style="width: 100%; display:flow-root;margin:15px">
            <li class="blue" style="width: 150px;margin-right:5px; margin-bottom:5px">
                <i class="fa fa-shopping-cart"></i>
                <div class="details">
                    <span class="big">75</span>
                    <span>Equipos</span>
                </div>
            </li>
            <li class="blue" style="width: 150px;margin-right:5px; margin-bottom:5px">
                <i class="fa fa-shopping-cart"></i>
                <div class="details">
                    <span class="big">75</span>
                    <span>Equipos</span>
                </div>
            </li>
            <li class="green" style="width: 150px;margin-right:5px; margin-bottom:5px">
                <i class="fa fa-money"></i>
                <div class="details">
                    <span class="big">24</span>
                    <span>Conexiones</span>
                </div>
            </li>
            <li class="orange" style="width: 150px;margin-right:5px; margin-bottom:5px">
                <i class="fa fa-calendar"></i>
                <div class="details">
                    <span class="big">0</span>
                    <span>Publicidad</span>
                </div>
            </li>
        </ul>
    </div>

    <div class="col-sm-12">

        <!-- Activos Asignados -->
        <div class="box box-bordered box-color box-small hidden-print">
            <div class="box-title" style="margin-top: 0;">
                <a target="_blank" href="<?php echo Yii::app()->createUrl("gcca/view", array("id" => $agencia->GCCA_Id)) ?>">
                    <h3>
                        <i class="fa fa-th-list"></i>Activos Asignados Actualmente
                    </h3>
                </a>
            </div>

            <div class="box-content nopadding">

                <div class="col-sm-12" style="padding: 0; margin:0;">


                    <?php
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'id' => 'fcco-grid',
                        'dataProvider' => $model->search(),
                        'filter' => $model,
                        'itemsCssClass' => 'table table-striped table-bordered table-hover table-invoice',
                        'pagerCssClass' => 'table-pagination',
                        'htmlOptions' => array('style' => 'overflow:auto; padding:0'),
                        'pager' => array(
                            'htmlOptions' => array('class' => 'pagination'),
                            'selectedPageCssClass' => 'active',
                        ),
                        'columns' => array(
                            array(
                                'name' => 'FCCO_Timestamp',
                                'header' => '',
                                'type' => 'raw',
                                'value' => '"<button class=\'btn btn-orange\'>".(++$row)."</button>"',
                                'filter' => false
                            ),
                            array(
                                'name' => 'FCCO_Timestamp',
                                'header' => 'Fecha de Asignacion',
                                'type' => 'raw',
                                'value' => 'date("d M Y" , strtotime($data->FCCO_Timestamp))."<br/>".date("h:i:s A" , strtotime($data->FCCO_Timestamp))'
                            ),

                            array(
                                'name' => 'FCCU_Serial', 'header' => 'Serial',
                                'value' => '$data->fCCU->FCCU_Serial'
                            ),
                            //verificacion
                            array('name' => 'GCCA_Id', 'header' => 'Agencia', 'visible' => Yii::app()->user->isSuperAdmin),
                            array('name' => 'GCCD_Id', 'header' => 'Grupo', 'visible' => Yii::app()->user->isSuperAdmin),
                            // array('name' => 'FCCN_Id', 'header' => 'tipo','visible'=>Yii::app()->user->isSuperAdmin),
                            // array('name' => 'FCCO_Enabled','visible'=>Yii::app()->user->isSuperAdmin),
                            // array(
                            //     'value'=>'"<b>".$data->gCCA->gCCD->concatened."</b><br/><small>".$data->gCCD->concatened."</small>"',
                            //     'header'=>'Grupo Incorrecto',
                            //     'type'=>'raw',
                            //     // 'headerHtmlOptions'=>array('style'=>'width:200px'),
                            //     'visible'=>Yii::app()->user->isSuperAdmin
                            // ),
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
                            array(
                                'name' => 'FCCA_Descripcion', 'header' => 'Tipo',
                                'filter' => CHtml::activeTextField($model, 'FCCA_Descripcion'),
                                'value' => '$data->fCCU->fCCT->fCCA->FCCA_Descripcion',
                            ),
                            array(
                                'name' => 'FCCT_Descripcion', 'header' => 'Modelo',
                                'filter' => CHtml::activeTextField($model, 'FCCT_Descripcion'),
                                'value' => '$data->fCCU->fCCT->FCCT_Descripcion',
                            ),
                            //array('name' => 'FCCO_Lote', 'type' => 'raw',
                            //'value' => 'CHtml::Link("Ver Ticket: ".$data->FCCO_Lote, "#modal-1",'
                            //. 'array("role"=>"button", "class"=>"btn", "data-toggle"=>"modal","href"=>"#modal-1"))',
                            //),
                            array(
                                'class' => 'CButtonColumn',
                                'header' => 'Accion',
                                'headerHtmlOptions' => array('style' => 'width:75px'),
                                //'htmlOptions'=>array('class'=>'btn btn-primary'),
                                'template' => '<div class="btn-group">
                                      {preview}
                                      {recibe}
                                    </div>',
                                //-----------------------------------------------------------------------
                                'buttons' => array(
                                    'preview' =>
                                    array(
                                        'label' => 'Ver Ticket',

                                        'url' => 'Yii::app()->createUrl("fcco/view",array("id"=>$data->FCCO_Lote,"tipo"=>1,"view"=>1,"agencia"=>' . $agencia->GCCA_Id . '))',
                                        // 'imageUrl' => Yii::app()->theme->baseUrl . "/img/page.png",
                                        'imageUrl' => false,
                                        'label' => '<i class="fa fa-file"></i>',

                                        'options' => array(
                                            'class' => 'not-link btn btn-sm btn-orange',
                                            'title' => 'Ver Ticket',
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
                                        ),
                                    ),

                                    'recibe' => array(
                                        // 'label' => 'Recibir', // text label of the button
                                        'url' => 'Yii::app()->createUrl("fcco/recibe",array("id"=>$data->FCCU_Id))', // a PHP expression for generating the URL of the button
                                        // 'imageUrl' => Yii::app()->theme->baseUrl . '/img/computer_go.png', // image URL of the button. If not set or false, a text link is used
                                        'imageUrl' => false,
                                        'label' => '<i class="fa fa-reply"></i>',
                                        'visible' => 'Yii::app()->user->checkAccess("action_fcco_recibe")',
                                        //'visible' =>'$data->FCCI_Id==5?true:false', // a PHP expression for determining whether the button is visible
                                        'options' => array(
                                            // 'target' => '_blank', 
                                            'class' => 'not-link btn btn-sm btn-red',
                                            'title' => 'Recibir'
                                        ),
                                    ),
                                ),
                                //-----------------------------------------------------------------------
                            ),
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>


        <!-- Historial de Asignaciones Previas -->


        <div class="box box-bordered box-color box-small green print">
            <div class="box-title">
                <a>
                    <h3><i class="fa fa-search"></i>
                        Historial de Asignaciones Previas
                    </h3>
                    <div class="actions">
                        <a class='btn btn-sm' href="<?php echo Yii::app()->createUrl('gcca/view', array('id' => $model->GCCA_Id, 'excel' => true)) ?>">
                            <i class="fa fa-download"></i> Descargar </a>

                    </div>
                </a>
            </div>
            <div class="box-content nopadding">
                <?php
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'fcco-grid',
                    'dataProvider' => $modelos->search(),
                    'filter' => $modelos,
                    'itemsCssClass' => 'table table-striped table-bordered table-hover table-invoice',
                    'pagerCssClass' => 'table-pagination',
                    'htmlOptions' => array('style' => 'overflow:auto'),
                    'pager' => array(
                        'htmlOptions' => array('class' => 'pagination'),
                        'selectedPageCssClass' => 'active',
                    ),
                    'columns' => array(
                        array('name' => 'FCCO_Timestamp', 'header' => 'Fecha de Asignacion', 'value' => 'date("d M Y h:i:s A" , strtotime($data->FCCO_Timestamp))'),

                        array('name' => 'FCCU_Serial', 'header' => 'Serial', 'value' => '$data->fCCU->FCCU_Serial'),
                        //verificacion
                        // array('name' => 'GCCA_Id', 'header' => 'Agencia','visible'=>Yii::app()->user->isSuperAdmin),

                        array(
                            'name' => 'FCCN_Id',
                            // 'header' => 'Operacion',
                            'value' => '$data->FCCN_Id==1?"Salida":"Entrada"',
                            'filter' => array('' => 'Todos', '2' => 'Entrada', '1' => 'Salida')
                            // 'visible'=>Yii::app()->user->isSuperAdmin
                        ),

                        // array('name' => 'FCCO_Enabled','visible'=>Yii::app()->user->isSuperAdmin),

                        // array(
                        //     'value' => '"<b>".$data->gCCA->gCCD->concatened."</b><br/><small>".$data->gCCD->concatened."</small>"',
                        //     'header' => 'Grupo Incorrecto',
                        //     'type' => 'raw',
                        //     // 'headerHtmlOptions'=>array('style'=>'width:200px'),
                        //     'visible' => Yii::app()->user->isSuperAdmin
                        // ),
                        //campos de busqueda relacionada
                        array(
                            'name' => 'FCCU_Numero', 'header' => 'Numero',
                            'filter' => CHtml::activeTextField($modelos, 'FCCU_Numero'),
                            'value' => '!isset($data->fCCU->FCCU_Numero)?"No aplica":$data->fCCU->FCCU_Numero',
                        ),
                        array(
                            'name' => 'FCUU_Descripcion', 'header' => 'Categoria',
                            'filter' => CHtml::activeTextField($modelos, 'FCUU_Descripcion'),
                            'value' => '$data->fCCU->fCCT->fCCA->fCUU->FCUU_Descripcion',
                        ),
                        array(
                            'name' => 'FCCA_Descripcion', 'header' => 'Tipo',
                            'filter' => CHtml::activeTextField($modelos, 'FCCA_Descripcion'),
                            'value' => '$data->fCCU->fCCT->fCCA->FCCA_Descripcion',
                        ),
                        array(
                            'name' => 'FCCT_Descripcion', 'header' => 'Modelo',
                            'filter' => CHtml::activeTextField($modelos, 'FCCT_Descripcion'),
                            'value' => '$data->fCCU->fCCT->FCCT_Descripcion',
                        ),
                        //array('name' => 'FCCO_Lote', 'type' => 'raw',
                        //'value' => 'CHtml::Link("Ver Ticket: ".$data->FCCO_Lote, "#modal-1",'
                        //. 'array("role"=>"button", "class"=>"btn", "data-toggle"=>"modal","href"=>"#modal-1"))',
                        //),
                        array(
                            'class' => 'CButtonColumn',
                            'header' => 'Accion',
                            //'htmlOptions'=>array('class'=>'btn btn-primary'),
                            'template' => '{preview}{recibe}',
                            'template' => '{preview}',
                            //-----------------------------------------------------------------------
                            'buttons' => array(
                                'preview' =>
                                array(
                                    'label' => 'Ver Ticket',
                                    // 'visible'=>'$data->FCCN_Id==1?true:false',
                                    'url' => 'Yii::app()->createUrl("fcco/view",array("id"=>$data->FCCO_Lote,"tipo"=>$data->FCCN_Id,"view"=>1, "agencia"=>"' . $model->GCCA_Id . '"))',
                                    'imageUrl' => Yii::app()->theme->baseUrl . "/img/page.png",
                                    'imageUrl' => false,
                                    'label' => '<i class="fa fa-file"></i>',

                                    'options' => array(
                                        'class' => 'not-link btn btn-sm btn-orange',
                                        'title' => 'Ver Ticket',
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
                                    ),
                                    //'options'=>array(
                                    //'class'=>'btn',
                                    //'id'=>$data->FCCO_Lote
                                    //),
                                ),

                                // 'recibe' => array(
                                //     'visible' => '$data->FCCN_Id==1?true:false',
                                //     'label' => 'Recibir', // text label of the button
                                //     'url' => 'Yii::app()->createUrl("fcco/recibe",array("id"=>$data->FCCU_Id))', // a PHP expression for generating the URL of the button
                                //     'imageUrl' => Yii::app()->theme->baseUrl . '/img/computer_go.png', // image URL of the button. If not set or false, a text link is used
                                //     //'visible' =>'$data->FCCI_Id==5?true:false', // a PHP expression for determining whether the button is visible
                                // ),
                            ),
                            //-----------------------------------------------------------------------
                        ),
                    ),
                ));
                ?>

            </div>
        </div>
    </div>

</div>




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

<script>
    $('#activity').scrollTop($('#activityTable').height());
</script>