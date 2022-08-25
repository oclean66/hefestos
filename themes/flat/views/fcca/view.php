<?php
/* @var $this FccaController */
/* @var $model Fcca */

$this->breadcrumbs=array(
	'Fccas'=>array('index'),
	$model->FCCA_Id,
);

$this->menu=array(
	//array('label'=>'List Fcca', 'url'=>array('index')),
	array('label'=>'Crear Tipo', 'url'=>array('create')),
	array('label'=>'Actualizar Tipo', 'url'=>array('update', 'id'=>$model->FCCA_Id)),
	array('label'=>'Borrar Tipo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->FCCA_Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Tipo', 'url'=>array('admin')),
);
?>
<div class="box box-bordered box-color" >
    <div class="box-title" style="width:50%">
        <h3>
            <i class="fa fa-search"></i>

            Tipo #<?php echo $model->FCCA_Id; ?>        </h3>
    </div>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'id'=>'view',
        'htmlOptions' => array('class' => 'table table-hover table-nomargin table-condensed', 'style' => 'width:50%'),
	'attributes'=>array(
		'FCCA_Id',
		'FCCA_Descripcion',
		array('name'=>'FCUU_Id','value'=>$model->fCUU->FCUU_Descripcion),
		
		array('name'=>'FCCA_StockMin', 'value'=>$model->FCCA_StockMin),
		array('name'=>'FCCA_StockMax', 'value'=>$model->FCCA_StockMax),
		array('name'=>'FCCA_Stock', 'value'=>$model->FCCA_Stock),
		array('name'=>'Total', 'value'=>$model->total),
		
		
		
	),
)); ?>
 </div>