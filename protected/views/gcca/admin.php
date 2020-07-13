<?php
/* @var $this GccaController */
/* @var $model Gcca */


$this->menu = array(
array('label'=>'Arbol de Sistema', 'url'=>array('/fcco/admin')),
    array('label' => 'Crear Agencia', 'url' => array('create')),
);
?>

<!-- <div id="box" class="box"></div> -->
<div class="col-sm-12 nopadding">
	<div class="box">
		<div class="box-title">
			<h3>
            <i class="fa fa-desktop"></i>
				<?php echo CrugeTranslator::t('app', 'Administrar Agencias') ?>

			</h3>
		</div>
	</div>
	<div class="box-content nopadding">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'gcca-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'afterAjaxUpdate' => 'ActivarSelects',
            'itemsCssClass' => 'table table-hover table-nomargin table-condensed  table-mail',
            'pagerCssClass' => 'table-pagination',
            'htmlOptions' => array('style' => 'overflow:auto'),
            'pager' => array(
                'htmlOptions' => array('class' => 'pagination'),
                'selectedPageCssClass' => 'active',
            ),
            'columns' => array(
                array(
                    'name' => 'GCCA_Status',
                    'header' => 'Estado',
                    'value' => '($data->GCCA_Status==0?"<i class=\"fa fa-times\"></i>":($data->GCCA_Status==1?"<i class=\"fa fa-check\"></i>":($data->GCCA_Status==3?"<i class=\"fa fa-eye-slash\"></i>":"<i class=\"fas fa-print\"></i>")))." ".$data->GCCA_Id',
                    'type' => 'raw',
                    'filter' => CHtml::dropDownList('Gcca[GCCA_Status]',  $model->GCCA_Status,
                        array('0'=>" Inactivas","1"=>"Activas"),
                        array('empty'=>'Todas')),
                    
                ),   
                array('name' => 'GCCA_Cod',
                    'value' => 'CHtml::link(
                        $data->GCCA_Cod, 
                        Yii::app()->createUrl("fcco/agencia",array("id"=>$data->GCCA_Id,"type"=>$data->GCCA_Id)),
                        array("target"=>"_blank"))',
                    'type' => 'raw',
                    'headerHtmlOptions' => array('style' => 'width:83px'),
                ),
                'GCCA_Nombre',
                array(
                    'name' => 'GCCD_Id',
                    'value' => '$data->gCCD->concatened',
                    'footerHtmlOptions' => array('class' => 'select2-me'),
                    'filter' => CMap::mergeArray(array('' => 'Todos'), CHtml::listData(Gccd::model()->findAll(),"GCCD_Id","concatened")),
                ),
                'GCCA_Responsable',
                'GCCA_Telefono',
                array(
                    'class' => 'CButtonColumn', 
                    'headerHtmlOptions' => array('style' => 'width:83px'),
                    'template' => '{view} {update} {delete}',
                    'buttons' => array(
                        'view' => array( 
                            'label' => "Detalles",
                            'url' => 'Yii::app()->createUrl("gcca/view/",array("id"=>$data->GCCA_Id))',
                            'options' => array('target' => '_blank'),
                        ),
                        'update' => array( 
                            'label' => "Detalles", 
                            'url' => 'Yii::app()->createUrl("gcca/update/",array("id"=>$data->GCCA_Id))',
                            'options' => array('target' => '_blank'),
                        ),
                        ),
                ),
            ),
        ));
        ?>

    </div>
</div>
