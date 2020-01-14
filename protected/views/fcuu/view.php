<?php
/* @var $this FcuuController */
/* @var $model Fcuu */

$this->breadcrumbs=array(
	'Fcuus'=>array('index'),
	$model->FCUU_Id,
);

$this->menu=array(
	//array('label'=>'List Fcuu', 'url'=>array('index')),
	array('label'=>'Crear Categoria', 'url'=>array('create')),
	array('label'=>'Actualizar Categoria', 'url'=>array('update', 'id'=>$model->FCUU_Id)),
	array('label'=>'Borrar Categoria', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->FCUU_Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Categoria', 'url'=>array('admin')),
);
?>
<div class="box box-bordered box-color" >
    <div class="box-title" style="width:50%">
        <h3>
            <i class="fa fa-search"></i>

           Categoria #<?php echo $model->FCUU_Id; ?>        </h3>
    </div>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'id'=>'view',
        'htmlOptions' => array('class' => 'table table-hover table-nomargin table-condensed', 'style' => 'width:50%'),
	'attributes'=>array(
		'FCUU_Id',
		'FCUU_Descripcion',
	),
)); ?>
 </div>