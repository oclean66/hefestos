<h1><?php echo ucwords(CrugeTranslator::t("roles"));?></h1>

<?php echo CHtml::link(CrugeTranslator::t("Crear Nuevo Rol")
	,Yii::app()->user->ui->getRbacAuthItemCreateUrl(CAuthItem::TYPE_ROLE),  array('class'=>'btn btn-success'));?>


<?php $this->renderPartial('_listauthitems',array('dataProvider'=>$dataProvider),false);?>