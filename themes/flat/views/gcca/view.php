<?php
/* @var $this GccaController */
/* @var $model Gcca */
$botonEstado = Yii::app()->user->checkAccess('action_gcca_assign') ?
	CHtml::link(
		$model->GCCA_Status == 1 ?
			"<i class=\"fa fa-check\"></i> Activa" : (
				$model->GCCA_Status == 2 ? "<i class='fa fa-eye-slash'></i> Oculta" :
				"<i class=\"fas fa-print\"></i>  Inactiva"
			),
		'#',
		array(
			'class' => "btn not-link",
			'id' => 'agenciabtn',
			'name' => 'agenciabtn',
			'onClick' => CHtml::ajax(array(
				'type' => 'GET',
				'url' => array("gcca/assign", 'val1' => $model->GCCA_Id, 'val2' => $model->GCCD_Id),
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
	'Gccas' => array('index'),
	$model->GCCA_Id,
);

$this->menu = array(
	//array('label'=>'List Gcca', 'url'=>array('index')),
	array('label' => 'Crear Agencia', 'url' => array('create')),
	array('label' => 'Activos de Agencia', 'url' => Yii::app()->createUrl('fcco/agencia', array('id' => $model->GCCA_Id, 'type' => 1))),
	array('label' => 'Actualizar Agencia', 'url' => array('update', 'id' => $model->GCCA_Id)),
	array('label' => 'Borrar Agencia', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->GCCA_Id), 'confirm' => 'Are you sure you want to delete this item?')),
	array('label' => 'Administrar Agencias', 'url' => array('admin')),
);
?>
<div class="row">

	<!-- Alertas -->
	<!-- <div class="col-sm-12">
		<div class="alert alert-danger nomargin" style="margin-bottom:0; margin-top:10px;">
			<strong>Atencion! </strong>$error
		</div>
	</div> -->

	<!-- Cabecera -->
	<div class="col-sm-12">
		<div class="box ">
			<div class="box-title">
				<h3>

					<!-- <i class="fa fa-view"></i>-->
					<i class="fa fa-desktop"></i>
					AGENCIA <?php echo $model->concatened; ?>
				</h3>
				<!-- <br /> -->

				<div class="actions">

					<?php echo $botonEstado; ?>

				</div>
			</div>
		</div>
	</div>


	<div class="col-sm-6">
		<div class="box box-bordered box-color box-small print">
			<div class="box-title nomargin" style="">
				<h3>

					<i class="fa fa-th-list"></i>Datos Basicos
				</h3>
			</div>


			<?php $this->widget('zii.widgets.CDetailView', array(
				'data' => $model,
				'id' => 'view',
				'htmlOptions' => array('class' => 'table table-hover table-nomargin table-condensed', 'style' => ''),
				'attributes' => array(
					//'GCCA_Id',

					'GCCA_Cod',
					'GCCA_Nombre',
					array('name' => 'GCCD_Id', 'value' => $model->gCCD->concatened),
					'GCCA_Direccion',
					// 'GCCA_Status',
					array(
						'name' => 'GCCA_Status',
						'value' =>
						$model->GCCA_Status == 1 ? "Activa" : ($model->GCCA_Status == 2 ? "Oculta" : "Inactiva")
					),
					'GCCA_Rif',
					'GCCA_Responsable',
					'GCCA_Telefono',
				),
			));
			?>
		</div>
	</div>


</div>
<div class="box box-bordered box-color box-small green print">
	<div class="box-title">
		<a target="_blank" href="<?php echo Yii::app()->createUrl("fcco/agencia", array("id" => $model->GCCA_Id, "type" => "html")) ?>">
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
			'dataProvider' => $historial->search(),
			'filter' => $historial,
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

				array(
					'value' => '"<b>".$data->gCCA->gCCD->concatened."</b><br/><small>".$data->gCCD->concatened."</small>"',
					'header' => 'Grupo Incorrecto',
					'type' => 'raw',
					// 'headerHtmlOptions'=>array('style'=>'width:200px'),
					'visible' => Yii::app()->user->isSuperAdmin
				),
				//campos de busqueda relacionada
				array(
					'name' => 'FCCU_Numero', 'header' => 'Numero',
					'filter' => CHtml::activeTextField($historial, 'FCCU_Numero'),
					'value' => '!isset($data->fCCU->FCCU_Numero)?"No aplica":$data->fCCU->FCCU_Numero',
				),
				array(
					'name' => 'FCUU_Descripcion', 'header' => 'Categoria',
					'filter' => CHtml::activeTextField($historial, 'FCUU_Descripcion'),
					'value' => '$data->fCCU->fCCT->fCCA->fCUU->FCUU_Descripcion',
				),
				array(
					'name' => 'FCCA_Descripcion', 'header' => 'Tipo',
					'filter' => CHtml::activeTextField($historial, 'FCCA_Descripcion'),
					'value' => '$data->fCCU->fCCT->fCCA->FCCA_Descripcion',
				),
				array(
					'name' => 'FCCT_Descripcion', 'header' => 'Modelo',
					'filter' => CHtml::activeTextField($historial, 'FCCT_Descripcion'),
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
							'label' => 'Ver Ticket',
							// 'visible'=>'$data->FCCN_Id==1?true:false',
							'url' => 'Yii::app()->createUrl("fcco/view",array("id"=>$data->FCCO_Lote,"tipo"=>$data->FCCN_Id,"view"=>1, "agencia"=>"' . $model->GCCA_Id . '"))',
							'imageUrl' => Yii::app()->theme->baseUrl . "/img/page.png",
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
							'visible' => '$data->FCCN_Id==1?true:false',
							'label' => 'Recibir', // text label of the button
							'url' => 'Yii::app()->createUrl("fcco/recibe",array("id"=>$data->FCCU_Id))', // a PHP expression for generating the URL of the button
							'imageUrl' => Yii::app()->theme->baseUrl . '/img/computer_go.png', // image URL of the button. If not set or false, a text link is used
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