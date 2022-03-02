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

<div class="row">

       <div  class="col-md-3"> 
        <input class="search-button" type="text" placeholder="Buscar.." class="form-control" onkeyup="filtrar(this)">
            <ul class="list-group  ">
                <?php
                $this->widget('zii.widgets.CListView', array(
                    'id' => 'fccu-grid',
                    'dataProvider' => $model->search(),
                 'itemsCssClass' => 'table table-hover table-nomargin table-condensed visible-imprimir',
                 'summaryText' => '',
                 'pagerCssClass' => 'table-pagination remover',
                'itemView'=>'_itemview',
               
                ));
                ?>
            </ul>
        </div>
    </div>
    <div class="col-md-9" id="infoprod">

    </div>
<div>

<script>
      function filtrar(e){
        var value = $(e).val().toLowerCase();
        $('.list-group-item').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        }
</script>