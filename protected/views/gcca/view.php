<?php
/* @var $this GccaController */
/* @var $model Gcca */

$this->breadcrumbs=array(
	'Gccas'=>array('index'),
	$model->GCCA_Id,
);

$this->menu=array(
	//array('label'=>'List Gcca', 'url'=>array('index')),
	array('label'=>'Crear Agencia', 'url'=>array('create')),
    array('label'=>'Activos de Agencia', 'url'=> Yii::app()->createUrl('fcco/agencia',array('id'=>$model->GCCA_Id, 'type'=>1)) ),
	array('label'=>'Actualizar Agencia', 'url'=>array('update', 'id'=>$model->GCCA_Id)),
	array('label'=>'Borrar Agencia', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->GCCA_Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Agencias', 'url'=>array('admin')),
);
?>
<div class="box box-bordered box-color" >
    <div class="box-title" style="width:50%">
        <h3>
            <i class="fa fa-search"></i>

           Agencia #<?php echo $model->GCCA_Cod; ?>        </h3>
    </div>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'id'=>'view',
        'htmlOptions' => array('class' => 'table table-hover table-nomargin table-condensed', 'style' => 'width:50%'),
	'attributes'=>array(
		//'GCCA_Id',
		
		'GCCA_Cod',
		'GCCA_Nombre',array('name'=>'GCCD_Id','value'=>$model->gCCD->concatened),
		'GCCA_Direccion',
		'GCCA_Status',
		'GCCA_Rif',
		'GCCA_Responsable',
		'GCCA_Telefono',
	),
)); ?>
 </div>