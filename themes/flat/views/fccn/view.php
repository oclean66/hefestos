<?php
/* @var $this FccnController */
/* @var $model Fccn */

$this->breadcrumbs=array(
	'Fccns'=>array('index'),
	$model->FCCN_Id,
);

$this->menu=array(
	//array('label'=>'List Fccn', 'url'=>array('index')),
	array('label'=>'Crear Operacion', 'url'=>array('create')),
	array('label'=>'Actualizar Operacion', 'url'=>array('update', 'id'=>$model->FCCN_Id)),
	array('label'=>'Borrar Operacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->FCCN_Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Operacion', 'url'=>array('admin')),
);
?>
<div class="box box-bordered box-color" >
    <div class="box-title" style="width:50%">
        <h3>
            <i class="fa fa-search"></i>

           Operacion #<?php echo $model->FCCN_Id; ?>        </h3>
    </div>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'id'=>'view',
        'htmlOptions' => array('class' => 'table table-hover table-nomargin table-condensed', 'style' => 'width:50%'),
	'attributes'=>array(
		'FCCN_Id',
		'FCCN_Operacion',
	),
)); ?>
 </div>