<h1><?php echo ucwords(CrugeTranslator::t("tareas"));?></h1>


<?php echo CHtml::link(CrugeTranslator::t("Crear Nueva Tarea")
	,Yii::app()->user->ui->getRbacAuthItemCreateUrl(CAuthItem::TYPE_TASK),  array('class'=>'btn btn-success'));?>


<?php $this->renderPartial('_listauthitems',array('dataProvider'=>$dataProvider),false);?>
