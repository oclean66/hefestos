<?php
/* @var $this FccoController */
/* @var $model Fcco */

$this->breadcrumbs = array(
    'Fccos' => array('index'),
    'Administrar',
);


$this->menu = array(
    array('label' => 'Ver grupo Padre', 'url' => CController::createUrl('grupo', array('id' => $agencia->GCCD_Id, 'type' => 1))),
    array(
        'label' => 'Ver Datos de Agencia', 
        'linkOptions'=>array('target'=>'_blank'),
        'url' => CController::createUrl('gcca/view', array('id' => $agencia->GCCA_Id))
    ),
    array('label' => 'Asignar Activos', 'url' => array('create')),
    array('label' => 'Administrar Agencias', 'url' => CController::createUrl('gcca/admin')),
    array('label' => 'Actualizar Agencia', 'url' => CController::createUrl('gcca/update', array('id' => $agencia->GCCA_Id))),
    array('label' => '<i class="fa fa-print" aria-hidden="true"></i> Imprimir <span class="label label-warning">NUEVO</span>', 'url' => array('agencia', 'id' => $agencia->GCCA_Id, 'print'=>true), 'linkOptions'=>array('target'=>'_blank', 'class'=>'active not-link')),
);
foreach ($count as $key => $value) {
    $this->widget[] = array('label' => $key, 'data' => $value[$key][0]);
}

?>

                        <!-- Informacion Basica  -->

<div class="row">
    <div class="col-sm-8">
        <div class="box box-bordered box-color print" >
            <div class="box-title" style="">
                <h3>
                    
                    <i class="fa fa-th-list"></i>Agencia <?php echo $agencia->concatened; ?>
                </h3>
            </div>


                <?php $this->widget('zii.widgets.CDetailView', array(
                    'data'=>$agencia,
                        'id'=>'view',
                        'htmlOptions' => array('class' => 'table table-hover table-nomargin table-condensed', 'style' => ''),
                    'attributes'=>array(
                        //'GCCA_Id',
                        
                        'GCCA_Cod',
                        'GCCA_Nombre',
                        array('name'=>'GCCD_Id','value'=>$agencia->gCCD->concatened),
                        'GCCA_Direccion',
                        // 'GCCA_Status',
                        array('name'=>'GCCA_Status','value'=>$agencia->GCCA_Status==1?"Activva":"Inactiva"),
                        'GCCA_Rif',
                        'GCCA_Responsable',
                        'GCCA_Telefono',
                    ),
                    )); 
                ?>
        </div>
    </div>
</div>




<div id="modal-1" class="modal fade" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content" >				
            <!-- /.modal-header -->
            <div class="modal-body" id="modal-body">
                 <div id="ticketVirtual" class="span3"  style="min-height: 100px; width: 96%;" ></div>
            </div>
            <!-- /.modal-body -->
           

            <!-- /.modal-footer -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- <button data-id="<?php echo $agencia->GCCA_Id;?>" class="btn btn-xs btn-success">Activar</button>
<button data-id="<?php echo $agencia->GCCA_Id;?>" class="btn btn-xs btn-info">Ocultar</button>
<button data-id="<?php echo $agencia->GCCA_Id;?>" class="btn btn-xs btn-danger">Desactivar</button> -->
<!-- <a target="_blank" href="<?php echo Yii::app()->createUrl('gcca/update',array('id'=>$agencia->GCCA_Id));?>" class="btn btn-xs btn-primary pull-right">Editar</a> -->



                        <!-- Activos Asignados -->
<div class="box box-bordered box-color hidden-print">
    <div class="box-title">
        <a target="_blank" href="<?php echo Yii::app()->createUrl("gcca/view",array("id"=>$agencia->GCCA_Id))?>">
            <h3>
                <i class="fa fa-th-list"></i>Agencia <?php  echo Yii::app()->session['desc'] = $agencia->concatened; ?> // Activos Asignados
            </h3>
        </a>
    </div>
    <div class="box-content nopadding">


        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'fcco-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'itemsCssClass' => 'table table-striped table-bordered table-hover table-invoice',
            'pagerCssClass' => 'table-pagination',
            'htmlOptions' => array('style' => 'overflow:auto'),
            'pager' => array(
                'htmlOptions' => array('class' => 'pagination'),
                'selectedPageCssClass' => 'active',
            ),
            'columns' => array(
                array('name' => 'FCCO_Timestamp', 
                'header' => 'Fecha de Asignacion',
                'type'=>'raw',
                'value'=>'date("d M Y" , strtotime($data->FCCO_Timestamp))."<br/>".date("h:i:s A" , strtotime($data->FCCO_Timestamp))'),
                 
                array('name' => 'FCCU_Serial', 'header' => 'Serial', 
                'value' => '$data->fCCU->FCCU_Serial'),
                //verificacion
                // array('name' => 'GCCA_Id', 'header' => 'Agencia','visible'=>Yii::app()->user->isSuperAdmin),
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
                    //'htmlOptions'=>array('class'=>'btn btn-primary'),
                    'template' => '{preview}{recibe}',                                        
                    //-----------------------------------------------------------------------
                    'buttons' => array(
                        'preview' =>
                        array(
                            'label'=>'Ver Ticket',
                            'url' => 'Yii::app()->createUrl("fcco/view",array("id"=>$data->FCCO_Lote,"tipo"=>1,"view"=>1,"agencia"=>'.$agencia->GCCA_Id.'))',
                            'imageUrl'=>Yii::app()->theme->baseUrl . "/img/page.png",
                            'options' => array(
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
                        
                       'recibe' => array(
                            'label' => 'Recibir', // text label of the button
                            'url' => 'Yii::app()->createUrl("fcco/recibe",array("id"=>$data->FCCU_Id))', // a PHP expression for generating the URL of the button
                            'imageUrl' => Yii::app()->theme->baseUrl.'/img/computer_go.png', // image URL of the button. If not set or false, a text link is used
                                //'visible' =>'$data->FCCI_Id==5?true:false', // a PHP expression for determining whether the button is visible
                        ),
                    ),
                        //-----------------------------------------------------------------------
                ),
            ),
        ));
        ?>

    </div>
</div>



                        <!-- Historial de Asignaciones Previas -->


<div class="box box-bordered box-color print">
    <div class="box-title">
        <a>
            <h3><i class="fa fa-search"></i>
               Historial de Asignaciones Previas
            </h3>
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
					array('name' => 'FCCO_Timestamp', 'header' => 'Fecha de Asignacion','value'=>'date("d M Y h:i:s A" , strtotime($data->FCCO_Timestamp))'),
					
					array('name' => 'FCCU_Serial', 'header' => 'Serial', 'value' => '$data->fCCU->FCCU_Serial'),
					//verificacion
					// array('name' => 'GCCA_Id', 'header' => 'Agencia','visible'=>Yii::app()->user->isSuperAdmin),
					
					array(
						'name' => 'FCCN_Id', 
						// 'header' => 'Operacion',
						'value'=>'$data->FCCN_Id==1?"Salida":"Entrada"',
						'filter'=>array('' => 'Todos', '2' => 'Entrada', '1' => 'Salida')
						// 'visible'=>Yii::app()->user->isSuperAdmin
					),

					// array('name' => 'FCCO_Enabled','visible'=>Yii::app()->user->isSuperAdmin),

					array(
						'value'=>'"<b>".$data->gCCA->gCCD->concatened."</b><br/><small>".$data->gCCD->concatened."</small>"',
						'header'=>'Grupo Incorrecto',
						'type'=>'raw',
						// 'headerHtmlOptions'=>array('style'=>'width:200px'),
						'visible'=>Yii::app()->user->isSuperAdmin
					),
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
						//-----------------------------------------------------------------------
						'buttons' => array(
							'preview' =>
							array(
								'label'=>'Ver Ticket',
								// 'visible'=>'$data->FCCN_Id==1?true:false',
								'url' => 'Yii::app()->createUrl("fcco/view",array("id"=>$data->FCCO_Lote,"tipo"=>$data->FCCN_Id,"view"=>1, "agencia"=>"'.$model->GCCA_Id.'"))',
								'imageUrl'=>Yii::app()->theme->baseUrl . "/img/page.png",
								'options' => array(
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
							
						'recibe' => array(
								'visible'=>'$data->FCCN_Id==1?true:false',
								'label' => 'Recibir', // text label of the button
								'url' => 'Yii::app()->createUrl("fcco/recibe",array("id"=>$data->FCCU_Id))', // a PHP expression for generating the URL of the button
								'imageUrl' => Yii::app()->theme->baseUrl.'/img/computer_go.png', // image URL of the button. If not set or false, a text link is used
									//'visible' =>'$data->FCCI_Id==5?true:false', // a PHP expression for determining whether the button is visible
							),
						),
							//-----------------------------------------------------------------------
					),
				),
			));
			?>

    </div>
</div>