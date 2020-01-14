<?php
/* @var $this FcciController */
/* @var $model Fcci */

$this->breadcrumbs=array(
	'Fccis'=>array('index'),
	$model->FCCI_Id,
);

$this->menu=array(
	//array('label'=>'List Fcci', 'url'=>array('index')),
	array('label'=>'Crear Fcci', 'url'=>array('create')),
	array('label'=>'Actualizar Fcci', 'url'=>array('update', 'id'=>$model->FCCI_Id)),
	array('label'=>'Borrar Fcci', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->FCCI_Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Fcci', 'url'=>array('admin')),
);
?>
<div class="box box-bordered box-color" >
    <div class="box-title" style="width:50%">
        <h3>
            <i class="fa fa-search"></i>

           View Fcci #<?php echo $model->FCCI_Id; ?>        </h3>
    </div>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'id'=>'view',
        'htmlOptions' => array('class' => 'table table-hover table-nomargin table-condensed', 'style' => 'width:50%'),
	'attributes'=>array(
		'FCCI_Id',
		'FCCI_Descripcion',
	),
)); ?>
 </div>