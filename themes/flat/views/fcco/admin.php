<style type="text/css">
    .dynatree-container {
        border: none !important;

    }

    .filetree-callbacks {
        border: 1px solid #ddd !important;
        margin-bottom: 5px !important;
    }

    .arbol {
        background-color: #f5f5f5;
        height: 100%
    }

    span.dynatree-node.nuevo>a.dynatree-title {
        color: red;
        font-weight: bolder;
    }

    span.dynatree-node.mas>a.dynatree-title {
        color: orange;
        font-weight: bolder;
    }

    span.dynatree-node.mucho>a.dynatree-title {
        color: green;
        font-weight: bolder;
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
                    <i class="fa fa-sitemap"></i>
                    Arbol del Sistema 4.0
                </h3>
            </div>

            <div class="arbol filetree-callbacks " style="overflow:auto;">
                <?php echo $arbol; ?>
            </div>
        </div>


    </div>
    <div class=" col-sm-8" id='place' style="overflow:auto;">

        <div class="jumbotron" bis_skin_checked="1">
            <h1>Bienvenido!</h1>
            <p>Selecciona algun un grupo o agencia de la lista para ver su informacion.</p>
        </div>

    </div>
</div>

<script type="text/javascript">
    if ($(".arbol").length > 0) {
        $(".arbol").each(function() {
            var $el = $(this),
                opt = {
                    autoCollapse: true,
                    fx: {
                        height: "toggle",
                        duration: 200
                    },
                };
            opt.debugLevel = 0;
            if ($el.hasClass("filetree-callbacks")) {
                opt.onActivate = function(node) {
                    console.log(node.data.url);
                    $.ajax({
                        url: node.data.url,
                        beforeSend: function(xhr) {
                            $("#progress").attr("style", "width:100%");
                            $("#place").attr("style", "opacity: 50%;")
                        },
                        success: function(data) {
                            var $response = $(data);

                            // $response = $response.filter("#informacion");
                            $("#place").html($response);

                            $("#progress").attr("style", "width:0%");
                            $("#place").attr("style", "opacity: 100%;overflow:auto;");
                            $('[rel=tooltip]').tooltip();

                            if ($response == "" || $response == undefined) {
                                $("#place").html("Algo ocurrio, Recarga esta pagina")
                            }

                            var board = $("#place");
                            // 'afterAjaxUpdate' => 'ActivarSelects',
                            $("select").select2();
                            $(".select2-container").css('width', '100%');
                            $("input[type='text']").addClass("form-control");
                            var h = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
                            // board.css({"max-height":(h-72)});
                            var w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
                            if (w < 768) {
                                board.css({
                                    "max-height": ((h / 2) - 75)
                                });

                            } else {
                                board.css({
                                    "max-height": (h - 72)
                                });
                            }

                        }
                    });
                };
            }

            $el.dynatree(opt);
        });
    }

    $(function() {
        var board = $(".arbol");
        var h = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
        var w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        if (w < 768) {
            board.css({
                "max-height": ((h / 2) - 80)
            });

        } else {
            board.css({
                "max-height": (h - 140)
            });
        }
    })
</script>