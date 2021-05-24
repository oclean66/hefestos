<?php
/* @var $this FccdController */
/* @var $model Fccd */

$this->breadcrumbs=array(
	'Fccds'=>array('index'),
	$model->FCCD_Id,
);

$this->menu=array(
	//array('label'=>'List Fccd', 'url'=>array('index')),
	array('label'=>'Crear Fccd', 'url'=>array('create')),
	array('label'=>'Actualizar Fccd', 'url'=>array('update', 'id'=>$model->FCCD_Id)),
	array('label'=>'Borrar Fccd', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->FCCD_Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Fccd', 'url'=>array('admin')),
);
?>
<div class="box box-bordered box-color" >
    <div class="box-title" style="width:50%">
        <h3>
            <i class="fa fa-search"></i>

           View Fccd #<?php echo $model->FCCD_Id; ?>        </h3>
    </div>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'id'=>'view',
        'htmlOptions' => array('class' => 'table table-hover table-nomargin table-condensed', 'style' => 'width:50%'),
	'attributes'=>array(
		'FCCD_Id',
		'FCCD_Descripcion',
	),
)); ?>
 </div>