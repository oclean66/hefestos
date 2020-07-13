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


?>

<div class="row">


    <div class="col-sm-4">
        <div class="box box-bordered">
            <div class="box-title">
                <h3>
                    <i class="fa fa-magic"></i>
                    Arbol del Sistema 4.0
                </h3>
            </div>

            <div class="arbol filetree-callbacks " style="overflow:auto;">
                <?php echo $arbol; ?>
            </div>
        </div>


    </div>
    <div class="col-sm-8" id='place' >
      

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
                            $('#place').html('<div class="progress progress-striped active" style="margin-top:20px;"><div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">								<span class="sr-only">45% Complete</span></div></div>');
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

    $(function(){
        var board = $(".arbol" );
        var h = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
		board.css({"max-height":(h-140)});
    })

</script>

