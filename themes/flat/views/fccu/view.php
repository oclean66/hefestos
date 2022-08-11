<?php
/* @var $this FccuController */
/* @var $model Fccu */

$this->breadcrumbs = array(
    'Fccus' => array('index'),
    $model->FCCU_Id,
);

$this->menu = array(
    //array('label'=>'List Fccu', 'url'=>array('index')),
    array('label' => 'Crear Activo', 'url' => Yii::app()->createUrl("fccu/add")),

    array('label' => 'Actualizar Activo', 'url' => Yii::app()->createUrl("fccu/update", array("id" => $model->FCCU_Id,"view"=>'index'))),


    array(
        'label' => 'Recibir Activo',
        'url' => Yii::app()->createUrl('fccu/view', array('id' => $model->FCCU_Id)),
        'visible' => $model->FCCI_Id == 5 ? true : false, 'url' => '#',
        'linkOptions' => array(
            'submit' => array('recibe', 'id' => $model->FCCU_Id),
            'params' => array('returnUrl' => Yii::app()->createUrl('fccu/view', array('id' => $model->FCCU_Id))), 'confirm' => 'Seguro quiere recibir este activo?'
        )
    ),

    array('label' => 'Enviar A...', 'url' => Yii::app()->createUrl("tccd/create", array("id" => $model->FCCU_Id)),"visible"=>Yii::app()->user->checkAccess('action_tccd_create')),
);
?>
 

<?php if($view=='admin'){ ?>
<div class="box">
    <div class="box-title" style="margin: 0;">
        <h3>
            <i class="fa fa-thumb-tack"></i>Activo #<?php echo $model->FCCU_Serial; ?>
        </h3>
         
         <div class="actions">
            <?php if(!in_array($model->FCCI_Id,array(5,10,11,12))){ ?>
                <a class="not-link btn" href="javascript:loadpage('<?= Yii::app()->createUrl("fccu/update", array("id" => $model->FCCU_Id)) ?>','<?= $model->FCCU_Id ?>');">Actualizar Activo</a>
            <?php } ?>

            <?php if( $model->FCCI_Id == 5 || $model->FCCI_Id == 12 && !Yii::app()->user->rbac->isAssigned('receptor',Yii::app()->user->id) ){ ?>
            <a href="<?= Yii::app()->createUrl('fccu/recibe/', array('id' => $model->FCCU_Id)) ?>" class="btn">Recibir Activo</a>
            <?php } ?>

            
            <?php if(Yii::app()->user->checkAccess('action_tccd_create')){ ?>
            <a class="not-link btn" href="<?= Yii::app()->createUrl("tccd/create", array("id" => $model->FCCU_Id)) ?>" target="blank">Enviar A...</a>

            <?php } ?>
            <?php if(Yii::app()->user->checkAccess("action_fccu_delete") && ($model->FCCI_Id != 5 || $model->FCCI_Id == 12)){ ?>
                <a class="not-link btn" id="debaja" href="javascript:;">Dar de baja</a>

            <form action="<?= Yii::app()->createUrl("fccu/delete/",array("id"=>$model->FCCU_Id))?>" method="post" class="debaja" style="float: right;display:none;"> 
                <button type="submit"  class="not-link btn btn-sm btn-danger" > Dar de baja</button>
            </form>

            <?php } ?>

           


        </div>
    </div>
</div>
<?php } ?>
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

<?php
echo isset($_GET['alert']) ? "<div class='alert alert-danger'><b>ATENCION: </b> {$_GET['alert']}</div>" : "";
?>


<div class="row" style="margin-bottom:15px">
    <div class="col-sm-6">
        <div class="box box-bordered box-color box-small">
            <div class="box-title">

            </div>
            <?php
            $this->widget('ext.widgets.DetailView4Col', array(
                'data' => $model,
                'id' => 'view',
                'htmlOptions' => array(
                    'class' => 'table table-hover table-nomargin table-condensed ',
                    // 'style' => 'width:50%'
                ),
                'attributes' => array(
                    array(
                        'header' => "Datos de " . $model->fCCT->fCCA->fCUU->FCUU_Descripcion,
                    ),
                    array(
                        'name' => 'FCCU_Serial',
                        'oneRow' => $model->fCCT->fCCA->FCUU_Id == 1 ? true : false,
                    ),
                    array(
                        'name' => 'FCCU_Numero',
                        'value' => $model->FCCU_Numero,
                        'visible' => $model->fCCT->fCCA->FCUU_Id == 1 ? false : true,
                    ),
                    array(
                        'name' => 'FCCU_Timestamp',
                        'value' => date("d M Y h:i:s A", strtotime($model->FCCU_Timestamp))
                    ),
                    
                    array(
                        'name' => 'FCCI_Id',
                        'value' =>  ($model->FCCI_Id == 5 && Fcco::model()->find("FCCU_Id=" . $model->FCCU_Id . " and FCCN_Id = 1 and FCCO_Enabled = 1 order by FCCO_Id desc") ?
                            Fcco::model()->find("FCCU_Id=" . $model->FCCU_Id . " and FCCN_Id = 1 and FCCO_Enabled = 1 order by FCCO_Id desc")->lugar
                            : $model->fCCI->FCCI_Descripcion)
                    ),
                    array(
                        'name' => 'FCCU_Facturado',
                        'value' => $model->FCCU_Facturado == 0 ? "Sin Facturar" : "Facturado"
                    ),
                    'FCCU_Cantidad', 
                        array(
                            'name' => 'Costo',
                            'value' => $model->fCCT->FCCT_Costo,
                            'visible' => Yii::app()->user->rbac->isAssigned('receptor',Yii::app()->user->id) ? false : true,
                        ), 
                    array(
                        'name' => 'Precio',
                        'value' => $model->fCCT->FCCT_Venta
                    ),
                    array(
                        'name' => 'FCCT_Id',
                        'value' => $model->fCCT->fCCA->FCCA_Descripcion . " " . $model->fCCT->FCCT_Descripcion,
                        'oneRow' => true
                    ),
                   
                    array(
                        'name' => 'Etiquetas',
                        'value' => FcclHasFccu::model()->listLabel($model->FCCU_Id),
                        'oneRow' => true
                    ),
                    array(
                        'header' => 'Datos de la linea',
                        'visible' => $model->fCCT->fCCA->FCUU_Id == 2 ? true : false
                    ),
                    array(
                        'name' => 'FCCU_Titular',
                        'value' => $model->FCCU_Titular, 'oneRow' => true,
                        'visible' => $model->fCCT->fCCA->FCUU_Id == 2 ? true : false
                    ),
                    array(
                        'name' => 'FCCU_Cedula',
                        'value' => $model->FCCU_Cedula,
                        'visible' => $model->fCCT->fCCA->FCUU_Id == 2 ? true : false
                    ),
                    array(
                        'name' => 'FCCU_FechaNacimiento',
                        'value' => $model->FCCU_FechaNacimiento,
                        'visible' => $model->fCCT->fCCA->FCUU_Id == 2 ? true : false
                    ),
                    array(
                        'name' => 'FCCU_DiaCorte',
                        'value' => $model->FCCU_DiaCorte . " de cada mes",
                        'visible' => $model->fCCT->fCCA->FCUU_Id == 2 ? true : false
                    ),
                    array(
                        'name' => 'FCCU_MontoMin',
                        'value' => $model->FCCU_MontoMin . " Bs",
                        'visible' => $model->fCCT->fCCA->FCUU_Id == 2 ? true : false
                    ),
                    array(
                        'name' => 'FCCU_TipoServicio',
                        'value' => $model->FCCU_TipoServicio == 0 ? "No posee" : ($model->FCCU_TipoServicio == 1 ? "Prepago" : "Coorporativa"),
                        'visible' => $model->fCCT->fCCA->FCUU_Id == 2 ? true : false
                    ),
                    array(
                        'name' => 'FCCU_ClaveWeb',
                        'value' => $model->FCCU_ClaveWeb,
                        'visible' => $model->fCCT->fCCA->FCUU_Id == 2 ? true : false
                    ),
                    array(
                        'name' => 'FCCU_ClaveMovil',
                        'value' => $model->FCCU_ClaveMovil,
                        'visible' => $model->fCCT->fCCA->FCUU_Id == 2 ? true : false
                    ),
                    array(
                        'name' => 'FCCU_ClaveDatos',
                        'value' => $model->FCCU_ClaveDatos,
                        'visible' => $model->fCCT->fCCA->FCUU_Id == 2 ? true : false
                    ),
                    //-------------------------------------
                    array(
                        'name' => 'FCCU_Descripcion',
                        'value' => $model->FCCU_Descripcion, 'oneRow' => true
                    ),
                    array(
                        'name' => 'FCCU_Bussiness',
                        'value' => $model->FCCU_Bussiness, 'oneRow' => true
                    ),
                ),
            ));


            ?>
        </div>
    </div>


   <div class="row" style="margin-bottom:15px">
    <div class="col-sm-6">
        <div class="box box-bordered box-color box-small">
            <div class="box-title">

            </div>
            <div class="  nopadding">
                <ul class="tabs tabs-inline tabs-top">
                    <li class="active">
                        <a href="#first11" data-toggle="tab" class="not-link">
                            <i class="fa fa-bullhorn"></i> &nbsp;Actividad Reciente</a>
                    </li>
                    <li>
                        <a href="#second22" data-toggle="tab" class="not-link">
                            <i class="fa fa-share"></i> &nbsp; Historial del activo</a>
                    </li>
                </ul>
                <div class="tab-content  tab-content-inline tab-content-bottom">
                    <div class="tab-pane active" id="first11">
                        <!--ACTIVIDAD RECIENTE-->

                        <div id="activity" style="padding:0;min-height:270px;max-height: 270px;overflow: auto;">
                            <table class="table table-nohead" id="activityTable">
                                <tbody>
                                    <?php foreach ($model->comments as $value) {
                                        echo "<tr><td><b>" . date("d M H:i", strtotime($value->PCUE_Date)) . ": </b> " . $value->PCUE_Descripcion . " - " . $value->PCUE_Detalles . "</td></tr>";
                                    } ?>

                                </tbody>
                            </table>

                        </div>
                        <form action="<?php echo Yii::app()->createUrl('/fccu/view', array('id' => $model->FCCU_Id, 'type' => 1)); ?>" method="POST" class="form-vertical">
                            <div class="form-group" style="margin:0 !important">

                                <div class="input-group">

                                    <input id="comentInput" name="comment" type="text" placeholder="Escribe un comentario.." value="" class="form-control">
                                    <div class="input-group-btn">
                                        <button id="commentSend" class="btn btn-success" type="submit">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--ACTIVIDAD RECIENTE-->
                    </div>
                    <div class="tab-pane" id="second22">
                        <!------------------------------------------------------------------------------------------------>
                        <div id="activity" style="padding:0;min-height:270px;max-height: 270px;overflow: auto;">
                            <table class="table " id="activityTable">
                                <thead>
                                    <tr>
                                        <th>Tablero</th>
                                        <th>Tarea</th>
                                        <th>Descripcion</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($resumen as $value) { ?>
                                        <tr>
                                            <td><?= $value['tablero_name'] ?></td>
                                            <td><?= $value['tarea_name'] ?></td>
                                            <td><?= $value['desc_tarea'] ?></td>
                                            <td>
                                                <a href="<?php echo Yii::app()->createUrl('/tcca/' . $value['tablero_id']) . '?card=' . $value['tarea_id']; ?>" target="_blank" class="not-link">
                                                    <i class="fa fa-link"> </i>
                                                </a>
                                            </td>
                                        <tr>
                                        <?php } ?>

                                </tbody>
                            </table>

                        </div>
                        <!------------------------------------------------------------------------------------------------>
                    </div>

                </div>
            </div>
        </div>





    </div>

</div>

<?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'fcco-grid',
        'dataProvider' => $modelo->search(),
        'summaryText' => false,
        'filter' => null,
        'enableSorting' => false,
        'itemsCssClass' => 'table table-striped table-bordered table-hover table-invoice table-colored-header',
        'pagerCssClass' => 'table-pagination',
        'htmlOptions' => array('style' => 'overflow:auto'),
        'pager' => array(
            'htmlOptions' => array('class' => 'pagination'),
            'selectedPageCssClass' => 'active',
        ),
        'columns' => array(
            // 'FCCU_Id',
            // 'FCCO_Id',
            array(
                'name' => 'FCCO_Id',
                'header' => 'Lote',
            ),
            array(
                'name' => 'FCCO_Timestamp',
                'value' => 'date("d M Y h:i:s A", strtotime($data->FCCO_Timestamp))',
                'header' => 'Fecha de Asignacion'
            ),
            // array(
            //     'value'=>'"<b>".$data->gCCA->gCCD->concatened."</b><br/><small>".$data->gCCD->concatened."</small>"',
            //     'header'=>'Grupo Incorrecto',
            //     'type'=>'raw',
            //     // 'headerHtmlOptions'=>array('style'=>'width:200px'),
            //     'visible'=>Yii::app()->user->isSuperAdmin
            // ),

            array(
                //'value' => '$data->lugar',
                'value' => 'CHtml::link($data->lugar,Yii::app()->createUrl(\'fcco/agencia\',array(\'id\'=>$data->GCCA_Id,\'type\'=>1)))',
                'type' => 'raw',
                'header' => 'Grupo/Agencia'
            ),

            array(
                'name' => 'FCCN_Id',
                'header' => 'Operacion',
                'value' => '$data->fCCN->FCCN_Operacion'
            ),

            array(
                'name' => 'FCCN_Id',
                'header' => 'Usuario',
                'value' => '$data->username',

            ),
            'FCCO_Enabled',
            //array('name' => 'FCCO_Lote', 'type' => 'raw', 'header' => 'Ticket',
            //            'value' => 'CHtml::link("#".$data->FCCO_Lote)',
            //        ),
            array(
                'class' => 'CButtonColumn',
                'header' => 'Accion',
                //'htmlOptions'=>array('class'=>'btn btn-primary'),
                'template' => '{preview}',
                //-----------------------------------------------------------------------
                'buttons' => array(
                    'preview' => array(
                        'label' => 'Ver Ticket',
                        'url' => 'Yii::app()->createUrl("fcco/view",array("id"=>$data->FCCO_Lote,"tipo"=>$data->FCCN_Id,"view"=>1,"agencia"=>$data->GCCA_Id))',
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
                        //                                'class'=>'btn',
                        //                                'id'=>$data->FCCO_Lote
                        //                      ),
                    ),
                ),
                //-----------------------------------------------------------------------
            ),
        ),
    ));
?>
<script>
    $('#activity').scrollTop($('#activityTable').height());
    $(function(){
        $('#debaja').on('click',function(event){
            $.jAlert({
                'type': 'confirm',
                'confirmQuestion': '¿Esta seguro que desea dar de baja este activo?',
                'theme':'blue',
                'onConfirm': function(e, btn){
                    e.preventDefault();
                    $('.debaja').submit();
                    btn.parents('.jAlert').closeAlert();
                    return false;
                }
            });
            

        });
        
    });
    
</script>