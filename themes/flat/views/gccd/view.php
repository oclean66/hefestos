<?php
/* @var $this GccdController */
/* @var $model Gccd */
$xx = Yii::app()->user->checkAccess('action_gccd_assign') ?
    CHtml::link(
        $model->GCCD_Estado == 1 ? "<i class='fa fa-check'></i>Activo" : ($model->GCCD_Estado == 2 ? "<i class='fa fa-eye-slash'></i> Oculto" : "<i class=\"fa fa-times\"></i> Inactivo"),
        '#',
        array(
            'class' => 'btn btn-mini',
            'id' => 'grupobtn',
            'name' => 'grupobtn',
            'onClick' => CHtml::ajax(
                array(
                    'type' => 'GET',
                    'url' => array("gccd/assign", 'val1' => $model->GCCD_Id),
                    'beforesend' => "function(){
                $('#grupobtn').prop('disabled', true);                                
                
            }",
                    'success' => "function( data ){
                $('#grupobtn').html(data);                                        
                $('#grupobtn').prop('disabled', false);                                
            }",
                )
            ),
        )
    ) : '';



$this->menu = array(
	//array('label'=>'List Gccd', 'url'=>array('index')),
	array('label' => 'Crear Grupo', 'url' => array('create')),
	array('label' => 'Actualizar Grupo', 'url' => array('update', 'id' => $model->GCCD_Id)),
	array('label' => 'Borrar Grupo', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->GCCD_Id), 'confirm' => 'Are you sure you want to delete this item?')),
	array('label' => 'Administrar Grupo', 'url' => array('admin')),
);
?>

<div class="row">
	<!-- Cabecera -->
	<div class="col-sm-12">
		<div class="box ">
			<div class="box-title">
				<h3>

					<!-- <i class="fa fa-view"></i>-->
					<i class="fa fa-users"></i>
					GRUPO <?php echo $model->concatened; ?>
				</h3>
				<!-- <br /> -->

				<div class="actions">

					<?php echo $xx; ?>

				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-6 ">
		<div class="box box-bordered box-small green box-color">
			<div class="box-title nomargin">
				<h3>
				<i class="fa fa-th-list"></i> Datos Basicos
				</h3>
			</div>


			<?php $this->widget('zii.widgets.CDetailView', array(
				'data' => $model,
				'id' => 'view',
				'htmlOptions' => array('class' => 'table table-hover table-nomargin table-condensed'),
				'attributes' => array(
					'GCCD_Id',
					'GCCD_Cod',
					'GCCD_Nombre',
					array('name' => 'GCCD_IdSuperior', 'value' => isset($model->GCCD_IdSuperior) ? $model->gCCDIdSuperior->concatened : "Sin Padre"),

					array(
						'name' => 'GCCD_Estado',
						'value' => $model->GCCD_Estado == 1 ? "Activa" : ($model->GCCD_Estado == 2 ? "Oculto": "Inactivo")
					),
					'GCCD_Responsable',
					'GCCD_Telefono',
				),
			)); ?>
		</div>
	</div>
</div>