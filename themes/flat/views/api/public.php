<!-- <div class="row">
    <div class="col-sm-6">
        <table class="table table-hover table-nomargin table-condensed">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Grupo</th>
                    <th>Grupo Publico</th>
                    <th>Publico</th>

                </tr>
            </thead>
            <tbody>
              
            </tbody>
        </table>
    </div>
</div> -->
<?php
/* @var $this GccaController */
/* @var $model Gcca */

?>

<!-- <div id="box" class="box"></div> -->
<div class="col-sm-12 nopadding">
    <div class="box">
        <div class="box-title">
            <h3>
                <i class="fa fa-desktop"></i>
                <?php echo 'Administrar Publicaciones'; ?>

            </h3>
        </div>
    </div>
    <div class="box-content nopadding">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'GccaPublic-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'afterAjaxUpdate' => 'ActivarSelects',
            'itemsCssClass' => 'table table-hover table-nomargin table-condensed  table-mail',
            'pagerCssClass' => 'table-pagination',
            'htmlOptions' => array('style' => 'overflow:auto'),
            'pager' => array(
                'htmlOptions' => array('class' => 'pagination remover'),
                'selectedPageCssClass' => 'active',
            ),
            'columns' => array(

                'PUBLIC_Id',
                // 'PUBLIC_GCCD_Id',                
                'PUBLIC',
                array(
                    "name"=>'GCCD_Id',       
                    "value"=>'CHtml::link($data->gCCD->concatened, array("/fcco/grupo", "id"=> $data->GCCD_Id, "type"=>1), array("target"=>"_blank", "class"=>"not-link" ) )',
                    "type"=>"raw",
                ),         


                array(
                    'class' => 'CButtonColumn',
                    'headerHtmlOptions' => array('class' => 'remover', 'style' => 'width:83px'),
                    'template' => '{delete}',
                    'buttons' => array(
                       
                        'delete' => array(
                            'label' => '<i class="fa fa-trash-o"></i> Eliminar',
                            'visible' => 'Yii::app()->user->checkAccess("action_GccaPublic_delete")',
                            'url' => 'Yii::app()->createUrl("GccaPublic/delete/", array("id"=>$data->PUBLIC_Id))',
                            'imageUrl' => false,
                            'options' => array('class' => 'not-link btn btn-sm btn-danger', 'title' => 'Eliminar'),
                        )
                    ),
                ),
            ),
        ));
        ?>

    </div>
</div>