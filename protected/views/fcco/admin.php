<style type="text/css">
    .dynatree-container {
        border: 0;
    }
    .arbol {
        background-color: #f5f5f5;
        height: 100%
    }

</style>
<?php
/* @var $this FccoController */
/* @var $model Fcco */

$this->breadcrumbs = array(
    'Fccos' => array('index'),
    'Administrar',
);

//$this->menu = array(
//    array('label' => 'Listar Fcco', 'url' => array('index')),
//    array('label' => 'Crear Fcco', 'url' => array('create')),
//);
?>

<h1>Asignaciones Generales</h1>
<div class="col-sm-4">
    <div class="arbol filetree-callbacks " >
        <?php echo $arbol; ?>
    </div>


</div>
<div class="col-sm-8" id='place'>
    <div class="well">

    </div>

</div>

<script type="text/javascript">
    if ($(".arbol").length > 0) {
        $(".arbol").each(function () {
            var $el = $(this),
                    opt = {
                        autoCollapse: true,
                        fx: {height: "toggle", duration: 200},
                    };
            opt.debugLevel = 0;
            if ($el.hasClass("filetree-callbacks")) {
                opt.onActivate = function (node) {
                    $.ajax({
                        url: node.data.url,
                        beforeSend: function (xhr) {
                            $('#place').html('<div class="progress progress-striped active"><div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">								<span class="sr-only">45% Complete</span></div></div>');
                        }
                    })
                            .done(function (data) {

                                $("#place").html(data);

                            });

                };
            }
            if ($el.hasClass("filetree-checkboxes")) {
                opt.checkbox = true;

                opt.onSelect = function (select, node) {
                    var selNodes = node.tree.getSelectedNodes();
                    var selKeys = $.map(selNodes, function (node) {
                        return "[" + node.data.key + "]: '" + node.data.title + "'";
                    });
                    $(".checkboxSelect").text(selKeys.join(", "));
                };
            }

            $el.dynatree(opt);
        });
    }
</script>


<?php
//$this->widget('zii.widgets.grid.CGridView', array(
//    'id' => 'fcco-grid',
//    'dataProvider' => $model->search(),
//    'filter' => $model,
//    'itemsCssClass' => 'table table-striped table-bordered table-hover',
//    'pagerCssClass' => 'table-pagination',
//    'pager' => array(
//        'htmlOptions' => array('class' => 'pagination'),
//        'selectedPageCssClass' => 'active',
//    ),
//    'columns' => array(
//        'FCCO_Id',
//        'FCCO_Timestamp',
//        'FCCO_Lote',
//        'FCCO_Descripcion',
//        'FCCO_Enabled',
//        'FCCN_Id',
//        /*
//          'FCCU_Id',
//          'GCCA_Id',
//          'GCCD_Id',
//         */
//        array(
//            'class' => 'CButtonColumn', 'headerHtmlOptions' => array('style' => 'width:83px'),
//        ),
//    ),
//));
?>
