<?php
/* @var $this FcucController */
/* @var $model Fcuc */

$this->breadcrumbs=array(
	'Fcucs'=>array('index'),
	$model->FCUC_Id,
);

$this->menu=array(
	//array('label'=>'List Fcuc', 'url'=>array('index')),
	array('label'=>'Crear Fcuc', 'url'=>array('create')),
	array('label'=>'Actualizar Fcuc', 'url'=>array('update', 'id'=>$model->FCUC_Id)),
	array('label'=>'Borrar Fcuc', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->FCUC_Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Fcuc', 'url'=>array('admin')),
);
?>
<div class="box box-bordered box-color" >
    <div class="box-title" style="width:50%">
        <h3>
            <i class="fa fa-search"></i>

           View Fcuc #<?php echo $model->FCUC_Id; ?>        </h3>
    </div>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'id'=>'view',
        'htmlOptions' => array('class' => 'table table-hover table-nomargin table-condensed', 'style' => 'width:50%'),
	'attributes'=>array(
		'FCUC_Id',
		'FCUC_Timestamp',
		'FCUC_Monto',
		'FCCU_Id',
	),
)); ?>
 </div>