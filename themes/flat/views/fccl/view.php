<?php
/* @var $this FccaController */
/* @var $model Fcca */

$this->breadcrumbs=array(
	'Fccas'=>array('index'),
	$model->FCCL_Id,
);

$this->menu=array(
	//array('label'=>'List Fcca', 'url'=>array('index')),
	array('label'=>'Crear Etiqueta', 'url'=>array('create')),
	array('label'=>'Actualizar Etiqueta', 'url'=>array('update', 'id'=>$model->FCCL_Id)),
	array('label'=>'Borrar Etiqueta', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->FCCL_Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Etiquetas', 'url'=>array('admin')),
);
?>
<?php
echo isset($_GET['alert']) ? "<div class='alert alert-danger'><b>ATENCION: </b> {$_GET['alert']}</div>" : "";
?>
<div class="box box-bordered box-color" >
    <div class="box-title" style="width:50%">
        <h3>
            <i class="fa fa-search"></i>

            Etiqueta #<?php echo $model->FCCL_Id; ?>        </h3>
    </div>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'id'=>'view',
        'htmlOptions' => array('class' => 'table table-hover table-nomargin table-condensed', 'style' => 'width:50%'),
	'attributes'=>array(
		'FCCL_Id',
		'FCCL_Descripcion',
		
	),
)); ?>
 </div>