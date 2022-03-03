<?php
/* @var $this FccuController */
/* @var $model Fccu */
// $this->menu = array(
//     array(
//         'label' => CrugeTranslator::t('app', 'Agregar Activo'),
//         'url' => array('add'),
//         'visible' => Yii::app()->user->checkAccess('action_fccu_add')
//     ),
// );
Yii::app()->clientScript->registerScript('search', "
   
    $('.search-form form').submit(function(){
        $.fn.yiiListView.update('blogslistview', { 
            //this entire js section is taken from admin.php. w/only this line diff
            data: $(this).serialize()
        });
        return false;
    });
");
?>


<div class="box">
    <div class="box-title">
        <h3>
            <i class="fa fa-thumb-tack"></i>Activos del Sistema
        </h3>
        <!-- <div class="actions">
            <a href="javascript:print()" class="btn">
                <i class="fa fa-print"></i> Imprimir
            </a>
        </div>-->
    </div>



    <div class="col-md-3 nopadding">
        <!-- <input class="search-button" type="text" placeholder="Buscar.." class="form-control" onkeyup="filtrar(this)"> -->
        <div class="col-sm-12 nopadding">
            <?php $this->renderPartial('_search', array(
                'model' => $model,
            )); ?>

        </div>
        <div class="col-sm-12 nopadding">
            <!-- <ul class="list-group  "> -->
            <?php
            $this->widget('zii.widgets.CListView', array(
                'id' => 'fccu-grid',
                'dataProvider' => $model->search(),
                'itemsCssClass' => 'table table-hover table-nomargin table-condensed visible-imprimir',
                // 'summaryText' => '',
                'pagerCssClass' => 'table-pagination',
                'pager' => array(
                    'htmlOptions' => array('class' => 'pagination'),
                    'selectedPageCssClass' => 'active',
                ),
                'itemView' => '_itemview',

            ));
            ?>
            <!-- </ul> -->
        </div>
    </div>

    <div class="col-md-9" style="padding: 5px;" id="infoprod">

        <div class="jumbotron" bis_skin_checked="1">
            <h1>Bienvenido!</h1>
            <p>Selecciona algun activo de la lista para ver su informacion.</p>

        </div>

    </div>
    <div>

        <script>
            function filtrar(e) {
                var value = $(e).val().toLowerCase();
                $('.list-group-item').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            }
        </script>