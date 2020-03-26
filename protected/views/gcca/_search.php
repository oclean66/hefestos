<div>Historial de Asignaciones de Agencias</div>

<div>Agencia: <?php echo $model->GCCA_Nombre; ?> - Usuario: <?php echo Yii::app()->user->name ?></div>
<div><br /></div>



<?php
$columHtml = array('style' => 'text-align: right;width:7.8%'/* , 'width' => '10.5%' */);

$arrayAgencia = new CArrayDataProvider($model, array(   
    'pagination' => false
    ));
?>
Informacion de Agencias
    
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'fcco-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'itemsCssClass' => 'table table-striped table-bordered table-hover table-invoice',
	'pagerCssClass' => 'table-pagination',
	'htmlOptions' => array('style' => 'overflow:auto'),
	'pager' => array(
		'htmlOptions' => array('class' => 'pagination'),
		'selectedPageCssClass' => 'active',
	),
	'columns' => array(
		array('name' => 'FCCO_Timestamp', 'header' => 'Fecha de Asignacion','value'=>'date("d M Y h:i:s A" , strtotime($data->FCCO_Timestamp))'),
		
		array('name' => 'FCCU_Serial', 'header' => 'Serial', 'value' => '$data->fCCU->FCCU_Serial'),
		//verificacion
		array('name' => 'GCCA_Id', 'header' => 'Agencia','visible'=>Yii::app()->user->isSuperAdmin),
		array('name' => 'FCCN_Id', 'header' => 'tipo','visible'=>Yii::app()->user->isSuperAdmin),
		array('name' => 'FCCO_Enabled','visible'=>Yii::app()->user->isSuperAdmin),
		array('value'=>'$data->gCCD->GCCD_Nombre."/".$data->gCCD->GCCD_Id','header'=>'Grupo','visible'=>Yii::app()->user->isSuperAdmin),
		//campos de busqueda relacionada
		array(
			'name' => 'FCCU_Numero', 'header' => 'Numero',
			'filter' => CHtml::activeTextField($model, 'FCCU_Numero'),
			'value' => '!isset($data->fCCU->FCCU_Numero)?"No aplica":$data->fCCU->FCCU_Numero',
		),
		array(
			'name' => 'FCUU_Descripcion', 'header' => 'Categoria',
			'filter' => CHtml::activeTextField($model, 'FCUU_Descripcion'),
			'value' => '$data->fCCU->fCCT->fCCA->fCUU->FCUU_Descripcion',
		),
		array(
			'name' => 'FCCA_Descripcion', 'header' => 'Tipo',
			'filter' => CHtml::activeTextField($model, 'FCCA_Descripcion'),
			'value' => '$data->fCCU->fCCT->fCCA->FCCA_Descripcion',
		),
		array(
			'name' => 'FCCT_Descripcion', 'header' => 'Modelo',
			'filter' => CHtml::activeTextField($model, 'FCCT_Descripcion'),
			'value' => '$data->fCCU->fCCT->FCCT_Descripcion',
		),
		
		
	),
));
?> 
<div><br /></div>


