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
            <div class="col-sm-12 ">
                <?php $this->renderPartial('_search', array(
                    'model' => $model,
                )); ?>

            </div>
            <div class="col-sm-12 nopadding mt-element-list">
                <!-- <ul class="list-group  "> -->
                <?php
                $this->widget('zii.widgets.CListView', array(
                    'id' => 'fccu-grid',
                    'dataProvider' => $model->search(),
                    'itemsCssClass' => 'table table-hover table-nomargin table-condensed visible-imprimir',
                     
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
         ?>
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

  
 
        function actionurl(elm){
            var link= $(elm).data('link');
            $.post(link,function(data){
                console.log(data);
            })
        }
    function copyserial(e){
        var serial=$(e).next('.id_fccu_serial').text().trim();
            copyToClipboard(serial);
    }
    function copyToClipboard(text) { 
        var sampleTextarea = document.createElement("textarea");
    document.body.appendChild(sampleTextarea);
    sampleTextarea.value = text; //save main text in it
    sampleTextarea.select(); //select textarea contenrs
    document.execCommand("copy");
    document.body.removeChild(sampleTextarea);
    }
</script>