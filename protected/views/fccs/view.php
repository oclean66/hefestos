<?php
/* @var $this FccsController */
/* @var $model Fccs */

$this->breadcrumbs=array(
	'Fccs'=>array('index'),
	$model->FCCS_Id,
);

$this->menu=array(
	//array('label'=>'List Fccs', 'url'=>array('index')),
	array('label'=>'Crear Fccs', 'url'=>array('create')),
	array('label'=>'Actualizar Fccs', 'url'=>array('update', 'id'=>$model->FCCS_Id)),
	array('label'=>'Borrar Fccs', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->FCCS_Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Fccs', 'url'=>array('admin')),
);
?>
<div class="box box-bordered box-color" >
    <div class="box-title" style="width:50%">
        <h3>
            <i class="fa fa-search"></i>

           View Fccs #<?php echo $model->FCCS_Id; ?>        </h3>
    </div>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'id'=>'view',
        'htmlOptions' => array('class' => 'table table-hover table-nomargin table-condensed', 'style' => 'width:50%'),
	'attributes'=>array(
		'FCCS_Id',
		'FCCS_Fecha',
		'FCCS_Control',
	),
)); ?>
 </div>