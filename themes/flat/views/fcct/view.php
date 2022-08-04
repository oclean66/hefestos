<?php
/* @var $this FcctController */
/* @var $model Fcct */

$this->breadcrumbs=array(
	'Fccts'=>array('index'),
	$model->FCCT_Id,
);

$this->menu=array(
	//array('label'=>'List Fcct', 'url'=>array('index')),
	array('label'=>'Crear Modelo', 'url'=>array('create')),
	array('label'=>'Actualizar Modelo', 'url'=>array('update', 'id'=>$model->FCCT_Id)),
	array('label'=>'Borrar Modelo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->FCCT_Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Modelos', 'url'=>array('admin')),
);
?>
<div class="box box-bordered box-color" >
    <div class="box-title" style="width:50%">
        <h3>
            <i class="fa fa-search"></i>

           Modelo #<?php echo $model->FCCT_Id; ?>        </h3>
    </div>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'id'=>'view',
        'htmlOptions' => array('class' => 'table table-hover table-nomargin table-condensed', 'style' => 'width:50%'),
	'attributes'=>array(
		'FCCT_Id',
		'FCCT_Descripcion',
		'FCCA_Id',
		'FCCT_Costo',
		'FCCT_Venta',
		array('name'=>'Total','value'=>$model->total),
	),
)); ?>
 </div>