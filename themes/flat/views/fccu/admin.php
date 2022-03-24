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
         
         <div class="actions">
            <a href="<?= Yii::app()->createUrl("fccu/add") ?>" class="btn">
                <i class="fa fa-print"></i> Crear Activo
            </a>
            <a href="<?= Yii::app()->createUrl("fccu/index") ?>" class="btn">
                <i class="fa fa-th"></i> Historial
            </a>
        </div>
    </div>


    <div class="row">
        <div class="col-md-3 nopadding " id='listview' style='overflow-y:auto'>
            <!-- <input class="search-button" type="text" placeholder="Buscar.." class="form-control" onkeyup="filtrar(this)"> -->
            <div class="col-sm-12 nopadding">
                <?php $this->renderPartial('_search', array(
                    'model' => $model,
                )); ?>

            </div>
            <div class="col-sm-12 nopadding ">
                <!-- <ul class="list-group  "> -->
                <?php
                $this->widget('zii.widgets.CListView', array(
                    'id' => 'fccu-grid',
                    'dataProvider' => $model->search(),
                    'itemsCssClass' => 'table table-hover table-nomargin table-condensed visible-imprimir',
                    'summaryText' => '<div class ="d-flex justify-content-between"><a class="not-link d-flex justify-content-start" href="javascript:busqavanzada();" ><span id="btn-avanzada">Busqueda Avanzada</span><span  style="display:none" id="btn-ocultar">Ocultar</span></a> <span class="d-flex justify-content-end">Viendo {start} - {end} de {count} resultados</span></div>',
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

        <div class="col-md-9 "  id="infoactivo" style='overflow-y:auto'>

            <div class="jumbotron" bis_skin_checked="1">
                <h1>Bienvenido!</h1>
                <p>Selecciona algun activo de la lista para ver su informacion.</p>

            </div>

        </div>
    <div>
</div>
<script>
    	var h = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
        $("#infoactivo").css({
			"max-height": (h - 135)
		});

        $("#listview").css({
			"max-height": (h - 135)
		});
        <?php
        if($model->FCCU_Id != null){
            ?>
            loadpage('<?= Yii::app()->createUrl('fccu/view/',array('id'=>$model->FCCU_Id)) ?>','<?= $model->FCCU_Id ?>');
            <?php
        }
        if(!empty($model->FCCA_Descripcion)|| !empty($model->FCCI_Id)){ ?>
            busqavanzada();
        <?php } ?>
        function loadpage(url,element) {
            $('.list-group-item').removeClass('active');
            $('.item-'+element).addClass('active');
            $("#progress").attr("style", "width:100%");
            $('#infoactivo').css({
                "opacity":"60%"
            });
            $('#infoactivo').load(url, false, function(){
                $('#infoactivo').css({
                "opacity":"100%"
                });
                $("#progress").attr("style", "width:0%");
                $('.select2-me').select2();
            });    
        }

        function busqavanzada(){
            $('#busq-avanz').toggle( "100" );
            $('#btn-avanzada').toggle( "100" );
            $('#btn-ocultar').toggle( "100" );

        }
 
        function actionurl(elm){
            var link= $(elm).data('link');
            $.post(link,function(data){
                console.log(data);
            })
        }
     
</script>