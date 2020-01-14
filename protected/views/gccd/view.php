<?php
/* @var $this GccdController */
/* @var $model Gccd */

$this->breadcrumbs=array(
	'Gccds'=>array('index'),
	$model->GCCD_Id,
);

$this->menu=array(
	//array('label'=>'List Gccd', 'url'=>array('index')),
	array('label'=>'Crear Grupo', 'url'=>array('create')),
	array('label'=>'Actualizar Grupo', 'url'=>array('update', 'id'=>$model->GCCD_Id)),
	array('label'=>'Borrar Grupo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->GCCD_Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Grupo', 'url'=>array('admin')),
);
?>
<div class="box box-bordered box-color" >
    <div class="box-title" style="width:50%">
        <h3>
            <i class="fa fa-search"></i>

           Grupo #<?php echo $model->GCCD_Cod; ?>        </h3>
    </div>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'id'=>'view',
        'htmlOptions' => array('class' => 'table table-hover table-nomargin table-condensed', 'style' => 'width:50%'),
	'attributes'=>array(
		'GCCD_Id',
		'GCCD_Cod',
		'GCCD_Nombre',
		array('name'=>'GCCD_IdSuperior','value'=>isset($model->GCCD_IdSuperior)?$model->gCCDIdSuperior->concatened:"Sin Padre"),
		
		array('name' =>'GCCD_Estado',
				'value'=>$model->GCCD_Estado==1?"Activa":"Inactiva" ),
		'GCCD_Responsable',
		'GCCD_Telefono',
	),
)); ?>
 </div>